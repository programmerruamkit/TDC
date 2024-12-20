<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='รายงานตรวจสอบสภาพรายวัน.html';
    $_SESSION['DROPDOWN']='9';
    $_SESSION['DROPDOWN_ID']='10';
    
    $sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis");
    $sql_get_data->execute(array(':proc'=>'select_data',':regis'=>$_GET['regis'],));
    $rs_get_data = $sql_get_data->fetch(PDO::FETCH_OBJ); 
    
    $qr_reportdaily_who = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
    $qr_reportdaily_who->execute(array(':proc'=>'select_report_gw_who',':datenow'=>$_GET["datenow"],':period'=>'',':reg'=>$_GET['regis'],':countgroup'=>'',':shid'=>'',));
    $rs_reportdaily_who = $qr_reportdaily_who->fetch(PDO::FETCH_OBJ);

    if(isset($_GET["datenow"])){
        $datenow = $_GET["datenow"];
    }else{
        $datenow = date("Y-m-d");
    }
    if(isset($_GET["time"])){
        $PERIODTIME=$_GET["time"];
        if($PERIODTIME=="กลางวัน"){
            $P_FIND = "DAY";
        }else if($PERIODTIME=="กลางคืน"){
            $P_FIND = "NIGHT";
        }
    }else{
        $PERIODTIME="กลางวัน";
        $P_FIND = "DAY";
    }
    
    $sql_check_approve = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
    $sql_check_approve->execute(array(':proc'=>'check_approve',':datenow'=>$_GET["datenow"],':period'=>$P_FIND,':reg'=>$_GET['regis'],':countgroup'=>'',':shid'=>'',));
    $rs_check_approve = $sql_check_approve->fetch(PDO::FETCH_OBJ);

    $date_string = '2024-11-23';
    $timestamp = strtotime($datenow);
    // echo $timestamp."<br>";
