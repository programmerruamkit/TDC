
<?php
    $path = "../../"; 
    require_once($path.'config/connect.php');
    $regis=$_GET['regis'];
    $num=$_GET['num'];
    $shid=$_GET['shid'];
    $time=$_GET['time'];
    $datenow=$_GET['datenow'];
    if($time=='DAY'){
        $rstime='กลางวัน';
    }else if($time=='NIGHT'){
        $rstime='กลางคืน';
    }
    $SHLR_CODE=$_SESSION['SHLR_CODE'];
    if($regis == '00-00GW'){ 
        $sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis,:num");
        $sql_get_data->execute(array(':proc'=>'select_cartestgw',':regis'=>$regis,':num'=>$num,));
    }else{ 
        $sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis,:num");
        $sql_get_data->execute(array(':proc'=>'select_data',':regis'=>$regis,':num'=>$num,));
    }    
    $rs_get_data = $sql_get_data->fetch(PDO::FETCH_OBJ);  
    $sublw=$rs_get_data->SUB_LINEOFWORK;
    if($sublw=="4L"||$sublw=="RCC"||$sublw=="RATC"){
        $showct=$rs_get_data->COUNTSHID;
    }else{
        $showct=$rs_get_data->COUNTSHID+1;
    }
    
    if($regis == '00-00GW'){ 
        $sql_get_exam = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis,:num");
        $sql_get_exam->execute(array(':proc'=>'select_examcartestgw',':regis'=>$regis,':num'=>$num,));
    }else{ 
        $sql_get_exam = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis,:num");
        $sql_get_exam->execute(array(':proc'=>'select_exam',':regis'=>$regis,':num'=>$num,));
    } 
    $rs_get_exam = $sql_get_exam->fetch(PDO::FETCH_OBJ);    
    
    $check_select = $conn->prepare("EXECUTE ENB_SHEETEXAMSELECT :proc,:regis,:dateins,:person,:code,:shid,:num");
    $check_select->execute(array(':proc'=>'check_select',':regis'=>'',':dateins'=>'',':person'=>'',':code'=>$SHLR_CODE,':shid'=>$shid,':num'=>$num,));
    $rs_check_select = $check_select->fetch(PDO::FETCH_OBJ);
