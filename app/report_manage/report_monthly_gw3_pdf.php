<?php
session_name("TRAILER");
session_start();
$path = "../../";   	
require($path.'config/connect.php');
require($path.'assets/pdf/PDF/vendor/autoload.php');

// $_GET['month']=$_GET['month'];
if(isset($_GET['month'])){
    $monthif = $_GET['month'];
    if($monthif == "มกราคม"){
        $month = "01";
    } else if($monthif == "กุมภาพันธ์"){
        $month = "02";
    } else if($monthif == "มีนาคม"){
        $month = "03";
    } else if($monthif == "เมษายน"){
        $month = "04";
    } else if($monthif == "พฤษภาคม"){
        $month = "05";
    } else if($monthif == "มิถุนายน"){
        $month = "06";
    } else if($monthif == "กรกฎาคม"){
        $month = "07";
    } else if($monthif == "สิงหาคม"){
        $month = "08";
    } else if($monthif == "กันยายน"){
        $month = "09";
    } else if($monthif == "ตุลาคม"){
        $month = "10";
    } else if($monthif == "พฤศจิกายน"){
        $month = "11";
    } else if($monthif == "ธันวาคม"){
        $month = "12";
    }
}
$year   =   $_GET['year'];
$dscon  =   $monthif.' ปี '.$year;
// echo $dscon;
$datestart = ($year-543).'-'.$month.'-01';

// $shid=$_GET['shid'];
$time=$_GET['time'];
if($time=='กลางวัน'){
    $period='DAY';
    $cheked1='<img src="../../assets/images/checkbox_true.png" style="width: 15px;">';
    $cheked2='<img src="../../assets/images/checkbox_none.png" style="width: 15px;">';
}else if($time=='กลางคืน'){
    $period='NIGHT';
    $cheked1='<img src="../../assets/images/checkbox_none.png" style="width: 15px;">';
    $cheked2='<img src="../../assets/images/checkbox_true.png" style="width: 15px;">';
}
$sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis");
$sql_get_data->execute(array(':proc'=>'select_data',':regis'=>$_GET['regis'],));
$rs_get_data = $sql_get_data->fetch(PDO::FETCH_OBJ); 

$sql_get_exam = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis,:num");
$sql_get_exam->execute(array(':proc'=>'select_exam',':regis'=>$_GET['regis'],':num'=>1,));
$rs_get_exam = $sql_get_exam->fetch(PDO::FETCH_OBJ);   

$sql_customer = $conn->prepare("EXECUTE ENB_CUSTOMER :proc,:regis,:lwid");
$sql_customer->execute(array(':proc'=>'select_customer',':regis'=>$_GET['regis'],':lwid'=>'',));
$result_customer = $sql_customer->fetch(PDO::FETCH_OBJ);   
                
if($rs_get_data->SUB_LINEOFWORK=="GMT"){
    $finequery="select_report_not1";
}else{
    $finequery="select_report";
}
$query_reportmonth = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:reg,:period,:countgroup,:shid");
$query_reportmonth->execute(array(':proc'=>$finequery,':datenow'=>'',':reg'=>'',':period'=>'',':countgroup'=>'',':shid'=>$rs_get_data->SH_ID,));

$SHFEX = explode("-", $rs_get_data->SH_EFFECT);
$SHFEX1 = substr($SHFEX[0],2)+43;
$SHFEX2 = $SHFEX[1];
$SHFEX3 = $SHFEX[2];

// print_r($SHFEX3.'-'.$SHFEX2.'-'.$SHFEX1);
// exit;

