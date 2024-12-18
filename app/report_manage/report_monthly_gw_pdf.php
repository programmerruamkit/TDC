<?php
session_start();
$path = "../../";   	
require($path.'config/connect.php');
require($path.'assets/pdf/PDF/vendor/autoload.php');

$sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis");
$sql_get_data->execute(array(':proc'=>'select_data',':regis'=>$_GET['regis'],));
$rs_get_data = $sql_get_data->fetch(PDO::FETCH_OBJ); 

$sql_get_exam = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis,:num");
$sql_get_exam->execute(array(':proc'=>'select_exam',':regis'=>$_GET['regis'],':num'=>1,));
$rs_get_exam = $sql_get_exam->fetch(PDO::FETCH_OBJ);   

$sql_customer = $conn->prepare("EXECUTE ENB_CUSTOMER :proc,:regis,:lwid");
$sql_customer->execute(array(':proc'=>'select_customer',':regis'=>$_GET['regis'],':lwid'=>'',));
$result_customer = $sql_customer->fetch(PDO::FETCH_OBJ);   
$SUBLINE = $result_customer->SUB_LINEOFWORK;

$query_reportmonth_head = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
$query_reportmonth_head->execute(array(':proc'=>'select_report_gw_head',':datenow'=>'',':period'=>'',':reg'=>'',':countgroup'=>'',':shid'=>$rs_get_data->SH_ID,));

$SHFEX = explode("-", $rs_get_data->SH_EFFECT);
$SHFEX1 = substr($SHFEX[0],2)+43;
$SHFEX2 = $SHFEX[1];
$SHFEX3 = $SHFEX[2];

if($result_customer->LW_LINEOFWORK=='STC-10W'){
    $picl   =   'car_stc10_left.png';
    $picr   =   'car_stc10_right.png';
}else
if($result_customer->LW_LINEOFWORK=='STC-TL'){
    $picl   =   'car_stctl_left.png';
    $picr   =   'car_stctl_right.png';
}else
if($result_customer->LW_LINEOFWORK=='KUBOTA'){
    $picl   =   'car_stckbt_left.png';
    $picr   =   'car_stckbt_right.png';
}else
if($result_customer->LW_LINEOFWORK=='STM-TGT'){
    $picl   =   'car_stmtgt_left.png';
    $picr   =   'car_stmtgt_right.png';
}