?>
<div class="grid grid-cols-1 gap-4 md:grid-cols-1 border-2 border-white">
    <div class="flex flex-col gap-2">
        <?php 
            if($_GET['num']==1){                                                     
                if($sublw=="4L"||$sublw=="RCC"||$sublw=="RATC"){
                    if($rs_get_exam->SHL_PERIODTIME=='TRAILLERDEISEL'){
                        echo '<center><font size="4" color="red"><b>เทรลเลอร์ดีเซล</b></font></center>';
                    }else if($rs_get_exam->SHL_PERIODTIME=='TRAILLERTYPEBELT'){
                        echo '<center><font size="4" color="green"><b>เทรลเลอร์ชนิดที่ใช้สายเบลท์ รัดล้อ</b></font></center>';
                    }
                    // echo '<font size="2">หัวข้อตรวจสอบ</font>';
                    echo '<font size="4">'.$_GET['num'].'. '.$rs_get_exam->SHL_NAME.'</font>';
                    echo '<font size="4">'.$rs_get_exam->DESCRIPTION.'</font>';
                    // echo '<font size="2"><b>วิธีการตรวจ</b> : ถ้าปกติพร้อมใช้งานให้ทำเครื่องหมายถูก ในช่องผล ถ้าผิดปกติไม่พร้อมใช้งานให้ทำเครื่องหมายผิด ในช่องผลพร้อมระบุสิ่งที่ผิดปกติ</font>';
                }else{
                    echo '<center><font size="4" color="red"><b>ก่อนติดเครื่องยนต์</b></font></center>';
                    // echo '<font size="2">หัวข้อตรวจสอบ</font>';
                    echo '<font size="4">1. ป้ายภาษีหมดอายุ: '.$rs_get_data->DATEEXPIRE.' '.$rs_get_data->DATEEXPIRE_YEAR.'</font>';
                    echo '<font size="2">มาตรฐานการตรวจสอบ: ระดับ A ใช้วิธีการ ตา,มือ</font>';
                    echo '<font size="4">ไม่ฉีกขาด, ลอกหลุด, สูญหาย</font>';
                }
            }else{                                 
                if($sublw=="4L"||$sublw=="RCC"||$sublw=="RATC"){
                    if($rs_get_exam->SHL_PERIODTIME=='TRAILLERDEISEL'){
                        echo '<center><font size="4" color="red"><b>เทรลเลอร์ดีเซล</b></font></center>';
                    }else if($rs_get_exam->SHL_PERIODTIME=='TRAILLERTYPEBELT'){
                        echo '<center><font size="4" color="green"><b>เทรลเลอร์ชนิดที่ใช้สายเบลท์ รัดล้อ</b></font></center>';
                    }
                    // echo '<font size="2">หัวข้อตรวจสอบ</font>';
                    echo '<font size="4">'.$_GET['num'].'. '.$rs_get_exam->SHL_NAME.'</font>';
                    echo '<font size="4">'.$rs_get_exam->DESCRIPTION.'</font>';
                    // echo '<font size="2"><b>วิธีการตรวจ</b> : ถ้าปกติพร้อมใช้งานให้ทำเครื่องหมายถูก ในช่องผล ถ้าผิดปกติไม่พร้อมใช้งานให้ทำเครื่องหมายผิด ในช่องผลพร้อมระบุสิ่งที่ผิดปกติ</font>';
                }else{
                    if($rs_get_exam->SHL_PERIODTIME=='BEFORESTART'){
                        echo '<center><font size="4" color="red"><b>ก่อนติดเครื่องยนต์</b></font></center>';
                    }else if($rs_get_exam->SHL_PERIODTIME=='AFTERSTART'){
                        echo '<center><font size="4" color="green"><b>หลังติดเครื่องยนต์</b></font></center>';
                    }else if($rs_get_exam->SHL_PERIODTIME=='TRAILLER'){
                        echo '<center><font size="4" color="blue"><b>เทรลเลอร์</b></font></center>';
                    }else if($rs_get_exam->SHL_PERIODTIME=='BELT'){
                        echo '<center><font size="4" color="black"><b>Belt</b></font></center>';
                    }else if($rs_get_exam->SHL_PERIODTIME=='WIRE'){
                        echo '<center><font size="4" color="brown"><b>WIRE</b></font></center>';
                    }
                    // echo '<font size="2">หัวข้อตรวจสอบ</font>';
                    echo '<font size="4">'.$_GET['num'].'. '.$rs_get_exam->SHL_NAME.'</font>';
                    echo '<font size="4">'.$rs_get_exam->DESCRIPTION.'</font>';
                    echo '<font size="2">มาตรฐานการตรวจสอบ: ระดับ '.$rs_get_exam->SHL_RANK.' ใช้วิธีการ '.$rs_get_exam->SHL_HOWTO.'</font>';
                }
            } 
        ?>
        <div class="flex items-center gap-2 justify-center">
            <input type="radio" value="normal" id="param1" name="CHOICE" <?php if(isset($rs_check_select->SHLR_SELECT)){if($rs_check_select->SHLR_SELECT=='normal'){echo 'checked';}}else{echo '';};?> onclick="HideProblems(),Save_Question('add','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','SHLR_SELECT','normal','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="border rounded-full cursor-pointer size-8 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500">
            <label for="CHK1" class="align-middle">ปกติ</label>&ensp;
            <input type="radio" value="abnormal" id="param2" name="CHOICE" <?php if(isset($rs_check_select->SHLR_SELECT)){if($rs_check_select->SHLR_SELECT=='abnormal'){echo 'checked';}}else{echo '';};?> onclick="ShowProblems(),Save_Question('add','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','SHLR_SELECT','abnormal','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="border rounded-full cursor-pointer size-8 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500">
            <label for="CHK2" class="align-middle">ผิดปกติ</label>&ensp;
            <input type="radio" value="not_use" id="param3" name="CHOICE" <?php if(isset($rs_check_select->SHLR_SELECT)){if($rs_check_select->SHLR_SELECT=='not_use'){echo 'checked';}}else{echo '';};?> onclick="HideProblems(),Save_Question('add','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','SHLR_SELECT','not_use','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="border rounded-full cursor-pointer size-8 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500">
            <label for="CHK3" class="align-middle">ไม่ได้ใช้งาน</label>
        </div>
        <?php 
            if(isset($rs_check_select->SHLR_SELECT)){
                if($rs_check_select->SHLR_SELECT=='abnormal'){
                    $display='display:block';
                    if(isset($rs_check_select->SHLR_IMG2)){
                        if($rs_check_select->SHLR_IMG2!=''){
                            $display2='display:block';
                        }else{
                            $display2='display:none';
                        }
                    }else{
                        $display2='display:none';
                    }
                }else{
                    $display='display:none';
                    $display2='display:none';
                }
            }else{
                $display='display:none';
                $display2='display:none';
            }
            if(isset($rs_check_select->USE_TAB)){
                if($rs_check_select->USE_TAB=='tab-1'){
                    $activetab1='bg-custom-500 text-white';
                    $activetab2='bg-white text-custom-500';
                    $displaytab1='display:block';
                    $displaytab2='display:none';
                }else{
                    $activetab1='bg-white text-custom-500';
                    $activetab2='bg-custom-500 text-white';
                    $displaytab1='display:none';
                    $displaytab2='display:block';
                }
            }else{
                $activetab1='bg-custom-500 text-white';
                $activetab2='bg-white text-custom-500';
                $displaytab1='display:block';
                $displaytab2='display:none';
            }
            if(isset($rs_check_select->RPRQ_SAVE_REPAIR)){
                if($rs_check_select->RPRQ_SAVE_REPAIR=='1'){
                    $displaystop='display:block';
                }else{
                    $displaystop='display:none';
                }
            }else{
                $displaystop='display:none';
            }
        ?>
        <div class="mb-3" id="divproblems" style="<?php echo $display;?>">
            <div>
                <ul class="flex flex-wrap w-full text-sm font-medium text-center border-b border-slate-200 dark:border-zink-500 nav-tabs">
                    <li class="group grow py-1 text-xs px-1.5 <?php echo $activetab1;?> border border-custom-500 rounded-l-md hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:bg-zink-700 dark:hover:bg-custom-500 dark:ring-custom-400/20 dark:focus:bg-custom-500">
                        <a href="javascript:void(0);" data-tab-toggle="" data-target="divtab1" id="tab1" onclick="activateTab('tab1','tab2'),resetTab2(),nullrepair('nullnorepair','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','<?php if(isset($rs_check_select->SHLR_IMG1)){echo $rs_check_select->SHLR_IMG1;}else{echo null;} ?>','<?php if(isset($rs_check_select->SHLR_IMG2)){echo $rs_check_select->SHLR_IMG2;}else{echo null;} ?>','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','tab-1')" class="relative inline-block px-4 w-full py-2 text-base -mb-[1px] ">ลงข้อมูล</a>
                    </li>
                    <li class="group grow py-1 text-xs px-1.5 <?php echo $activetab2;?> border border-custom-500 rounded-r-md hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:bg-zink-700 dark:hover:bg-custom-500 dark:ring-custom-400/20 dark:focus:bg-custom-500">
                        <a href="javascript:void(0);" data-tab-toggle="" data-target="divtab2" id="tab2" onclick="activateTab('tab2','tab1'),resetTab1(),nullrepair('nullnorepair','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','<?php if(isset($rs_check_select->SHLR_IMG1)){echo $rs_check_select->SHLR_IMG1;}else{echo null;} ?>','<?php if(isset($rs_check_select->SHLR_IMG2)){echo $rs_check_select->SHLR_IMG2;}else{echo null;} ?>','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','tab-2')" class="relative inline-block px-4 w-full py-2 text-base -mb-[1px]">ลงข้อมูลพร้อมส่งแจ้งซ่อม</a>
                    </li>
                </ul>
                <div class="mt-5 tab-content">
                    <div id="divtab1" style="<?php echo $displaytab1;?>">
                        <center><u><h4>บันทึกข้อมูลสิ่งผิดปกติ</h4></u></center>
                        <div class="mb-3">
                            <label for="param4" class="inline-block mb-2 text-base font-medium">ปัญหาที่พบ</label>
                            <input type="text" name="param4" id="param4" placeholder="กรอกปัญหาที่พบ" autocomplete="off" required value="<?php if(isset($rs_check_select->SHLR_REMARK)){echo $rs_check_select->SHLR_REMARK;}else{echo '';};?>" onkeyup="Save_Question('addremark','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','SHLR_REMARK',this.value,'<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                        </div>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-2 xl:grid-cols-2">
                            <div class="mb-3">
                                <label for="image1" class="inline-block mb-2 text-base font-medium">อัพโหลดรูปภาพ 1</label>
                                <form id="form_upimg1" method="post" enctype="multipart/form-data">
                                    <div class="flex flex-wrap gap-3">
                                        <div class="xl:col-span-6">
                                            <input type="file" name="image1" id="image1" accept="image/png, image/gif, image/jpeg, image/jpg, image/tif" value="0" class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                        </div>
                                        <div class="xl:col-span-6">
                                            <div class="flex flex-wrap gap-3">
                                                <button type="submit" value="Upload" class="text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                                    อัพโหลดรูปภาพ 1
                                                </button>
                                                <button type="button" onclick="AddImagesQuestion()" class="flex rounded-full items-center justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="keyword" value="check_sheet_question">   
                                    <input type="hidden" name="PROC" value="addimage">   
                                    <input type="hidden" name="a1" value="<?php echo $SHLR_CODE;?>">   
                                    <input type="hidden" name="a2" value="<?php echo $shid; ?>">   
                                    <input type="hidden" name="a3" value="<?php echo $num; ?>">
                                    <input type="hidden" name="a4" value="SHLR_IMG1">   
                                    <input type="hidden" name="a5" value="<?php if(isset($rs_check_select->SHLR_IMG1)){echo $rs_check_select->SHLR_IMG1;}else{echo null;} ?>">   
                                    <input type="hidden" name="a6" value="<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>">   
                                    <input type="hidden" name="a7" value="<?php echo $datenow;?>">  
                                    <input type="hidden" name="a8" value="<?php echo $time;?>">
                                </form>
                            </div>
                            <div class="mb-3">
                                <div id="divaddimages" style="<?php echo $display2;?>">
                                    <label for="image2" class="inline-block mb-2 text-base font-medium">อัพโหลดรูปภาพ 2</label>
                                    <form id="form_upimg2" method="post" enctype="multipart/form-data">
                                        <div class="flex flex-wrap gap-3">
                                            <div class="xl:col-span-6">
                                                <input type="file" name="image2" id="image2" accept="image/png, image/gif, image/jpeg, image/jpg, image/tif" value="0" class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                            </div>
                                            <div class="xl:col-span-6">
                                                <div class="flex flex-wrap gap-3">
                                                    <button type="submit" class="text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                                        อัพโหลดรูปภาพ 2
                                                    </button>
                                                    <button type="button" onclick="DeleteImagesQuestion()" class="flex rounded-full items-center justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-minus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="keyword" value="check_sheet_question">   
                                        <input type="hidden" name="PROC" value="addimage">   
                                        <input type="hidden" name="a1" value="<?php echo $SHLR_CODE;?>">   
                                        <input type="hidden" name="a2" value="<?php echo $shid; ?>">   
                                        <input type="hidden" name="a3" value="<?php echo $num; ?>">
                                        <input type="hidden" name="a4" value="SHLR_IMG2">   
                                        <input type="hidden" name="a5" value="<?php if(isset($rs_check_select->SHLR_IMG2)){echo $rs_check_select->SHLR_IMG2;}else{echo '';} ?>">   
                                        <input type="hidden" name="a6" value="<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>">   
                                        <input type="hidden" name="a7" value="<?php echo $datenow;?>">  
                                        <input type="hidden" name="a8" value="<?php echo $time;?>">
                                    </form>
                                </div>
                            </div>
                            <font color="red"><b>***เมื่อเลือกรูปแล้ว อย่าลืมกดอัพโหลดรูปภาพ</b></font>
                            <div id="preview_upimg1"></div>
                            <div id="preview_upimg2"></div>
                            <?php
                                if(isset($rs_check_select->SHLR_IMG1)){
                                    if($rs_check_select->SHLR_IMG1!=''){
                                        echo "<div class='mb-3' id='hideimages1'><b>รูปภาพเดิม</b><img src='uploads/$rs_check_select->SHLR_IMG1' width='50%'></div>";
                                    }
                                }
                                if(isset($rs_check_select->SHLR_IMG2)){
                                    if($rs_check_select->SHLR_IMG2!=''){
                                        echo "<div class='mb-3' id='hideimages2'><b>รูปภาพเดิม</b><img src='uploads/$rs_check_select->SHLR_IMG2' width='50%'></div>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div id="divtab2" style="<?php echo $displaytab2;?>">
                        <center><u><h4>บันทึกข้อมูลสิ่งผิดปกติ พร้อมกดส่งแจ้งซ่อม</h4></u></center>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-2 xl:grid-cols-3">
                            <div class="mb-3">
                                <label for="datetimeRequest_in" class="inline-block mb-2 text-base font-medium">วันที่นำรถเข้าซ่อม</label>
                                    <input type="datetime-local" id="datetimeRequest_in" autocomplete="off" value="<?php if(isset($rs_check_select->RPRQ_REQUESTCARDATE)){echo $rs_check_select->RPRQ_REQUESTCARDATE.' '.$rs_check_select->RPRQ_REQUESTCARTIME;}else{echo '';};?>" onchange="Save_Question('addrequest','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','RPRQ_REQUESTCARDATETIME',this.value,'<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-black dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="datetimeRequest_out" class="inline-block mb-2 text-base font-medium">วันที่ต้องการใช้รถ</label>
                                    <input type="datetime-local" id="datetimeRequest_out" autocomplete="off" value="<?php if(isset($rs_check_select->RPRQ_USECARDATE)){echo $rs_check_select->RPRQ_USECARDATE.' '.$rs_check_select->RPRQ_USECARTIME;}else{echo '';};?>" onchange="Save_Question('addrequest','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','RPRQ_USECARDATETIME',this.value,'<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-black dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="RPRQ_REQUESTBY_SQ" class="inline-block mb-2 text-base font-medium">ผู้รับแจ้งซ่อม SQ</label>
                                <select name="RPRQ_REQUESTBY_SQ" id="RPRQ_REQUESTBY_SQ" onchange="Save_Question('addrequest','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','RPRQ_REQUESTBY_SQ',this.value,'<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices-search-false="">
                                    <option value="">---เลือกผู้รับแจ้งซ่อม SQ---</option>
                                    <?php
                                        $SESSION_AREA = $_SESSION["AD_AREA"];
                                        $qr_vwpositionsq = $conn->prepare("EXECUTE ENB_MAINTENANCE :proc,:area");
                                        $qr_vwpositionsq->execute(array(':proc'=>'select_positionsq',':area'=>$SESSION_AREA,));
                                        while($rs_vwpositionsq = $qr_vwpositionsq->fetch(PDO::FETCH_OBJ)) { 
                                    ?>
                                    <option value="<?php echo $rs_vwpositionsq->nameT?>" <?php if(isset($rs_check_select->RPRQ_REQUESTBY_SQ)){if($rs_vwpositionsq->nameT==$rs_check_select->RPRQ_REQUESTBY_SQ){echo "selected";}}else{echo "";} ?>><?=$rs_vwpositionsq->nameT?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="RPM_NATUREREPAIR" class="inline-block mb-2 text-base font-medium">ลักษณะงานซ่อม</label>
                                <select name="RPM_NATUREREPAIR" id="RPM_NATUREREPAIR" onchange="RepairGroups(this.value, '<?php echo $SESSION_AREA?>'),Save_Question('addrequest','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','RPM_NATUREREPAIR',this.value,'<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices-search-false="">
                                    <option value="">---เลือกลักษณะงานซ่อม---</option>
                                    <option value="EL" <?php if(isset($rs_check_select->RPM_NATUREREPAIR)){if($rs_check_select->RPM_NATUREREPAIR== "EL"){echo "selected";}}else{echo "";} ?>>ระบบไฟ</option>
                                    <option value="TU" <?php if(isset($rs_check_select->RPM_NATUREREPAIR)){if($rs_check_select->RPM_NATUREREPAIR== "TU"){echo "selected";}}else{echo "";} ?>>ยาง ช่วงล่าง</option>
                                    <option value="BD" <?php if(isset($rs_check_select->RPM_NATUREREPAIR)){if($rs_check_select->RPM_NATUREREPAIR== "BD"){echo "selected";}}else{echo "";} ?>>โครงสร้าง</option>
                                    <option value="EG" <?php if(isset($rs_check_select->RPM_NATUREREPAIR)){if($rs_check_select->RPM_NATUREREPAIR== "EG"){echo "selected";}}else{echo "";} ?>>เครื่องยนต์</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="RPRQ_TYPEREPAIRWORK" class="inline-block mb-2 text-base font-medium">กลุ่มงานซ่อม</label>
                                <?php if(isset($rs_check_select->RPRQ_TYPEREPAIRWORK_NAME)){ ?>
                                    <input type="text" name="RPRQ_TYPEREPAIRWORK_NAME" id="RPRQ_TYPEREPAIRWORK_NAME" placeholder="กลุ่มงานซ่อม" autocomplete="off" value="<?php if(isset($rs_check_select->RPRQ_TYPEREPAIRWORK_NAME)){echo $rs_check_select->RPRQ_TYPEREPAIRWORK_NAME;}else{echo '';};?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                <?php }else{ ?>
                                    <select name="RPRQ_TYPEREPAIRWORK" id="RPRQ_TYPEREPAIRWORK" onchange="Save_Question('addrequest','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','RPRQ_TYPEREPAIRWORK',this.value,'<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices-search-false="">
                                        <option value="">---เลือกกลุ่มงานซ่อม---</option>
                                    </select>
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <label for="SHLR_REMARK" class="inline-block mb-2 text-base font-medium">ปัญหาที่พบ</label>
                                <input type="text" name="SHLR_REMARK" id="SHLR_REMARK" placeholder="กรอกปัญหาที่พบ" autocomplete="off" value="<?php if(isset($rs_check_select->SHLR_REMARK)){echo $rs_check_select->SHLR_REMARK;}else{echo '';};?>" onkeyup="Save_Question('addremark','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>','SHLR_REMARK',this.value,'<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-2 xl:grid-cols-2">
                            <div class="mb-3">
                                <label for="image3" class="inline-block mb-2 text-base font-medium">อัพโหลดรูปภาพ 1</label>
                                <form id="form_upimg3" method="post" enctype="multipart/form-data">
                                    <div class="flex flex-wrap gap-3">
                                        <div class="xl:col-span-6">
                                            <input type="file" name="image3" id="image3" accept="image/png, image/gif, image/jpeg, image/jpg, image/tif" value="0" class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                        </div>
                                        <div class="xl:col-span-6">
                                            <div class="flex flex-wrap gap-3">
                                                <button type="submit" value="Upload" class="text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                                    อัพโหลดรูปภาพ 1
                                                </button>
                                                <button type="button" onclick="AddImagesQuestion_Request()" class="flex rounded-full items-center justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="keyword" value="check_sheet_question">   
                                    <input type="hidden" name="PROC" value="addimage">   
                                    <input type="hidden" name="a1" value="<?php echo $SHLR_CODE;?>">   
                                    <input type="hidden" name="a2" value="<?php echo $shid; ?>">   
                                    <input type="hidden" name="a3" value="<?php echo $num; ?>">
                                    <input type="hidden" name="a4" value="SHLR_IMG1">   
                                    <input type="hidden" name="a5" value="<?php if(isset($rs_check_select->SHLR_IMG1)){echo $rs_check_select->SHLR_IMG1;}else{echo null;} ?>">   
                                    <input type="hidden" name="a6" value="<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>">   
                                    <input type="hidden" name="a7" value="<?php echo $datenow;?>">  
                                    <input type="hidden" name="a8" value="<?php echo $time;?>">
                                </form>
                            </div>
                            <div class="mb-3">
                                <div id="divaddimages_repair" style="<?php echo $display2;?>">
                                    <label for="image4" class="inline-block mb-2 text-base font-medium">อัพโหลดรูปภาพ 2</label>
                                    <form id="form_upimg4" method="post" enctype="multipart/form-data">
                                        <div class="flex flex-wrap gap-3">
                                            <div class="xl:col-span-6">
                                                <input type="file" name="image4" id="image4" accept="image/png, image/gif, image/jpeg, image/jpg, image/tif" value="0" class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                            </div>
                                            <div class="xl:col-span-6">
                                                <div class="flex flex-wrap gap-3">
                                                    <button type="submit" class="text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">
                                                        อัพโหลดรูปภาพ 2
                                                    </button>
                                                    <button type="button" onclick="DeleteImagesQuestion_Request()" class="flex rounded-full items-center justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-minus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="keyword" value="check_sheet_question">   
                                        <input type="hidden" name="PROC" value="addimage">   
                                        <input type="hidden" name="a1" value="<?php echo $SHLR_CODE;?>">   
                                        <input type="hidden" name="a2" value="<?php echo $shid; ?>">   
                                        <input type="hidden" name="a3" value="<?php echo $num; ?>">
                                        <input type="hidden" name="a4" value="SHLR_IMG2">   
                                        <input type="hidden" name="a5" value="<?php if(isset($rs_check_select->SHLR_IMG2)){echo $rs_check_select->SHLR_IMG2;}else{echo '';} ?>">   
                                        <input type="hidden" name="a6" value="<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>">   
                                        <input type="hidden" name="a7" value="<?php echo $datenow;?>">  
                                        <input type="hidden" name="a8" value="<?php echo $time;?>">
                                    </form>
                                </div>
                            </div>
                            <font color="red"><b>***เมื่อเลือกรูปแล้ว อย่าลืมกดอัพโหลดรูปภาพ</b></font>
                            <div id="preview_upimg3"></div>
                            <div id="preview_upimg4"></div>
                            <?php
                                if(isset($rs_check_select->SHLR_IMG1)){
                                    if($rs_check_select->SHLR_IMG1!=''){
                                        echo "<div class='mb-3' id='hideimages1'><b>รูปภาพเดิม</b><img src='uploads/$rs_check_select->SHLR_IMG1' width='50%'></div>";
                                    }
                                }
                                if(isset($rs_check_select->SHLR_IMG2)){
                                    if($rs_check_select->SHLR_IMG2!=''){
                                        echo "<div class='mb-3' id='hideimages2'><b>รูปภาพเดิม</b><img src='uploads/$rs_check_select->SHLR_IMG2' width='50%'></div>";
                                    }
                                }
                            ?>
                        </div>
                        <center>
                            <button type="button" id="BTNrepairrequest" onclick="RepairRequest('repairrequest','<?php echo $SHLR_CODE;?>','<?php echo $shid; ?>','<?php echo $num; ?>')" class="bt_exam_select text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">
                                <span class="align-middle">ส่งแจ้งซ่อมบำรุง</span> 
                            </button>
                            <br><br>
                            <div id="stopchecking" style="<?php echo $displaystop;?>">
                                <font color="red"><b>***ถ้าหากปัญหานี้ เป็นปัญหาร้ายแรง ไม่สามารถใช้รถคันนี้ต่อได้ และจำเป็นต้องเปลี่ยนรถ โปรดกดปุ่ม "หยุดการตรวจสอบ" เพื่อหยุดตรวจสอบใบตรวจสอบใบนี้</b></font><br>
                                <button type="button" onclick="Stop_Checking('stopchecking','<?php echo $SHLR_CODE;?>','','','','','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" class="bt_exam_select text-black bg-yellow-500 border-yellow-500 btn hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/10">
                                    <span class="align-middle"><small>หยุดการตรวจสอบ</small></span> 
                                </button>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>                        
</div>
<div class="flex justify-between gap-2 mt-5">
    <?php if($_GET['num']!=1){ ?>
        <button type="button" data-action="prev" onclick="GoQuestion('<?php echo $_GET['num']-1; ?>','<?php echo $regis;?>','<?php echo $shid;?>','<?php echo $time;?>','<?php echo $datenow;?>')" class="bt_exam_select text-slate-500 btn bg-slate-200 border-slate-200 hover:text-slate-600 hover:bg-slate-300 hover:border-slate-300 focus:text-slate-600 focus:bg-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-100 active:text-slate-600 active:bg-slate-300 active:border-slate-300 active:ring active:ring-slate-100 dark:bg-zink-600 dark:hover:bg-zink-500 dark:border-zink-600 dark:hover:border-zink-500 dark:text-zink-200 dark:ring-zink-400/50">
            <span class="align-middle">ข้อที่ผ่านมา</span>
        </button>
    <?php } ?>
    <?php if($_GET['num']==$showct){ ?>
        <button type="button" onclick="GoQuestion('<?php echo $_GET['num']; ?>','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $rs_get_data->SH_ID;?>','<?php echo $time;?>','<?php echo $datenow;?>');Success_Question('success','<?php echo $SHLR_CODE;?>','','','','','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $datenow;?>','<?php echo $time;?>')" data-action="next" class="bt_exam_select text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
            <span class="align-middle">เสร็จสิ้น</span> 
        </button>
    <?php }else{ ?>
        <button type="button" onclick="GoQuestion('<?php echo $_GET['num']+1; ?>','<?php echo $rs_get_data->VEHICLEREGISNUMBER;?>','<?php echo $rs_get_data->SH_ID;?>','<?php echo $time;?>','<?php echo $datenow;?>')" data-action="next" class="bt_exam_select text-white btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20">
            <span class="align-middle">ข้อถัดไป</span> 
        </button>
    <?php } ?>
</div>
<?php require_once($path.'include/settingtheme.php'); ?>
<?php require_once($path.'include/script.php'); ?>
<script src="assets/js/app.js"></script>