// $mpdf = new mPDF('th',  [180, 297], '0', '');
$mpdf = new mPDF('th', 'A4-L', '0', '');
    $style_section = '<style>
                body{
                    font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
                }
                .textboxcolor {
                    background-color: lightgrey;
                    color: black;
                }
                .textunderline {
                    text-decoration: underline;
                }
                .textlinevirtual {
                    text-decoration: line-through;
                }    
            </style>';
    $style = '
        <style>
            .hide_this_row{
                display :none;
            }
        </style>';
    $amt_section = '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" amt_section="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../assets/css/report.css">
            </head>
            <body style="background-color: #ffffff;">
                <div class="container">';                    
                        if($rs_get_data->SUB_LINEOFWORK=="GMT"){$amt_section .='
                            <div>
                                <div style="float: right; width: 40%;">
                                    <div style="float: left; width: 100%;">
                                        <h2 style="margin-bottom: 1px;"><i><u>ใบตรวจสภาพรถบรรทุก</u></i></h2>
                                        <p style="font-size: 15px; line-height: 1;">กะ'.$time.'&emsp;&emsp;&emsp;เบอร์รถ<u><b> '.$rs_get_data->THAINAME.'</b></u></p>
                                    </div>
                                </div>
                                <div style="float: left; width: 5%;">
                                    <img src="../../assets/images/LogoNewPNG.png" style="width: 50px;">
                                </div>
                                <div style="float: left; width: 45%;">
                                    <p>
                                        &emsp;'.$result_customer->CTM_NAMEEN.' / '.$result_customer->CTM_NAMETH.'<br>
                                        &emsp;เลขที่ '.$result_customer->CTM_ADDRESS.' โทรศัพท์ '.$result_customer->CTM_PHONE.' โทรสาร '.$result_customer->CTM_FAX.'<br>
                                        &emsp;ประจำเดือน '.$dscon.' ประเภทรถ '.$rs_get_data->VEHICLETYPEDESC.' ทะเบียนรถ '.$rs_get_data->VEHICLEREGISNUMBER.'
                                    </p>
                                </div>
                            </div>';
                        }else if($rs_get_data->SUB_LINEOFWORK=="SEMI"){$amt_section .='
                            <div>
                                <div style="float: right; width: 40%;">
                                    <div style="float: left; width: 100%;">
                                        <h2 style="margin-bottom: 1px;"><i><u>ใบตรวจสภาพรถบรรทุก</u></i></h2>
                                        <p style="font-size: 15px; line-height: 1;">กะ'.$time.'&emsp;&emsp;&emsp;เบอร์รถ<u><b> '.$rs_get_data->THAINAME.'</b></u></p>
                                    </div>
                                </div>
                                <div style="float: left; width: 5%;">
                                    <img src="../../assets/images/LogoNewPNG.png" style="width: 50px;">
                                </div>
                                <div style="float: left; width: 45%;">
                                    <p>
                                        &emsp;'.$result_customer->CTM_NAMEEN.' / '.$result_customer->CTM_NAMETH.'<br>
                                        &emsp;เลขที่ '.$result_customer->CTM_ADDRESS.' โทรศัพท์ '.$result_customer->CTM_PHONE.' โทรสาร '.$result_customer->CTM_FAX.'<br>
                                        &emsp;ประจำเดือน '.$dscon.' ประเภทรถ/สายงาน '.$rs_get_data->LW_LINEOFWORK.' ทะเบียนรถ '.$rs_get_data->VEHICLEREGISNUMBER.'
                                    </p>
                                </div>
                            </div>';
                        }else{$amt_section .='
                            <div>
                                <div style="float: right; width: 40%;">
                                    <div style="float: left; width: 60%;">
                                        <h2><i><u>ใบตรวจสภาพรถบรรทุก</u></i></h2>
                                    </div>
                                </div>
                                <div style="float: left; width: 5%;">
                                    <img src="../../assets/images/LogoNewPNG.png" style="width: 50px;">
                                </div>
                                <div style="float: left; width: 50%;">
                                    <p>
                                        &emsp;'.$result_customer->CTM_NAMEEN.' / '.$result_customer->CTM_NAMETH.'<br>
                                        &emsp;เลขที่ '.$result_customer->CTM_ADDRESS.' โทรศัพท์ '.$result_customer->CTM_PHONE.' โทรสาร '.$result_customer->CTM_FAX.'<br>
                                        &emsp;ประจำเดือน '.$dscon.'
                                        &emsp;&emsp;&emsp;&emsp;&emsp;
                                        ชื่อรถ '.$rs_get_data->THAINAME.' ประเภทรถ '.$rs_get_data->VEHICLETYPEDESC.' ทะเบียนรถ '.$rs_get_data->VEHICLEREGISNUMBER.' สายงาน '.$rs_get_data->LW_LINEOFWORK.'
                                    </p>
                                </div>
                            </div>';
                        }
                    $output = array(); 
                    $prevSizeVal = null; 
                    $typeStartRow = 0; 
                    $counter = 0;
                    while($rs_reportdaily = $query_reportmonth->fetch(PDO::FETCH_OBJ)){
                        $rowdata = array();
                        if($rs_reportdaily->SHL_NUMBER=='1' && $rs_get_data->SUB_LINEOFWORK!='GMT'){
                            $SHL_NUMBER         =   $rs_reportdaily->SHL_NUMBER;
                            $SHL_NAME           =   '<b>ป้ายการเสียภาษี '.$rs_get_data->DATEEXPIRE.' '.$rs_get_data->DATEEXPIRE_YEAR.'</b>';
                            $SHL_DESCRIPTION    =   'ไม่ฉีกขาด, ลอกหลุด, สูญหาย';
                            $SHL_RANK           =   'A';
                            $SHL_HOWTO          =   'ตา, มือ';
                            $SHL_TIME           =   'ทุกวัน';
                        }else{
                            $SHL_NUMBER         =   $rs_reportdaily->SHL_NUMBER;
                            $SHL_NAME           =   $rs_reportdaily->SHL_NAME;
                            $SHL_DESCRIPTION    =   $rs_reportdaily->SHL_DESCRIPTION;
                            $SHL_RANK           =   $rs_reportdaily->SHL_RANK;
                            $SHL_HOWTO          =   $rs_reportdaily->SHL_HOWTO;
                            $SHL_TIME           =   $rs_reportdaily->SHL_TIME;
                        }
                        $sql_choice = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup");
                        $sql_choice->execute(array(':proc'=>'select_check_amt_month',':datenow'=>$datestart,':period'=>$period,':reg'=>$rs_get_data->VEHICLEREGISNUMBER,':countgroup'=>$SHL_NUMBER,));
                        $result_choice = $sql_choice->fetch(PDO::FETCH_OBJ);   
                        for ($id=1;$id<=31;$id++) {
                            $dayKey="DAY".$id;
                            if (!empty($result_choice->$dayKey)) {
                                $dayValue = $result_choice->$dayKey;
                                if ($dayValue == 'normal') {
                                    ${$dayKey} = '<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                } elseif ($dayValue == 'not_use') {
                                    ${$dayKey} = '<font color="green"><b><img src="../../assets/images/remove-gray.png" style="width: 20px;"></b></font>';
                                } else {
                                    ${$dayKey} = '<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                }
                            } else {
                                ${$dayKey} = '';
                            }
                        }
                        $rowdata[0]  = '<td style="border-right: 2px solid black;">'.$rs_reportdaily->SHL_PERIODTIME.'</td>';
                        $rowdata[1]  = '<td style="border-right: 2px solid black;">'.$SHL_NUMBER.'</td>';
                        $rowdata[2]  = '<td style="border-right: 2px solid black;" align="left">'.$SHL_NAME.'</td>';
                        $rowdata[3]  = '<td style="border-right: 2px solid black;" align="left">'.$SHL_DESCRIPTION.'</td>';
                        if($rs_get_data->SUB_LINEOFWORK=="GMT"){
                            $rowdata[4]  = '<td style="border-right: 2px solid black;">'.$SHL_RANK.'</td>';
                            for ($ir=1;$ir<=31;$ir++) {
                                $dayKey="DAY".$ir;
                                $rowdata[$ir+4]='<td style="border-right: 2px solid black;">'.${$dayKey}.'</td>';
                            }
                        }else if($rs_get_data->SUB_LINEOFWORK=="SEMI"){
                            $rowdata[4]  = '<td style="border-right: 2px solid black;">'.$SHL_HOWTO.'</td>';
                            $rowdata[5]  = '<td style="border-right: 2px solid black;" colspan="2">'.$SHL_TIME.'</td>';
                            for ($ir=1;$ir<=31;$ir++) {
                                $dayKey="DAY".$ir;
                                $rowdata[$ir+5]='<td style="border-right: 2px solid black;">'.${$dayKey}.'</td>';
                            }
                        }else{
                            $rowdata[4]  = '<td style="border-right: 2px solid black;">'.$SHL_RANK.'</td>';
                            $rowdata[5]  = '<td style="border-right: 2px solid black;">'.$SHL_HOWTO.'</td>';
                            $rowdata[6]  = '<td style="border-right: 2px solid black;" colspan="2">'.$SHL_TIME.'</td>';
                            for ($ir=1;$ir<=31;$ir++) {
                                $dayKey="DAY".$ir;
                                $rowdata[$ir+6]='<td style="border-right: 2px solid black;">'.${$dayKey}.'</td>';
                            }
                        }
                        $typeCol = "";
                        if ($prevSizeVal != $rs_reportdaily->SHL_PERIODTIME) {
                            $typeStartRow = $counter;
                            $typeCol = '<th rowspan="1" style="text-rotate:90;background-color:lightgray;border: 2px solid black;">'.$rs_reportdaily->SHL_PERIODTIME.'</th>';
                        }else{
                            $output[$typeStartRow][0] = preg_replace('/rowspan="[\d]+"/', 'rowspan="'.($counter-$typeStartRow +1).'"', $output[$typeStartRow][0]);
                        }
                        $rowdata[0] = $typeCol;
                        $output[$counter] = $rowdata;
                        $prevSizeVal = $rs_reportdaily->SHL_PERIODTIME;
                        $counter++;
                    }
                    if($rs_get_data->SUB_LINEOFWORK=="SEMI"){$amt_section .='
                        <table style="white-space:nowrap">
                            <tr>
                                <td style="padding:3px;text-align:center;line-height:15px;border: 1px solid black;border-bottom: none;"><img src="'.$path.'assets/images/SEMI.png" width="70%" height="10%"></td>
                            </tr>
                        </table>';
                    }else{$amt_section .='
                    <table style="white-space:nowrap">
                        <tr>
                            <td style="padding:3px;text-align:center;line-height:15px;border: 1px solid black;border-bottom: none;"><img src="'.$path.'assets/images/GMT.png" width="70%" height="10%"></td>
                        </tr>
                    </table>';
                    }$amt_section .='
                    <table style="width: 100%;">
                        <thead>
                            <tr style="background-color:lightgray;">
                                <th rowspan="2" colspan="2"  style="border: 2px solid black;" width="50px">ลำดับ</th>
                                <th rowspan="2" colspan="1"  style="border: 2px solid black;" width="550px">หัวข้อตรวจสอบ</th>
                                <th rowspan="2" colspan="1"  style="border: 2px solid black;" width="780px">มาตรฐานการตรวจสอบ</th>';
                                if($rs_get_data->SUB_LINEOFWORK=="GMT"){$amt_section .='
                                    <th rowspan="2" colspan="1"  style="border: 2px solid black;" width="80px">ระดับ</th>';
                                }else{$amt_section .='
                                    <th rowspan="2" colspan="1"  style="border: 2px solid black;" width="150px">วิธีการ</th>
                                    <th rowspan="1" colspan="1"  style="border: 2px solid black;" width="150px" colspan="2" align="right">วันที่</th>';
                                }$amt_section .='
                                <th rowspan="1" colspan="10" style="border: 2px solid black;"><img src="../../assets/images/pdf_true.png" style="width: 20px;"> ปกติ</th>
                                <th rowspan="1" colspan="10" style="border: 2px solid black;"><img src="../../assets/images/pdf_false.png" style="width: 20px;"> ผิดปกติ</th>
                                <th rowspan="1" colspan="11" style="border: 2px solid black;"><img src="../../assets/images/pdf_dash.png" style="width: 20px;"> ไม่ใช้งาน</th>
                            </tr>
                            <tr style="background-color:lightgray;">';
                                if($rs_get_data->SUB_LINEOFWORK=="GMT"){$amt_section .='';
                                }else{$amt_section .='
                                    <th style="border: 2px solid black;" colspan="2" align="left">เวลา</th>';
                                }                                                              
                                for ($ic31=1;$ic31<=31;$ic31++) {
                                    $amt_section .= '<th style="border: 2px solid black;" width="50px">'.$ic31.'</th>';
                                }$amt_section .='
                            </tr>
                        </thead>
                        <tbody>';
                            for ($il = 0; $il < count($output); $il++){
                                $amt_section .='<tr>';
                                for ($j = 0; $j < count($output[$il]); $j++){
                                    $rs_cell = $output[$il][$j];
                                    $amt_section .= $rs_cell;
                                }
                                $amt_section .='</tr>';
                            }$amt_section .='
                            <tr>';
                            if($rs_get_data->SUB_LINEOFWORK=="GMT"){$amt_section .='
                                <td style="background-color:lightgray;border: 2px solid black;text-align:right;" colspan="5"><b>ลายเซ็นต์พนักงานขับรถ</b></td>';
                            }else if($rs_get_data->SUB_LINEOFWORK=="SEMI"){$amt_section .='
                                <td style="border-top: 2px solid black;border-bottom-style: none;border-left-style: none;text-align:left;" colspan="4">
                                    <b>&nbsp;<u>หมายเหตุ</u></b> : ถ้าตรวจสอบแล้วพบปัญหาให้แจ้งผู้จัดการแผนกทันที, บันทึกข้อบกพร่อง, ทำใบแจ้งซ่อม <br>
                                </td>
                                <td style="background-color:lightgray;border: 2px solid black;text-align:right;" colspan="3"><b>ลายเซ็นต์พนักงานขับรถ</b></td>';
                            }else{$amt_section .='
                                <td style="border-top: 2px solid black;border-bottom-style: none;border-left-style: none;text-align:left;" colspan="5">
                                    <b>&nbsp;<u>หมายเหตุ</u></b> : ถ้าตรวจสอบแล้วพบปัญหาให้แจ้งผู้จัดการแผนกทันที, บันทึกข้อบกพร่อง, ทำใบแจ้งซ่อม <br>
                                    &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<b>ระดับ A</b> ให้ระงับและต้องหยุดการใช้งานทันที จนกว่ามีการปรับปรุงแล้วเสร็จ, <b>ระดับ B</b> ให้ใช้งานต่อได้จนกว่าจะเสร็จงานรอบนั้น แล้วนำไปปรับปรุงแก้ไขทันที
                                </td>
                                <td style="background-color:lightgray;border: 2px solid black;text-align:center;" colspan="3"><b>ลายเซ็นต์พนักงานขับรถ</b></td>';
                            }
                            for ($dl=1;$dl<=31;$dl++) {  
                                if($dl<10){$dlif='0'.$dl;}else{$dlif = $dl;}
                                $dlresult = ($year-543).'-'.$month.'-'.$dlif;
                                $qr_reportdaily_who = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg");
                                $qr_reportdaily_who->execute(array(':proc'=>'select_report_amt_who',':datenow'=>$dlresult,':period'=>$period,':reg'=>$rs_get_data->VEHICLEREGISNUMBER,));
                                $rs_reportdaily_who = $qr_reportdaily_who->fetch(PDO::FETCH_OBJ);
                                $amt_section .='                              
                                <td style="border: 2px solid black;text-rotate:90;font-size:18px;">'.$rs_reportdaily_who->SHLR_CREATEBY.'</td>';
                            }$amt_section .='
                            </tr>';
                            if($rs_get_data->SUB_LINEOFWORK=="GMT"){$amt_section .='
                                <tr style="height: 20px;">
                                    <td style="background-color:lightgray;border: 2px solid black;text-align:right;" colspan="5"><b>หัวหน้าสายงานตรวจสอบ</b></td>';
                            }else if($rs_get_data->SUB_LINEOFWORK=="SEMI"){$amt_section .='
                                <tr style="height: 20px;">
                                    <td style="border: none;text-align:left;font-weight: normal;" colspan="4">
                                        <b>&nbsp;</b>'.$rs_get_data->SH_NAME.' แก้ไขครั้งที่ '.$rs_get_data->SH_TIMES.' มีผลบังคับใช้ : '.$SHFEX3.'-'.$SHFEX2.'-'.$SHFEX1.'
                                    </td>
                                    <td style="background-color:lightgray;border: 2px solid black;text-align:center;" colspan="3"><b>หัวหน้าสายงานตรวจสอบ</b></td>';
                            }else{$amt_section .='
                                <tr style="height: 20px;">
                                    <td style="border: none;text-align:left;font-weight: normal;" colspan="5">
                                        <b>&nbsp;</b>'.$rs_get_data->SH_NAME.' แก้ไขครั้งที่ '.$rs_get_data->SH_TIMES.' มีผลบังคับใช้ : '.$SHFEX3.'-'.$SHFEX2.'-'.$SHFEX1.'
                                    </td>
                                    <td style="background-color:lightgray;border: 2px solid black;text-align:center;" colspan="3"><b>หัวหน้าสายงานตรวจสอบ</b></td>';
                            }
                                for ($dc=1;$dc<=31;$dc++) {  
                                    if($dc<10){$dcif='0'.$dc;}else{$dcif = $dc;}
                                    $dcresult = ($year-543).'-'.$month.'-'.$dcif;
                                    
                                    $qr_check_approve = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg");
                                    $qr_check_approve->execute(array(':proc'=>'check_approve',':datenow'=>$dcresult,':period'=>$period,':reg'=>$rs_get_data->VEHICLEREGISNUMBER,));
                                    $rs_check_approve = $qr_check_approve->fetch(PDO::FETCH_OBJ);
                                    $amt_section .='
                                        <td style="border: 2px solid black;text-rotate:90;font-size:18px;">'.$rs_check_approve->SHLA_CREATEBY.'</td>';
                                }$amt_section .='
                            </tr>';
                            if($rs_get_data->SUB_LINEOFWORK=="GMT"){$amt_section .='
                                <tr style="height: 20px;">
                                    <td style="border: none;text-align:left;font-weight: normal;" colspan="5">
                                        <b>&nbsp;</b>'.$rs_get_data->SH_NAME.' แก้ไขครั้งที่ '.$rs_get_data->SH_TIMES.' มีผลบังคับใช้ : '.$SHFEX3.'-'.$SHFEX2.'-'.$SHFEX1.'
                                    </td>
                                    <td style="border: none;text-align:left;" colspan="31">
                                        <b>&nbsp;<u>หมายเหตุ</u></b> : ถ้าตรวจสอบแล้วพบปัญหาให้แจ้งผู้จัดการแผนกทันที, บันทึกข้อบกพร่อง, ทำใบแจ้งซ่อม <br>
                                        &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<b>ระดับ A</b> ให้ระงับและต้องหยุดการใช้งานทันที จนกว่ามีการปรับปรุงแล้วเสร็จ, <b>ระดับ B</b> ให้ใช้งานต่อได้จนกว่าจะเสร็จงานรอบนั้น แล้วนำไปปรับปรุงแก้ไขทันที
                                    </td>';
                            }$amt_section .='
                            </tr>
                        </tbody>
                    </table>
                </div>
            </body>
        </html>';
    $mpdf->AddPageByArray(array(
        'orientation' => 'L',
        'margin-left' => 5,
        'margin-right' => 5,
        'margin-top' => 5,
        'margin-bottom' => 5,
    ));
    $mpdf->WriteHTML($style_section);
    $mpdf->WriteHTML($style);
    $mpdf->WriteHTML($amt_section);
    
    // $mpdf->AddPage('L');
    // $mpdf->AddPage();
    $mpdf->Output('รายงานการตรวจสอบรายวันของรถทะเบียน '.$rs_get_data->VEHICLEREGISNUMBER.'.pdf', 'I');
