
<?php
    session_start();     
    session_destroy(); 
    $path = "../../"; 
    require_once($path.'config/connect.php');     

    try {
        $stmt_login = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username,:password,:role");
        $stmt_login->execute(array(':proc'=>'check_role_tenko',':username'=>$_GET['tenko'],':password'=>$_GET['area'],':role'=>'TENKO',));
        $row_login = $stmt_login->fetch(PDO::FETCH_OBJ);

        if ($row_login === false) {
            throw new Exception("ไม่พบข้อมูลผู้ใช้");
        }
        if (!password_verify($_GET['tenko'], $row_login->RA_PASSWORD)) {
            throw new Exception("รหัสผ่านไม่ถูกต้อง");
        }

        $_SESSION["auth"] = true;
        $_SESSION["start"] = time();
        $_SESSION["expire"] = $_SESSION["start"] + (5*60);
        // $_SESSION["expire"] = $_SESSION["start"] + (30*60);
        $_SESSION["AD_ID"] = $row_login->ID;
        $_SESSION['AD_PERSONID'] = $row_login->PersonID;
        $_SESSION['AD_PERSONCODE'] = $row_login->PersonCode;
        $_SESSION['AD_FIRSTNAME'] = $row_login->FnameT;
        $_SESSION['AD_LASTNAME'] = $row_login->LnameT;
        $_SESSION['AD_NAMETHAI'] = $row_login->nameT;
        $_SESSION['AD_NAMEENGLISH'] = $row_login->nameE;
        $_SESSION['AD_CURRENTTEL'] = $row_login->CurrentTel;
        $_SESSION['AD_COMPANYCODE'] = $row_login->Company_Code;
        $_SESSION['AD_COMPANYNAME'] = $row_login->Company_NameT;
        $_SESSION['AD_POSITIONID'] = $row_login->PositionID;
        $_SESSION['AD_POSITION'] = $row_login->PositionNameT;
        $_SESSION['AD_ROLEACCOUNT_USERNAME'] = $row_login->RA_USERNAME;
        $_SESSION['AD_ROLEACCOUNT_PASSWORD'] = $row_login->RA_PASSWORD;
        $_SESSION['AD_ROLE_ID'] = $row_login->RU_ID;
        $_SESSION["AD_ROLE_NAME"] = $row_login->RU_NAME;
        $_SESSION["AD_AREA"] = $row_login->AREA;
        $_SESSION["AD_REGISTRATION"] = $_GET['regis'];
        $_SESSION["AD_PERIOD"] = '';

        $query_sel_car = $conn->prepare("EXECUTE ENB_VEHICLEINFO :proc,:regis");
        $query_sel_car->execute(array(':proc'=>'select_data',':regis'=>$_GET['regis'],));   
        $resul_sel_car = $query_sel_car->fetch(PDO::FETCH_OBJ);    

        if ($resul_sel_car === false) {
            throw new Exception("ไม่พบข้อมูลรถ");
        }

        $rsRG = $resul_sel_car->VEHICLEREGISNUMBER;
        $rsAFF = $resul_sel_car->AFFCOMPANY;

        date_default_timezone_set("Asia/Bangkok");
        $dwk = date("Y-m-d");
        $dwkth = date("d/m/") . (date("Y") + 543);
        
        $current_time = date("H:i");
        $cutoff_time = "12:00";
        if (strtotime($current_time) < strtotime($cutoff_time)) {
            $period = "กลางวัน";
        } else {
            $period = "กลางคืน";
        }

        $query_sel_plan = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username,:password,:role");
        $query_sel_plan->execute(array(':proc'=>'check_tenko_plan',':username'=>$dwk,':password'=>$_GET['emp'],':role'=>'',));
        $resul_sel_plan = $query_sel_plan->fetch(PDO::FETCH_OBJ);    
        
        $period_plan = $resul_sel_plan->PERIODTIME;
        $regis_plan = $resul_sel_plan->REGIS;

        if ($resul_sel_plan === false) {
            throw new Exception("ไม่พบข้อมูลแผน");
        }
        if($period!=$period_plan){
            throw new Exception("ไม่พบข้อมูลแผน");
        }
        if($rsRG!=$regis_plan){
            throw new Exception("ไม่พบข้อมูลแผน");
        }
        
        $sublw=$resul_sel_plan->SUB_LINEOFWORK;

        // echo "<pre>";
        // print_r($resul_sel_plan);
        // echo "</pre>";
        // exit;

        echo '<script type="text/javascript">';
        echo 'window.location.href="ยืนยันการตรวจสอบรายวันของรถทะเบียน_'.$rsRG.'_วันที่_'.$dwk.'_ช่วงเวลา_'.$period.'_'.$sublw.'.html";';
        echo '</script>';
    } catch (Exception $e) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>WARNING</title>
            <link rel="shortcut icon" href="assets/images/warning.png" loading="lazy">
            <style>
                body {
                    background-image: url('assets/images/checktenko.jpg');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                }
            </style>
        </head>
        <body>
            <!-- <font color='black'>< ?php echo $e->getMessage() ?></font> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
            <?php if ($e->getMessage() == "ไม่พบข้อมูลผู้ใช้") { ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "ไม่พบข้อมูลผู้ใช้",
                        text: "คุณยังไม่มีสิทธิ์ TENKO จึงไม่สามารถเข้าสู่ระบบได้",
                        showCancelButton: true,
                        confirmButtonText: "ร้องขอสิทธิ์",
                        cancelButtonText: "ปิด",
                        cancelButtonColor: "#d33",
                        preConfirm: () => {
                            return Swal.fire({
                                title: "กรอกข้อมูล",
                                html: `
                                    <input type="text" id="code" class="swal2-input" placeholder="รหัสพนักงาน" autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <input type="text" id="name" class="swal2-input" placeholder="ชื่อพนักงาน" autocomplete="off">
                                    <input type="text" id="phone" class="swal2-input" placeholder="เบอร์โทรสำหรับติดต่อกลับ" autocomplete="off" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                `,
                                showCancelButton: true,
                                confirmButtonText: "ส่งข้อมูล",
                                cancelButtonText: "ยกเลิก",
                                cancelButtonColor: "#d33",
                                preConfirm: () => {
                                    const code = Swal.getPopup().querySelector("#code").value;
                                    const name = Swal.getPopup().querySelector("#name").value;
                                    const phone = Swal.getPopup().querySelector("#phone").value;
                                    if (!code || !name || !phone) {
                                        Swal.showValidationMessage("กรุณากรอกข้อมูลให้ครบทุกช่อง");
                                        return false;
                                    }
                                    return { code: code, name: name, phone: phone };
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const data = result.value;
                                    saveDataToDatabase(data).then((response) => {
                                        console.log("Response: ", response);
                                        if (response == "duplicate") {                                            
                                            Swal.fire({
                                                icon: "warning",
                                                title: "บันทึกข้อมูลซ้ำ",
                                                html: "ข้อมูลที่คุณบันทึกมีอยู่แล้วในระบบ<br>โปรดรอการติดต่อกลับจากเจ้าหน้าที่ RIT",
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "ปิด",
                                                cancelButtonColor: "#CC0000",
                                            }).then((result) => {
                                                window.close();
                                            });
                                        } else if (response == "complete") {                                            
                                            Swal.fire({
                                                icon: "success",
                                                title: "บันทึกสำเร็จ",
                                                html: "โปรดรอการติดต่อกลับจากเจ้าหน้าที่ RIT",
                                                showConfirmButton: false,
                                                showCancelButton: true,
                                                cancelButtonText: "รับทราบ",
                                                cancelButtonColor: "#339900",
                                            }).then((result) => {
                                                window.close();
                                            });
                                        }
                                    }).catch((error) => {
                                        console.log("Error: ", error);                                           
                                        Swal.fire({
                                            icon: "error",
                                            title: "เกิดข้อผิดพลาด",
                                            html: "ไม่สามารถบันทึกข้อมูลได้",
                                            showConfirmButton: false,
                                            showCancelButton: true,
                                            cancelButtonText: "ปิด",
                                            cancelButtonColor: "#CC0000",
                                        }).then((result) => {
                                            window.close();
                                        });
                                    });
                                }else{
                                    window.close();
                                }
                            });
                        }
                    }).then((result) => {
                        window.close();
                    });
                    function saveDataToDatabase(data) {
                        const a0 = 'add';
                        const a1 = data.code;
                        const a2 = data.name;
                        const a3 = data.phone;

                        return new Promise((resolve, reject) => {
                            $.ajax({
                                type: 'post',
                                url: 'controllers/controllers.php',
                                data: {
                                    keyword: "request_role", 
                                    a0: a0,
                                    a1: a1,
                                    a2: a2,
                                    a3: a3
                                },
                                cache: false,
                                beforeSend: function(){
                                    console.log('ส่งข้อมูล...');
                                },
                                success: function(RS){
                                    const response = RS.replace(/['"]+/g, '');
                                    if (response === "complete") {
                                        console.log('สำเร็จ');
                                        resolve("complete");
                                    } else if (response === "duplicate") {
                                        console.log('ข้อมูลซ้ำ');
                                        resolve("duplicate");
                                    } else {
                                        console.log('ไม่สำเร็จ');
                                        reject("error");
                                    }
                                },
                                error: function(){
                                    console.log('ข้อผิดพลาดในการส่งข้อมูล');
                                    reject("error");
                                }
                            });
                        });
                    }
                </script>
            <?php } elseif ($e->getMessage() == "ไม่พบข้อมูลรถ") { ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "ไม่พบข้อมูลรถ",
                        text: "ไม่พบข้อมูลรถในฐานข้อมูล โปรดติดต่อเจ้าหน้าที่ RIT เพื่อตรวจสอบ",
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "ปิด",
                        cancelButtonColor: "#d33",
                    }).then((result) => {
                        window.close();
                    });
                </script>
            <?php } elseif ($e->getMessage() == "ไม่พบข้อมูลแผน") { ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "ไม่พบแผนการตรวจสอบรถ",
                        html: "ไม่มีข้อมูลตรวจสอบรถประจำวันที่ <b><?php echo $dwkth; ?></b> <br>ในช่วงเวลาดังกล่าว สำหรับพนักงานรหัส <b><?php echo htmlspecialchars($_GET['emp'], ENT_QUOTES, 'UTF-8'); ?></b>",
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "ปิด",
                        cancelButtonColor: "#d33",
                    }).then((result) => {
                        window.close();
                    });
                </script>
            <?php } ?>
        </body>
        </html><?php 
    } ?>



<!-- echo '
    <script>
        Swal.fire({
            icon: "error",
            title: "ไม่พบข้อมูลผู้ใช้",
            text: "กรุณาเข้าสู่ระบบด้วยตัวเอง",
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    const content = Swal.getContent();
                    if (content) {
                        const b = content.querySelector("b");
                        if (b) {
                            b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                        }
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            window.close();
        });
    </script>'; -->