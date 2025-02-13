<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='ใบตรวจสภาพ.html';
    $_SESSION['DROPDOWN']='null';
    // Generate Code
    $n=6;
    function RandNum($n) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }      
        return $randomString;
    }  

    if(isset($_POST['rg'])){
        if($_POST['rg']!=""){
            $RGNB = $_POST['rg'];
        }else{
            $RGNB = "xx-xxxx";
        }
    }else if(isset($_SESSION["AD_REGISTRATION"])){
        if($_SESSION["AD_REGISTRATION"]!=""){
            $RGNB = $_SESSION["AD_REGISTRATION"];
        }else{
            $RGNB = "xx-xxxx";
        }
    }else{
        $RGNB = "xx-xxxx";
    }
    
    if(isset($_POST['period'])){
        $SS_PERIOD = $_POST['period'];
    }else if(isset($_SESSION["AD_REGISTRATION"])){
        $SS_PERIOD = $_SESSION["AD_PERIOD"];
    }

    if($RGNB == '00-00GW'){ 
        $sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis");
        $sql_get_data->execute(array(':proc'=>'select_cartestgw',':regis'=>'00-00GW',));
    }else{ 
        $sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis");
        $sql_get_data->execute(array(':proc'=>'select_data',':regis'=>$RGNB,));
    } 
    $rs_get_data = $sql_get_data->fetch(PDO::FETCH_OBJ); 
    if ($rs_get_data) {
        $rsVEHICLEREGISNUMBER = $rs_get_data->VEHICLEREGISNUMBER; 
        $rsTHAINAME = $rs_get_data->THAINAME;
    } else {
        $rsVEHICLEREGISNUMBER = "-";
        $rsTHAINAME = "-";
    }

    if(isset($_POST['rg'])||isset($_SESSION["AD_REGISTRATION"])){
        if($RGNB == '00-00GW'){ 
            $SSPSC = $_SESSION['AD_PERSONCODE'];
            $sql_check_process = $conn->prepare("EXECUTE ENB_SHEETEXAMSELECT :proc,:regis,:dateins,:person,:code,:shid,:num");
            $sql_check_process->execute(array(':proc'=>'check_processcartestgw',':regis'=>$RGNB,':dateins'=>date('Y-m-d'),':person'=>$SSPSC,':code'=>$SS_PERIOD,':shid'=>'',':num'=>'',));
        }else{ 
            $sql_check_process = $conn->prepare("EXECUTE ENB_SHEETEXAMSELECT :proc,:regis,:dateins,:person,:code,:shid,:num");
            $sql_check_process->execute(array(':proc'=>'check_process',':regis'=>$RGNB,':dateins'=>date('Y-m-d'),':person'=>'',':code'=>$SS_PERIOD,':shid'=>'',':num'=>'',));
        } 
        $rs_check_process = $sql_check_process->fetch(PDO::FETCH_OBJ);
        if ($rs_check_process) {
            $rsSHLR_CODE=$rs_check_process->SHLR_CODE;
            $rsSHLR_PERIODTIME=$rs_check_process->SHLR_PERIODTIME;
        } else {
            $rsSHLR_CODE=null;
            $rsSHLR_PERIODTIME=null;
        }
    }
    if(isset($rsSHLR_CODE) && $rsSHLR_PERIODTIME==$SS_PERIOD){
        $_SESSION['SHLR_CODE']=$rsSHLR_CODE;
    }else{
        $_SESSION['SHLR_CODE']="SHLR_".RandNum($n);
    }
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
                        <h5 class="text-16">ข้อมูลใบตรวจสภาพรถ</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <?php if(isset($_SESSION["AD_REGISTRATION"])){if($_SESSION["AD_REGISTRATION"]==''){ ?>
                                <form name="form1" method="post" action="ใบตรวจสภาพ.html">
                                    <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-3">
                                        <div class="mb-3">
                                            <label class="inline-block mb-2 text-base font-medium">เลือกทะเบียนรถ / ชื่อรถ</label>
                                            <select required name="rg" id="rg" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="">
                                                <option value="">------โปรดเลือก------</option>
                                                <?php 
                                                    if($_SESSION["AD_AREA"]=="AMT"){
                                                        $wharea='AMT';
                                                    }else if($_SESSION["AD_AREA"]=="GW"){
                                                        $wharea='GW';
                                                    }
                                                    $sql_rgnb = $conn->prepare("EXECUTE ENB_VEHICLEINFO :proc,:regis,:area");
                                                    $sql_rgnb->execute(array(':proc'=>'select_all',':regis'=>'',':area'=>$wharea,));
                                                    while($rs_rgnb = $sql_rgnb->fetch(PDO::FETCH_OBJ)) { 
                                                ?>
                                                <option value="<?php echo $rs_rgnb->VEHICLEREGISNUMBER ?>" <?php if($RGNB==$rs_rgnb->VEHICLEREGISNUMBER){echo "selected";}else{echo "";};?>><?php echo $rs_rgnb->VEHICLEREGISNUMBER.' / '.$rs_rgnb->THAINAME ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="period" class="inline-block mb-2 text-base font-medium">Shift / เลือกกะ</label>
                                            <select required name="period" id="period" class="form-select dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-600 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                <option value="">---โปรดเลือกกะ---</option>
                                                <option value="DAY" <?php if($SS_PERIOD=='DAY'){echo "selected";}else{echo "";};?>>กะกลางวัน / Day Shift</option>
                                                <option value="NIGHT" <?php if($SS_PERIOD=='NIGHT'){echo "selected";}else{echo "";};?>>กะกลางคืน / Night Shift</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="inline-block mb-2 text-base font-medium">&nbsp;</label><br>
                                            <button aria-label="button" type="submit" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">ค้นหา</button>
                                        </div>
                                    </div>
                                </form>
                            <?php }} ?>
                            <div class="p-5 border rounded-md md:p-8 border-slate-200 dark:border-zink-500 print:p-0">
                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                                    <div class="text-center xl:col-span-3 ltr:xl:text-left rtl:xl:text-right">
                                        <h5 class=" mb-1">ข้อมูลใบตรวจสภาพรถ</h5>
                                        <p class="text-slate-500 dark:text-zink-200">ประจำวันที่ <?php echo thai_date_dmy(time())?></p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 mt-6 text-center divide-y md:divide-y-0 md:divide-x rtl:divide-x-reverse divide-dashed md:grid-cols-4 divide-slate-200 dark:divide-zink-500">
                                    <div class="p-3">
                                        <h6 class="mb-1"><?php if(isset($rsVEHICLEREGISNUMBER)){echo $rsVEHICLEREGISNUMBER;}else{echo "-";}?></h6>
                                        <p class="text-slate-500 dark:text-zink-200">หมายเลขทะเบียน (หัว)</p>
                                    </div>
                                    <div class="p-3">
                                        <h6 class="mb-1"><?php if(isset($rsTHAINAME)){echo $rsTHAINAME;}else{echo "-";}?></h6>
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
                                        $display='';
                                    }else{
                                        $showlw='<font color="red"><b>ไม่ได้เลือกสายงาน</b></font>';
                                        $showct='0';
                                        $display='none';
                                    }
                                    ?>
                                    <div class="grow">
                                        <p class="mb-2 text-slate-500 dark:text-zink-200"><font size="3"><b>ข้อมูลอื่น</b></font></p>
                                        <p class="mb-1 text-slate-500 dark:text-zink-200">ใบตรวจสภาพรถสายงาน: <b><?php echo $showlw;?></b></p>
                                        <p class="mb-1 text-slate-500 dark:text-zink-200">หัวข้อตรวจสอบจำนวน: <b><?php echo $showct;?></b> ข้อ</p>
                                        <p class="mb-0 text-slate-500 dark:text-zink-200">พขร.ผู้ทำการตรวจสอบ: <b><?php echo $_SESSION["AD_NAMETHAI"];?></b></p>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <?php if(isset($rs_check_process->SHLC_STATUS) && $rs_check_process->SHLR_PERIODTIME==$SS_PERIOD){ ?>
                                            <?php if($rs_check_process->SHLC_STATUS=='wait'){ ?>
                                                <button style="display:<?php echo $display; ?>" type="button" onclick="RedirectQuestionContinue(<?php echo $rs_check_process->SHL_NUMBER;?>,'<?php echo $RGNB;?>','<?php echo $rs_get_data->SH_ID;?>','<?php echo $rs_check_process->SHLR_PERIODTIME;?>','<?php echo $sublw;?>','<?php echo date('Y-m-d');?>')" class="bt_exam text-white bg-orange-500 border-orange-500 btn hover:text-white hover:bg-orange-600 hover:border-orange-600 focus:text-white focus:bg-orange-600 focus:border-orange-600 focus:ring focus:ring-orange-100 active:text-white active:bg-orange-600 active:border-orange-600 active:ring active:ring-orange-100 dark:ring-orange-400/10">
                                                    ดำเนินการต่อจากเดิม
                                                </button>
                                            <?php }else if($rs_check_process->SHLC_STATUS=='success'){ ?>
                                                <button style="display:<?php echo $display; ?>" type="button" class="bt_exam text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                    ตรวจสภาพรถเรียบร้อย
                                                </button>
                                            <?php }else if($rs_check_process->SHLC_STATUS=='stopchecking'){ ?>
                                                <button style="display:<?php echo $display; ?>" type="button" class="bt_exam text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">
                                                    หยุดการตรวจสอบแล้ว
                                                </button>
                                            <?php } ?>
                                        <?php }else{ ?>
                                                <button style="display:<?php echo $display; ?>" type="button" onclick="RedirectQuestion(1,'<?php echo $RGNB;?>','<?php echo $rs_get_data->SH_ID;?>','<?php echo $sublw;?>','<?php echo $SS_PERIOD;?>','<?php echo date('Y-m-d');?>')" class="bt_exam text-white bg-purple-500 border-purple-500 btn hover:text-white hover:bg-purple-600 hover:border-purple-600 focus:text-white focus:bg-purple-600 focus:border-purple-600 focus:ring focus:ring-purple-100 active:text-white active:bg-purple-600 active:border-purple-600 active:ring active:ring-purple-100 dark:ring-purple-400/10">
                                                    เริ่มบันทึกการตรวจสภาพรถ
                                                </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php if($_SESSION['AD_ROLE_NAME']!='DRIVER'){ ?>
                                <br>
                                <div class="flex justify-center gap-2">
                                    <a href="ภาพรวม.html">
                                        <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                            <i data-lucide="undo-2" class="inline-block size-4"></i> <span class="align-middle">ย้อนกลับ</span>
                                        </button>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
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
<script src="assets/js/datatables/jszip.min.js"></script>
<script src="assets/js/datatables/pdfmake.min.js"></script>
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<script src="assets/js/datatables/buttons.print.min.js"></script>
<script src="assets/js/datatables/datatables.init.js"></script>
</body>
</html>