?>
<body class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
<div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
    <div class="app-menu w-vertical-menu bg-vertical-menu ltr:border-r rtl:border-l border-vertical-menu-border fixed bottom-0 top-0 z-[1003] transition-all duration-75 ease-linear group-data-[sidebar-size=md]:w-vertical-menu-md group-data-[sidebar-size=sm]:w-vertical-menu-sm group-data-[sidebar-size=sm]:pt-header group-data-[sidebar=dark]:bg-vertical-menu-dark group-data-[sidebar=dark]:border-vertical-menu-dark group-data-[sidebar=brand]:bg-vertical-menu-brand group-data-[sidebar=brand]:border-vertical-menu-brand group-data-[sidebar=modern]:bg-gradient-to-tr group-data-[sidebar=modern]:to-vertical-menu-to-modern group-data-[sidebar=modern]:from-vertical-menu-form-modern group-data-[layout=horizontal]:w-full group-data-[layout=horizontal]:bottom-auto group-data-[layout=horizontal]:top-header hidden md:block print:hidden group-data-[sidebar-size=sm]:absolute group-data-[sidebar=modern]:border-vertical-menu-border-modern group-data-[layout=horizontal]:dark:bg-zink-700 group-data-[layout=horizontal]:border-t group-data-[layout=horizontal]:dark:border-zink-500 group-data-[layout=horizontal]:border-r-0 group-data-[sidebar=dark]:dark:bg-zink-700 group-data-[sidebar=dark]:dark:border-zink-600 group-data-[layout=horizontal]:group-data-[navbar=scroll]:absolute group-data-[layout=horizontal]:group-data-[navbar=bordered]:top-[calc(theme('spacing.header')_+_theme('spacing.4'))] group-data-[layout=horizontal]:group-data-[navbar=bordered]:inset-x-4 group-data-[layout=horizontal]:group-data-[navbar=hidden]:top-0 group-data-[layout=horizontal]:group-data-[navbar=hidden]:h-16 group-data-[layout=horizontal]:group-data-[navbar=bordered]:w-[calc(100%_-_2rem)] group-data-[layout=horizontal]:group-data-[navbar=bordered]:[&.sticky]:top-header group-data-[layout=horizontal]:group-data-[navbar=bordered]:rounded-b-md group-data-[layout=horizontal]:shadow-md group-data-[layout=horizontal]:shadow-slate-500/10 group-data-[layout=horizontal]:dark:shadow-zink-500/10 group-data-[layout=horizontal]:opacity-0">
        <?php require_once($path.'include/sidebar.php'); ?>
    </div>
    <?php require_once($path.'include/navbar.php'); ?>
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <!--  -->
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <div class="p-5 border md:p-8 border-slate-200 dark:border-zink-500 print:p-0">
                                <div class="flex justify-between">
                                    <div class="text-center xl:col-span-3 ltr:xl:text-left rtl:xl:text-right">
                                        <h5 class=" mb-1">ข้อมูลใบตรวจสภาพรถ</h5>
                                    </div>
                                    <div class="text-center xl:col-span-3 ltr:xl:text-left rtl:xl:text-right">
                                        <a href="รายงานการตรวจสอบรายวันของรถทะเบียน_<?php echo $rs_check_approve->SHLC_REGIS ?>_วันที่_<?php echo $rs_check_approve->SHLC_DATEINSERT ?>_ช่วงเวลา_<?php echo $PERIODTIME ?>_<?php echo $rs_check_approve->SUB_LINEOFWORK; ?>.pdf" target="_blank" class="flex items-center gap-2">
                                            <button class="flex items-center gap-2 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50 active:bg-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pdf"><path d="M6 2h12l4 4v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h10"></path><path d="M14 2v8h8"></path><path d="M14 14h4v4h-4z"></path></svg>
                                                PDF
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 mt-6 text-center divide-y md:divide-y-0 md:divide-x rtl:divide-x-reverse divide-dashed md:grid-cols-4 divide-slate-200 dark:divide-zink-500">
                                    <div class="p-3">
                                        <h6 class="mb-1"><?php if(isset($rs_get_data->VEHICLEREGISNUMBER)){echo $rs_get_data->VEHICLEREGISNUMBER;}else{echo "-";}?></h6>
                                        <p class="text-slate-500 dark:text-zink-200">หมายเลขทะเบียน (หัว)</p>
                                    </div>
                                    <div class="p-3">
                                        <h6 class="mb-1"><?php if(isset($rs_get_data->THAINAME)){echo $rs_get_data->THAINAME;}else{echo "-";}?></h6>
                                        <p class="text-slate-500 dark:text-zink-200">ชื่อรถ (หัว)</p>
                                    </div>
                                    <div class="p-3">
                                        <h6 class="mb-1">-</h6>
                                        <p class="text-slate-500 dark:text-zink-200">หมายเลขทะเบียน (หาง)</p>
                                    </div>
                                    <div class="p-3">
                                        <h6 class="mb-1">-</h6>
                                        <p class="text-slate-500 dark:text-zink-200">ชื่อรถ (หาง)</p>
                                    </div>
                                </div>
                                <hr><br>
                                <div class="flex flex-col gap-5 md:items-center md:flex-row">
                                    <?php 
                                        if(isset($rs_get_data->LW_LINEOFWORK)){      
                                            $showlw=$rs_get_data->LW_LINEOFWORK;
                                            $sublw=$rs_get_data->SUB_LINEOFWORK;
                                            if($sublw=="4L"||$sublw=="RCC"||$sublw=="RATC"){
                                                $showct=$rs_get_data->COUNTSHID;
                                            }else{
                                                $showct=$rs_get_data->COUNTSHID+1;
                                            }
                                        }else{
                                            $showlw='<font color="red"><b>ไม่ได้เลือกสายงาน</b></font>';
                                            $showct='0';
                                        }
                                    ?>
                                    <div class="grow">
                                        <p class="mb-2 text-slate-500 dark:text-zink-200"><font size="3"><b>ข้อมูลอื่น</b></font></p>
                                        <p class="mb-1 text-slate-500 dark:text-zink-200">ใบตรวจสภาพรถสายงาน: <b><?php echo $showlw;?></b></p>
                                        <p class="mb-1 text-slate-500 dark:text-zink-200">หัวข้อตรวจสอบจำนวน: <b><?php echo $showct;?></b> ข้อ</p>
                                        <p class="mb-0 text-slate-500 dark:text-zink-200">พขร.ผู้ทำการตรวจสอบ: <b><?php echo $rs_reportdaily_who->EMP_NAME;?></b></p>
                                    </div>
                                </div>
                            </div>
                            <table class="table-reportdaily w-full rounded-lg text-black border">
                                <thead class="bg-slate-200 ">
                                    <tr>
                                        <th class="px-3 py-1 text-sm text-center font-bold border border-slate-300" rowspan="3" colspan="2">รายการตรวจสภาพความพร้อมที่ยอมรับได้</th>
                                        <td class="px-3 py-1 text-sm text-left font-bold border border-slate-300" rowspan="1" colspan="2">วันที่....<?php echo thai_date_fullmonth($timestamp) ?>....</td>     
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-1 text-sm text-left font-bold border border-slate-300" colspan="2" align="left">เวลา......กะ<?php echo $PERIODTIME ?>......</td>         
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-1 text-sm text-center font-bold border border-slate-300 w-5">ผล</td>
                                        <td class="px-3 py-1 text-sm text-center font-bold border border-slate-300 w-80">หมายเหตุ</td>
                                    </tr>
                                </thead>
                                <tbody class="border border-slate-300"></tbody>
                            </table>
                            <br>
                            <div class="flex items-center justify-center gap-2 shrink-0">                                   
                                <?php if(isset($rs_check_approve->SHLA_CREATEBY)){ ?>
                                    <button type="button" class="bt_approve text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                        ตรวจสอบเรียบร้อย
                                    </button>
                                <?php }else{ ?>                                  
                                    <?php if($rs_check_approve->SHLC_STATUS=='wait'){ ?>
                                        <button type="button" class="bt_approve text-black bg-yellow-500 border-yellow-500 btn hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/10">
                                            อยู่ระหว่างการตรวจสอบ
                                        </button>
                                    <?php }else{ ?>
                                        <button type="button" onclick="save_approve_reportdaily('approve','<?php echo $rs_check_approve->SHLR_CODE;?>')" class="bt_approve text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">
                                            ยืนยันการตรวจสอบ
                                        </button>
                                    <?php } ?>
                                <?php } ?>&emsp;
                                    <button aria-label="button" type="button" onclick="javascript:window.close('','_parent','');" class="bt_approve text-white bg-slate-500 border-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                        <i data-lucide="x" class="inline-block size-6"></i> <span class="align-middle">ปิดหน้าต่าง</span>
                                    </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="datenow" value="<?php echo $datenow; ?>">
                    <input type="hidden" id="pfind" value="<?php echo $P_FIND; ?>">
                    <input type="hidden" id="shid" value="<?php echo $rs_get_data->SH_ID; ?>">
                    <input type="hidden" id="regis" value="<?php echo $_GET['regis']; ?>">
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    <?php require_once($path.'include/footer.php'); ?>
    </div>