if($SUBLINE =='4L' || $SUBLINE =='RCC' || $SUBLINE =='RATC'){ 
    $selected_week = $_GET['month'];
    $date = new DateTime();
    $date->setISODate(substr($selected_week, 0, 4), substr($selected_week, -2));
    $start_week = $date->format('Y-m-d');
    $weekdate1 = date('d/m/Y', strtotime($start_week.' +0 day'));
    $weekdate2 = date('d/m/Y', strtotime($start_week.' +1 day'));
    $weekdate3 = date('d/m/Y', strtotime($start_week.' +2 day'));
    $weekdate4 = date('d/m/Y', strtotime($start_week.' +3 day'));
    $weekdate5 = date('d/m/Y', strtotime($start_week.' +4 day'));
    $weekdate6 = date('d/m/Y', strtotime($start_week.' +5 day'));
    $weekdate7 = date('d/m/Y', strtotime($start_week.' +6 day'));
    $submonth = substr($start_week, 5, 2);
    $subyear = substr($start_week, 0, 4);
    // Submonth
        $monthif = $submonth;
        if($monthif == "01"){
            $month = "มกราคม";
        }else if($monthif == "02"){
            $month = "กุมภาพันธ์";
        }else if($monthif == "03"){
            $month = "มีนาคม";
        }else if($monthif == "04"){
            $month = "เมษายน";
        }else if($monthif == "05"){
            $month = "พฤษภาคม";
        }else if($monthif == "06"){
            $month = "มิถุนายน";
        }else if($monthif == "07"){
            $month = "กรกฎาคม";
        }else if($startif8== "08"){
            $month = "สิงหาคม";
        }else if($monthif == "09"){
            $month = "กันยายน";
        }else if($monthif == "10"){
            $month = "ตุลาคม";
        }else if($monthif == "11"){
            $month = "พฤศจิกายน";
        }else if($monthif == "12"){
            $month = "ธันวาคม";
        }
    // Submonth
    $dscon = $month.' ปี '.$subyear;
    // echo $dscon."<br>";

}else{
    // $_GET['month']=$_GET['month'];
    if(isset($_GET['month'])){
        $monthif = $_GET['month'];
            if($monthif == "01"){
                $month = "มกราคม";
            }else if($monthif == "02"){
                $month = "กุมภาพันธ์";
            }else if($monthif == "03"){
                $month = "มีนาคม";
            }else if($monthif == "04"){
                $month = "เมษายน";
            }else if($monthif == "05"){
                $month = "พฤษภาคม";
            }else if($monthif == "06"){
                $month = "มิถุนายน";
            }else if($monthif == "07"){
                $month = "กรกฎาคม";
            }else if($startif8== "08"){
                $month = "สิงหาคม";
            }else if($monthif == "09"){
                $month = "กันยายน";
            }else if($monthif == "10"){
                $month = "ตุลาคม";
            }else if($monthif == "11"){
                $month = "พฤศจิกายน";
            }else if($monthif == "12"){
                $month = "ธันวาคม";
            }
    }
    $year   =   $_GET['year'];
    $dscon  =   $monthif.' ปี '.$year;
    // echo $dscon;
}

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
// print_r($_GET);
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
                <div class="container">
                
                    <table style="white-space:nowrap">
                        <thead>
                            <tr>
                                <td style="padding:0px;text-align:left;border: 1px solid black;border-bottom: none;">
                                    <img src="../../assets/images/LogoNewPNG.png" style="float:left;width:30px;height:23px;margin-top:3px;margin-left:3px;margin-bottom:-3px;">&emsp;&emsp;&emsp;&emsp;
                                    <font style="font-size:13;"><b>'.$result_customer->CTM_NAMEEN.'</b></font>&emsp;&emsp;&emsp;&emsp;
                                    <font style="font-size:15;"><b><u>ใบตรวจสภาพเทรลเลอร์</u></b></font>&emsp;&emsp;&emsp;
                                    <font style="font-size:8;">เบอร์เทรลเลอร์</font>
                                    <font style="font-size:18;"><b>'.$rs_get_data->THAINAME.'</b></font>&emsp;&emsp;
                                    <font style="font-size:8;">เดือน '.$dscon.'</font>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:3px;text-align:left;line-height:15px;border: 1px solid black;border-bottom: none;">
                                    <font style="font-size:8;">
                                        <b><u>คำสั่งในการปฏิบัติงาน</u></b> : ให้ตรวจเทรลเลอร์ก่อนวิ่งงาน ตามรายการตรวจ ดังต่อไปนี้ &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <b><u>วิธีการตรวจ</u></b> : ถ้าปกติพร้อมใช้งานให้ทำเครื่องหมายถูก <img src="../../assets/images/pdf_true.png" style="width: 5px;"> ในช่องผล ถ้าผิดปกติไม่พร้อมใช้งานให้ทำเครื่องหมายผิด <img src="../../assets/images/pdf_false.png" style="width: 5px;"> ในช่องผลพร้อมระบุสิ่งที่ผิดปกติ
                                        <br>อ้างอิงตามมาตรฐานการตรวจรถเทรลเลอร์ก่อนการปฏิบัติงาน (TRAILER READINESS CHECK STANDARD)
                                    </font>
                                </div>
                                </td>
                            </tr>
                        </thead>
                    </table>';  

                                
                    $amt_section .='
                    <table style="width: 100%;font-size:17;">
                        <thead>
                            <tr style="background-color:lightgray;">
                                <th rowspan="3" colspan="2"  style="border: 2px solid black;" width="1000px"><h3>รายการตรวจสภาพความพร้อมที่ยอมรับได้</h3></th>
                                <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="200px" align="left">วันที่....'.$weekdate1.'....</td>                                
                                <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="200px" align="left">วันที่....'.$weekdate2.'....</td>
                                <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="200px" align="left">วันที่....'.$weekdate3.'....</td>
                                <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="200px" align="left">วันที่....'.$weekdate4.'....</td>
                                <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="200px" align="left">วันที่....'.$weekdate5.'....</td>
                                <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="200px" align="left">วันที่....'.$weekdate6.'....</td>
                                <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="200px" align="left">วันที่....'.$weekdate7.'....</td>

                            </tr>
                            <tr style="background-color:lightgray;">
                                <td style="border: 2px solid black;" colspan="2" align="left">เวลา......กะ'.$time.'......</td>                                
                                <td style="border: 2px solid black;" colspan="2" align="left">เวลา......กะ'.$time.'......</td>
                                <td style="border: 2px solid black;" colspan="2" align="left">เวลา......กะ'.$time.'......</td>
                                <td style="border: 2px solid black;" colspan="2" align="left">เวลา......กะ'.$time.'......</td>
                                <td style="border: 2px solid black;" colspan="2" align="left">เวลา......กะ'.$time.'......</td>
                                <td style="border: 2px solid black;" colspan="2" align="left">เวลา......กะ'.$time.'......</td>
                                <td style="border: 2px solid black;" colspan="2" align="left">เวลา......กะ'.$time.'......</td>

                            </tr>
                            <tr style="background-color:lightgray;">
                                <td style="border: 2px solid black;" align="center">ผล</td>
                                <td style="border: 2px solid black;" align="center">หมายเหตุ</td>
                                <td style="border: 2px solid black;" align="center">ผล</td>
                                <td style="border: 2px solid black;" align="center">หมายเหตุ</td>
                                <td style="border: 2px solid black;" align="center">ผล</td>
                                <td style="border: 2px solid black;" align="center">หมายเหตุ</td>
                                <td style="border: 2px solid black;" align="center">ผล</td>
                                <td style="border: 2px solid black;" align="center">หมายเหตุ</td>
                                <td style="border: 2px solid black;" align="center">ผล</td>
                                <td style="border: 2px solid black;" align="center">หมายเหตุ</td>
                                <td style="border: 2px solid black;" align="center">ผล</td>
                                <td style="border: 2px solid black;" align="center">หมายเหตุ</td>
                                <td style="border: 2px solid black;" align="center">ผล</td>
                                <td style="border: 2px solid black;" align="center">หมายเหตุ</td>
                            </tr>
                        </thead>
                        <tbody>';                        
                                while($rs_reportdaily_head = $query_reportmonth_head->fetch(PDO::FETCH_OBJ)){$amt_section .='
                            <tr>
                                <th style="background-color:black;color:white;border: 2px solid black;text-align:left;" colspan="16">'.$rs_reportdaily_head->SHL_PERIODTIME.'</th>
                            </tr>';
                                $query_reportmonth = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
                                $query_reportmonth->execute(array(':proc'=>'select_report_gw',':datenow'=>$start_week,':period'=>$period,':reg'=>$_GET['regis'],':countgroup'=>$rs_reportdaily_head->SHL_PERIODTIME_REAL,':shid'=>$rs_get_data->SH_ID,));
                                while($rs_reportdaily = $query_reportmonth->fetch(PDO::FETCH_OBJ)){$amt_section .='
                            <tr>
                                <td style="border-left: 2px solid black;border-right:none;width:3%">'.$rs_reportdaily->SHL_NUMBER.'</td>
                                <td style="border-left:none;border-right: 2px solid black;width:40%" align="left">'.$rs_reportdaily->SHL_NAME.'</td>
                                <td style="border-right: 2px solid black;">';
                                    if(isset($rs_reportdaily->DAY1)){
                                        if($rs_reportdaily->DAY1=='normal'){
                                            $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        }else{
                                            $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }   
                                    }else{
                                        $amt_section .='';
                                    }                             
                                $amt_section .='</td>
                                <td style="border-right: 2px solid black;">'.$rs_reportdaily->DAY1REMARK.'</td>
                                <td style="border-right: 2px solid black;">';
                                    if(isset($rs_reportdaily->DAY2)){
                                        if($rs_reportdaily->DAY2=='normal'){
                                            $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        }else{
                                            $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }   
                                    }else{
                                        $amt_section .='';
                                    }                                 
                                $amt_section .='</td>
                                <td style="border-right: 2px solid black;">'.$rs_reportdaily->DAY2REMARK.'</td>
                                <td style="border-right: 2px solid black;">';
                                    if(isset($rs_reportdaily->DAY3)){
                                        if($rs_reportdaily->DAY3=='normal'){
                                            $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        }else{
                                            $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }   
                                    }else{
                                        $amt_section .='';
                                    }                               
                                $amt_section .='</td>
                                <td style="border-right: 2px solid black;">'.$rs_reportdaily->DAY3REMARK.'</td>
                                <td style="border-right: 2px solid black;">';
                                    if(isset($rs_reportdaily->DAY4)){
                                        if($rs_reportdaily->DAY4=='normal'){
                                            $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        }else{
                                            $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }   
                                    }else{
                                        $amt_section .='';
                                    }                                
                                $amt_section .='</td>
                                <td style="border-right: 2px solid black;">'.$rs_reportdaily->DAY4REMARK.'</td>
                                <td style="border-right: 2px solid black;">';
                                    if(isset($rs_reportdaily->DAY5)){
                                        if($rs_reportdaily->DAY5=='normal'){
                                            $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        }else{
                                            $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }   
                                    }else{
                                        $amt_section .='';
                                    }                               
                                $amt_section .='</td>
                                <td style="border-right: 2px solid black;">'.$rs_reportdaily->DAY5REMARK.'</td>
                                <td style="border-right: 2px solid black;">';
                                    if(isset($rs_reportdaily->DAY6)){
                                        if($rs_reportdaily->DAY6=='normal'){
                                            $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        }else{
                                            $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }   
                                    }else{
                                        $amt_section .='';
                                    }                                
                                $amt_section .='</td>
                                <td style="border-right: 2px solid black;">'.$rs_reportdaily->DAY6REMARK.'</td>
                                <td style="border-right: 2px solid black;">';
                                    if(isset($rs_reportdaily->DAY7)){
                                        if($rs_reportdaily->DAY7=='normal'){
                                            $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        }else{
                                            $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }   
                                    }else{
                                        $amt_section .='';
                                    }                               
                                $amt_section .='</td>
                                <td style="border-right: 2px solid black;">'.$rs_reportdaily->DAY7REMARK.'</td>
                            </tr>';
                            $CA1NAME=$rs_reportdaily->CA1NAME;
                            $CA2NAME=$rs_reportdaily->CA2NAME;
                            $CA3NAME=$rs_reportdaily->CA3NAME;
                            $CA4NAME=$rs_reportdaily->CA4NAME;
                            $CA5NAME=$rs_reportdaily->CA5NAME;
                            $CA6NAME=$rs_reportdaily->CA6NAME;
                            $CA7NAME=$rs_reportdaily->CA7NAME;
                            $AP1NAME=$rs_reportdaily->AP1NAME;
                            $AP2NAME=$rs_reportdaily->AP2NAME;
                            $AP3NAME=$rs_reportdaily->AP3NAME;
                            $AP4NAME=$rs_reportdaily->AP4NAME;
                            $AP5NAME=$rs_reportdaily->AP5NAME;
                            $AP6NAME=$rs_reportdaily->AP6NAME;
                            $AP7NAME=$rs_reportdaily->AP7NAME;
                                }                
                                }
                        $amt_section .='<tr>
                                <td style="border: 2px solid black;text-align:right;" colspan="2"><b>ลงชื่อพนักงานขับรถ</b></td>
                                <td style="border: 2px solid black;" colspan="2">'.$CA1NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$CA2NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$CA3NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$CA4NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$CA5NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$CA6NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$CA7NAME.'</td>
                            </tr>
                            <tr style="height: 20px;">
                                <td style="border: 2px solid black;text-align:right;" colspan="2"><b>ลงชื่อผู้ควบคุม/เจ้าหน้าที่เท็งโกะ</b></td>
                                <td style="border: 2px solid black;" colspan="2">'.$AP1NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$AP2NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$AP3NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$AP4NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$AP5NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$AP6NAME.'</td>
                                <td style="border: 2px solid black;" colspan="2">'.$AP7NAME.'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </body>
        </html>';

    $mpdf->AddPageByArray(array(
        'orientation' => 'L', // 'P' สำหรับแนวตั้ง (Portrait), 'L' สำหรับแนวนอน (Landscape)
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
    $mpdf->Output('รายงานการตรวจสอบรายเดือนของรถทะเบียน '.$rs_get_data->VEHICLEREGISNUMBER.'.pdf', 'I');
