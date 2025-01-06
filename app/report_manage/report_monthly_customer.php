<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='รายงานการสรุปรายเดือน.html';
    $_SESSION['DROPDOWN']='9';
    $_SESSION['DROPDOWN_ID']='11';
    
    $PERIODTIME="กลางวัน";
    $GETYEAR=date("Y")+543;
    // $GETMONTH=date("m");

    if(isset($_GET["datenow"])){
        $datenow = $_GET["datenow"];
    }else{
        $datenow = date("Y-m-d");
    }

    if(date("m") == "1"){           $GETMONTH = "มกราคม";
    }else if(date("m") == "2"){     $GETMONTH = "กุมภาพันธ์";
    }else if(date("m") == "3"){     $GETMONTH = "มีนาคม";
    }else if(date("m") == "4"){     $GETMONTH = "เมษายน";
    }else if(date("m") == "5"){     $GETMONTH = "พฤษภาคม";
    }else if(date("m") == "6"){     $GETMONTH = "มิถุนายน";
    }else if(date("m") == "7"){     $GETMONTH = "กรกฎาคม";
    }else if(date("m") == "8"){     $GETMONTH = "สิงหาคม";
    }else if(date("m") == "9"){     $GETMONTH = "กันยายน";
    }else if(date("m") == "10"){    $GETMONTH = "ตุลาคม";
    }else if(date("m") == "11"){    $GETMONTH = "พฤศจิกายน";
    }else if(date("m") == "12"){    $GETMONTH = "ธันวาคม";
    }
    
    // if($_GET["month"] == "มกราคม"){          $chkmonth = "1";
    // }else if($_GET["month"] == "กุมภาพันธ์"){  $chkmonth = "2";
    // }else if($_GET["month"] == "มีนาคม"){    $chkmonth = "3";
    // }else if($_GET["month"] == "เมษายน"){   $chkmonth = "4";
    // }else if($_GET["month"] == "พฤษภาคม"){ $chkmonth = "5";
    // }else if($_GET["month"] == "มิถุนายน"){   $chkmonth = "6";
    // }else if($_GET["month"] == "กรกฎาคม"){  $chkmonth = "7";
    // }else if($_GET["month"] == "สิงหาคม"){   $chkmonth = "8";
    // }else if($_GET["month"] == "กันยายน"){   $chkmonth = "9";
    // }else if($_GET["month"] == "ตุลาคม"){    $chkmonth = "10";
    // }else if($_GET["month"] == "พฤศจิกายน"){ $chkmonth = "11";
    // }else if($_GET["month"] == "ธันวาคม"){   $chkmonth = "12";
    // }
    // $months = array(1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม');
    // $year = array(1 => '2566', 2 => '2567', 3 => '2568');
    // echo $months[$chkmonth];
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
                    <div class="grow">
                        <div class="flex flex-wrap justify-left gap-2">
                            <div class="flex items-center gap-2">
                                <h5 class="text-16">รายงานการสรุปรายเดือน</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <table id="borderedTable" class="bordered group">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ.</th>
                                        <th width="10%">เลขทะเบียนรถ</th>
                                        <!-- <th width="15%">ประเภทรถ</th> -->
                                        <th width="15%">ชื่อรถ</th>
                                        <th width="15%">สายงาน</th>
                                        <th width="15%">รายงาน PDF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                
                                        $query_vehicleinfo = $conn->prepare("EXECUTE ENB_VEHICLEINFO :proc,:regis,:area,:affc");
                                        $query_vehicleinfo->execute(array(':proc'=>'select_affcompany',':regis'=>'',':area'=>'',':affc'=>$_GET['id'],));
                                        $no=0;
                                        while($rs_car = $query_vehicleinfo->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                            $VEHICLEREGISNUMBER=$rs_car->VEHICLEREGISNUMBER;
                                    ?>
                                    <tr>
                                        <td ><?php print "$no.";?></td>
                                        <td align="center"><?= $rs_car->VEHICLEREGISNUMBER ?></td>
                                        <!-- <td align="left"><?= $rs_car->VEHICLETYPEDESC ?></td> -->
                                        <td align="left"><?= $rs_car->THAINAME ?></td>
                                        <td align="center">
                                            <?php                                            
                                                $stmt_selcartype = $conn->prepare("SELECT DISTINCT A.LW_ID,LW_LINEOFWORK,SUBSTRING(B.LW_LINEOFWORK, 0,CHARINDEX(' ',B.LW_LINEOFWORK)) SUB_LINEOFWORK,LW_AREA FROM VEHICLECARTYPEMATCHGROUP A LEFT JOIN LINEWORK B ON A.LW_ID = B.LW_ID 
                                                WHERE LW_STATUS = 'Y' AND A.VHCTMG_VEHICLEREGISNUMBER = :VEHICLEREGISNUMBER");
                                                $stmt_selcartype->execute(array(":VEHICLEREGISNUMBER" => $VEHICLEREGISNUMBER));
                                                $result_selcartype = $stmt_selcartype->fetch(PDO::FETCH_OBJ);
                                                if(isset($result_selcartype->LW_LINEOFWORK)){
                                                    $LW_LINEOFWORK = $result_selcartype->LW_LINEOFWORK;
                                                    $SUB_LINEOFWORK = $result_selcartype->SUB_LINEOFWORK;
                                                    echo $LW_LINEOFWORK;
                                                }else{
                                                    $LW_LINEOFWORK = "";
                                                    $SUB_LINEOFWORK = "";
                                                    echo $LW_LINEOFWORK;
                                                }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <div class="flex justify-center gap-2">                                                                           
                                                <button aria-label="button" data-modal-target="conditionPDF" 
                                                data-regis="<?= $rs_car->VEHICLEREGISNUMBER ?>" 
                                                data-thainame="<?= $rs_car->THAINAME ?>" 
                                                data-lineofwork="<?= $LW_LINEOFWORK ?>" 
                                                data-sublineofwork="<?= $SUB_LINEOFWORK ?>" 
                                                type="button" class="open-AddRegisDialog text-white btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20">PDF</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    <?php require_once($path.'include/footer.php'); ?>
    </div>
</div>
<!-- INSERT MODAL -->
<div id="conditionPDF" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b dark:border-zink-300/20">
            <h5 class="text-16">เลือกเงื่อนไขรายงาน</h5>
            <button aria-label="button" data-modal-close="conditionPDF" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto modal-body">
            <form name="form1" method="post">                
                <div class="grid grid-cols-3 gap-2 md:grid-cols-2 xl:grid-cols-3">
                    <div class="mb-3">
                        <label for="userId" class="inline-block mb-2 text-base font-medium">ทะเบียนรถ</label>
                        <input type="text" name="REGIS" id="REGIS" value="" class="form-input bg-slate-200 border-slate-300 focus:outline-none focus:border-custom-500" placeholder="ทะเบียนรถ" autocomplete="off" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="userId" class="inline-block mb-2 text-base font-medium">ชื่อรถ</label>
                        <input type="text" name="THAINAME" id="THAINAME" value="" class="form-input bg-slate-200 border-slate-300 focus:outline-none focus:border-custom-500" placeholder="ชื่อรถ" autocomplete="off" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="userId" class="inline-block mb-2 text-base font-medium">สายงาน</label>
                        <input type="text" name="LINEOFWORK" id="LINEOFWORK" value="" class="form-input bg-slate-200 border-slate-300 focus:outline-none focus:border-custom-500" placeholder="สายงาน" autocomplete="off" readonly>
                    </div>
                </div>           
                <div id="content1" class="grid grid-cols-3 gap-2 md:grid-cols-2 xl:grid-cols-2">
                    <div class="mb-3">
                        <label for="userId" class="inline-block mb-2 text-base font-medium">เลือกสัปดาห์</label>             
                        <div class="flex items-center gap-2">
                            <input type="week" name="GETWEEK" id="GETWEEK" autocomplete="off" value="<?php echo $datenow; ?>" class="datepic form-input p-2 border-slate-300 focus:outline-none focus:border-custom-500">
                        </div>   
                    </div>
                    <div class="mb-3">
                        <label for="joiningDateInput" class="inline-block mb-2 text-base font-medium">เลือกช่วงเวลา</label>
                        <select name="PERIODTIMEGW" id="PERIODTIMEGW" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices-search-false="">
                            <option value="กลางวัน" <?php if($PERIODTIME=="กลางวัน"){echo "selected";}else{echo "";}?>>กลางวัน</option>
                            <option value="กลางคืน" <?php if($PERIODTIME=="กลางคืน"){echo "selected";}else{echo "";}?>>กลางคืน</option>
                        </select>
                    </div>
                </div>
                <div id="content2" class="grid grid-cols-3 gap-2 md:grid-cols-2 xl:grid-cols-3">
                    <div class="mb-3">
                        <label for="userId" class="inline-block mb-2 text-base font-medium">เลือกเดือน</label>
                        <select name="GETMONTH" id="GETMONTH" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices-search-false="">
                            <option value="มกราคม" <?php if($GETMONTH=="มกราคม"){echo "selected";}else{echo "";}?>>มกราคม</option>
                            <option value="กุมภาพันธ์" <?php if($GETMONTH=="กุมภาพันธ์"){echo "selected";}else{echo "";}?>>กุมภาพันธ์</option>
                            <option value="มีนาคม" <?php if($GETMONTH=="มีนาคม"){echo "selected";}else{echo "";}?>>มีนาคม</option>
                            <option value="เมษายน" <?php if($GETMONTH=="เมษายน"){echo "selected";}else{echo "";}?>>เมษายน</option>
                            <option value="พฤษภาคม" <?php if($GETMONTH=="พฤษภาคม"){echo "selected";}else{echo "";}?>>พฤษภาคม</option>
                            <option value="มิถุนายน" <?php if($GETMONTH=="มิถุนายน"){echo "selected";}else{echo "";}?>>มิถุนายน</option>
                            <option value="กรกฎาคม" <?php if($GETMONTH=="กรกฎาคม"){echo "selected";}else{echo "";}?>>กรกฎาคม</option>
                            <option value="สิงหาคม" <?php if($GETMONTH=="สิงหาคม"){echo "selected";}else{echo "";}?>>สิงหาคม</option>
                            <option value="กันยายน" <?php if($GETMONTH=="กันยายน"){echo "selected";}else{echo "";}?>>กันยายน</option>
                            <option value="ตุลาคม" <?php if($GETMONTH=="ตุลาคม"){echo "selected";}else{echo "";}?>>ตุลาคม</option>
                            <option value="พฤศจิกายน" <?php if($GETMONTH=="พฤศจิกายน"){echo "selected";}else{echo "";}?>>พฤศจิกายน</option>
                            <option value="ธันวาคม" <?php if($GETMONTH=="ธันวาคม"){echo "selected";}else{echo "";}?>>ธันวาคม</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userId" class="inline-block mb-2 text-base font-medium">เลือกปี</label>
                        <select name="GETYEAR" id="GETYEAR" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices-search-false="">
                            <option value="2567" <?php if($GETYEAR=="2567"){echo "selected";}else{echo "";}?>>2567</option>
                            <option value="2568" <?php if($GETYEAR=="2568"){echo "selected";}else{echo "";}?>>2568</option>
                            <option value="2569" <?php if($GETYEAR=="2569"){echo "selected";}else{echo "";}?>>2569</option>
                            <option value="2570" <?php if($GETYEAR=="2570"){echo "selected";}else{echo "";}?>>2570</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="joiningDateInput" class="inline-block mb-2 text-base font-medium">เลือกช่วงเวลา</label>
                        <select name="PERIODTIMEAMT" id="PERIODTIMEAMT" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices-search-false="">
                            <option value="กลางวัน" <?php if($PERIODTIME=="กลางวัน"){echo "selected";}else{echo "";}?>>กลางวัน</option>
                            <option value="กลางคืน" <?php if($PERIODTIME=="กลางคืน"){echo "selected";}else{echo "";}?>>กลางคืน</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="SUB_LINEOFWORK" id="SUB_LINEOFWORK" value="" class="form-input bg-slate-200 border-slate-300 focus:outline-none focus:border-custom-500" autocomplete="off" readonly>
                <div class="flex justify-center gap-2 mt-4 ">    
                    <button aria-label="button" type="button" data-modal-close="conditionPDF" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10" data-modal-close="conditionPDF">ปิด</button>
                    <button aria-label="button" type="button" onclick="redirect_monthly()" class="text-white transition-all duration-200 ease-linear btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20">PDF</button>
                </div>
            </form>
        </div>
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
    $(document).on("click", ".open-AddRegisDialog", function () {
        var regis = $(this).data('regis');
        var thainame = $(this).data('thainame'); 
        var lineofwork = $(this).data('lineofwork');
        var sublineofwork = $(this).data('sublineofwork');
        $(".modal-body #REGIS").val(regis );
        $(".modal-body #THAINAME").val(thainame );
        $(".modal-body #LINEOFWORK").val(lineofwork );
        $(".modal-body #SUB_LINEOFWORK").val(sublineofwork );
        // alert(sublineofwork)
        if (sublineofwork==='4L') { // alert("111")
            content2.classList.remove('block');     content2.classList.add('hidden');
            content1.classList.remove('hidden');    content1.classList.add('block');
        } else if (sublineofwork==='RCC') { // alert("222")
            content2.classList.remove('block');     content2.classList.add('hidden');
            content1.classList.remove('hidden');    content1.classList.add('block');
        } else if (sublineofwork==='RATC') {    // alert("333")
            content2.classList.remove('block');     content2.classList.add('hidden');
            content1.classList.remove('hidden');    content1.classList.add('block');
        } else {    // alert("444")
            content1.classList.remove('block');     content1.classList.add('hidden');
            content2.classList.remove('hidden');    content2.classList.add('block');
        }
        // As pointed out in comments, 
        // it is unnecessary to have to manually call the modal.
        // $('#AddRegisDialog').modal('show');
    });
</script>
</body>
</html>