</div>
<?php require_once($path.'include/settingtheme.php'); ?>
<?php require_once($path.'include/script.php'); ?>
<script src="assets/js/app.js"></script>
<script src="assets/js/datatables/data-tables.min.js"></script>
<script src="assets/js/datatables/data-tables.tailwindcss.min.js"></script>
<script src="assets/js/datatables/datatables.buttons.min.js"></script>
<!-- <script src="assets/js/datatables/jszip.min.js"></script> -->
<!-- <script src="assets/js/datatables/pdfmake.min.js"></script> -->
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<!-- <script src="assets/js/datatables/buttons.print.min.js"></script> -->
<script src="assets/js/datatables/datatables.init.js"></script>
<script>
    $('.table-reportdaily tbody').empty();
    $('.table-reportdaily tbody').append(`
        <tr>
            <td colspan="4" align="center" class="p-6 text-xl">
                <font size="4">กำลังโหลดข้อมูล...</font>
            </td>
        </tr>`);
     function fetch_reportdaily() {
        var datenow = $('#datenow').val();
        var pfind = $('#pfind').val();
        var shid = $('#shid').val();
        var regis = $('#regis').val();
        $.ajax({
            url: 'api/report/api.php',
            type: 'POST',
            dataType: 'json',
            data:{
                proc: 'report_daily_check',
                datenow: datenow,
                period: pfind,
                regis: regis,
                shid: shid
            },
            success: function(data) {
                $('.table-reportdaily tbody').empty();
                if(data.length === 0){
                    $('.table-reportdaily tbody').append(`
                    <tr>
                        <td colspan="4" align="center" class="p-6 text-xl">
                            <font size="4">ไม่มีข้อมูลในตาราง</font>
                        </td>
                    </tr>`);
                }else{
                    data.forEach(function(head) {
                        $('.table-reportdaily tbody').append(
                            `<tr class="border border-slate-300 bg-slate-500">
                                <td class="px-3 py-1 border border-slate-300 text-white" colspan="4">${head.SHL_PERIODTIME}</td>
                            </tr>`
                        );
                        head.items.forEach(function(item) {
                            let Day1Check;
                            // แทนที่ ternary operator ด้วย if-else
                            if (item.DAY1_CHECK === true) {
                                Day1Check = '<img src="assets/images/check_true.gif" alt="ผ่านการตรวจ" class="block h-5 w-100 mx-auto">';
                            } else if (item.DAY1_CHECK === false) {
                                Day1Check = '<img src="assets/images/check_del.gif" alt="ไม่ผ่านการตรวจ" class="block h-5 w-100 mx-auto">';
                            } else if (item.DAY1_CHECK === 'not') {
                                Day1Check = '<img src="assets/images/remove-gray.png" alt="ไม่ได้ใช้งาน" class="block h-5 w-100 mx-auto">';
                            } else if (item.DAY1_CHECK === null) {
                                Day1Check = '<img src="assets/images/imgloading.gif" alt="รอการตรวจ" class="block h-5 w-100 mx-auto">';
                            }
                            let repaircheck = '';
                            if (item.SAVE_REPAIR === '1') {
                                repaircheck = '<font color="red" size="2"><b>(ส่งแจ้งซ่อมแล้ว)</b></font>';
                            } else if (item.SAVE_REPAIR === false) {
                                repaircheck = ''; // คงเป็นค่าว่างตามเงื่อนไข
                            }
                            $('.table-reportdaily tbody').append(`
                                <tr class="border border-slate-300">
                                    <td class="px-2 py-1 border border-slate-300 w-5 text-center">${item.SHL_NUMBER}</td>
                                    <td class="px-3 py-1 border border-slate-300">${item.SHL_NAME}</td>
                                    <td class="px-0 py-1 border border-slate-300">${Day1Check}</td>
                                    <td class="px-3 py-1 border border-slate-300">
                                        ${item.DAY1REMARK ? item.DAY1REMARK : ''} ${repaircheck}
                                    </td>
                                </tr>
                            `);
                        });
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data: ", error);
            }
        });
    }
    fetch_reportdaily();
</script>
</body>
</html>