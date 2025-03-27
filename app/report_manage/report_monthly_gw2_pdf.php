<?php
session_name("TRAILER");
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
$query_reportmonth_head->execute(array(':proc'=>'select_report_head',':datenow'=>'',':period'=>'',':reg'=>'',':countgroup'=>'',':shid'=>$rs_get_data->SH_ID,));

$SHFEX = explode("-", $rs_get_data->SH_EFFECT);
$SHFEX1 = substr($SHFEX[0],2)+43;
$SHFEX2 = $SHFEX[1];
$SHFEX3 = $SHFEX[2];

function daysInMonth($monthf, $yearf) {
    return cal_days_in_month(CAL_GREGORIAN, $monthf, $yearf);
}
$yearf = date('Y');
$monthf = date('n'); 
$daysf = daysInMonth($monthf, $yearf);
$monthperiod=$_GET['monthperiod'];
if($monthperiod=='ครึ่งเดือนแรก'){
    $sth=1;
    $enh=15;
}else if($monthperiod=='ครึ่งเดือนหลัง'){
    $sth=16;
    $enh=$daysf;
}
$slot_count = ($enh-$sth)+1;

// Submonth
    $selected_week = $_GET['month'];
    $monthif = '';
    switch ($selected_week) {
        case "มกราคม":$monthif = "01";break;
        case "กุมภาพันธ์":$monthif = "02";break;
        case "มีนาคม":$monthif = "03";break;
        case "เมษายน":$monthif = "04";break;
        case "พฤษภาคม":$monthif = "05";break;
        case "มิถุนายน":$monthif = "06";break;
        case "กรกฎาคม":$monthif = "07";break;
        case "สิงหาคม":$monthif = "08";break;
        case "กันยายน":$monthif = "09";break;
        case "ตุลาคม":$monthif = "10";break;
        case "พฤศจิกายน":$monthif = "11";break;
        case "ธันวาคม":$monthif = "12";break;
        default:$monthif = "Invalid month";break;
    }
// Submonth

$start_week = date('Y-'.$monthif.'-'.$sth);
$year   =   $_GET['year'];
$dscon = $selected_week.' ปี '.$year;
// echo $dscon."<br>";

// $shid=$_GET['shid'];
$time=$_GET['time'];
if($time=='กลางวัน'){
    $period='DAY';
}else if($time=='กลางคืน'){
    $period='NIGHT';
}
// print_r($_GET);
// print_r($SHFEX3.'-'.$SHFEX2.'-'.$SHFEX1);
// exit;

// $mpdf = new mPDF('th',  [180, 297], '0', '');
$mpdf = new mPDF('th', 'A4', '0', '');
 
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
                                    <img src="'.$path.'assets/images/LogoNewPNG.png" style="float:left;width:30px;height:30px;margin-top:3px;margin-left:3px;margin-bottom:-3px;">
                                    <font style="font-size:10;">'.$result_customer->CTM_NAMETH.'</font>&emsp;&emsp;&emsp;&emsp;
                                    <font style="font-size:18;"><b><i>ใบตรวจสภาพรถบรรทุก</i></b></font><br>
                                    <font style="font-size:10;">&nbsp;เดือน </font>
                                    <font style="font-size:12;"><b>'.$dscon.'</b></font>&emsp;
                                    <font style="font-size:10;">สายงาน </font>
                                    <font style="font-size:12;"><b>'.$result_customer->LW_LINEOFWORK.'</b></font>&emsp;
                                    <font style="font-size:10;">ทะเบียนรถ </font>
                                    <font style="font-size:12;"><b>'.$_GET['regis'].'</b></font>&emsp;
                                    <font style="font-size:10;">เบอร์รถ </font>
                                    <font style="font-size:12;"><b>'.$rs_get_data->THAINAME.'</b></font>&emsp;
                                    <font style="font-size:10;">เวลา </font>
                                    <font style="font-size:12;"><b>กะ'.$time.'</b></font>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:3px;text-align:center;line-height:15px;border: 1px solid black;border-bottom: none;"><font style="font-size:10;">ใบตรวจสภาพรถก่อนปฏิบัติงาน</font></td>
                            </tr>
                        </thead>
                    </table>';$amt_section .='
                    <table style="width: 100%;font-size:17;">
                        <thead>
                            <tr style="background-color:lightgray;">
                                <th rowspan="1" colspan="1"  style="border: 2px solid black;" width="10px">ลำดับ</th>
                                <th rowspan="1" colspan="1"  style="border: 2px solid black;" width="400px">หัวข้อตรวจสอบ</th>
                                <th rowspan="1" colspan="1"  style="border: 2px solid black;" width="600px">มาตรฐานการตรวจสอบ</th>
                                <td rowspan="1" colspan="1"  style="border: 2px solid black;" width="70px">ระดับ</td>';
                                for ($ih = $sth; $ih <= $enh; $ih++) {
                                    $amt_section .='<td rowspan="1" colspan="1" style="border: 2px solid black;" width="50px">'.$ih.'</td>';
                                }$amt_section .='
                            </tr>
                        </thead>
                        <tbody>';                        
                            while($rs_reportdaily_head = $query_reportmonth_head->fetch(PDO::FETCH_OBJ)){
                                
                                $query_reportmonth = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
                                $query_reportmonth->execute(array(':proc'=>'select_report_gw2',':datenow'=>$start_week,':period'=>$period,':reg'=>$_GET['regis'],':countgroup'=>$rs_reportdaily_head->SHL_PERIODTIME_REAL,':shid'=>$rs_get_data->SH_ID,));
                                while($rs_reportdaily = $query_reportmonth->fetch(PDO::FETCH_OBJ)){
                                    $amt_section .='
                            <tr>
                                <td style="border-left: 2px solid black;border-right: 2px solid black;">'.$rs_reportdaily->SHL_NUMBER.'</td>
                                <td style="border-left:none;border-right: 2px solid black;" align="left">'.$rs_reportdaily->SHL_NAME.'</td>
                                <td style="border-left:none;border-right: 2px solid black;" align="left">'.$rs_reportdaily->SHL_DESCRIPTION.'</td>
                                <td style="border-left:none;border-right: 2px solid black;" align="center">'.$rs_reportdaily->SHL_RANK.'</td>';
                                    for ($daytd = 1; $daytd <= $slot_count; $daytd++) {
                                        $day_field = 'DAY'.$daytd;
                                        $amt_section .= '
                                <td style="border-right: 2px solid black;">';
                                    if (isset($rs_reportdaily->$day_field)) {
                                        if ($rs_reportdaily->$day_field == 'normal') {
                                            $amt_section .= '<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                        } elseif ($rs_reportdaily->$day_field == 'not_use') {
                                            $amt_section .= '<font color="green"><b><img src="../../assets/images/remove-gray.png" style="width: 20px;"></b></font>';
                                        } else {
                                            $amt_section .= '<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                        }
                                    } else {
                                        if ($daytd == 1 && isset($rs_check_approve->SHLC_STATUS) && $rs_check_approve->SHLC_STATUS == 'stopchecking') {
                                            $amt_section .= '<font color="red"><b>STOP</b></font>';
                                        }
                                    }$amt_section .= '
                                </td>';}$amt_section .= '
                            </tr>';
                                $CA1NAME=$rs_reportdaily->CA1NAME;$CA2NAME=$rs_reportdaily->CA2NAME;$CA3NAME=$rs_reportdaily->CA3NAME;$CA4NAME=$rs_reportdaily->CA4NAME;$CA5NAME=$rs_reportdaily->CA5NAME;
                                $CA6NAME=$rs_reportdaily->CA6NAME;$CA7NAME=$rs_reportdaily->CA7NAME;$CA8NAME=$rs_reportdaily->CA8NAME;$CA9NAME=$rs_reportdaily->CA9NAME;$CA10NAME=$rs_reportdaily->CA10NAME;
                                $CA11NAME=$rs_reportdaily->CA11NAME;$CA12NAME=$rs_reportdaily->CA12NAME;$CA13NAME=$rs_reportdaily->CA13NAME;$CA14NAME=$rs_reportdaily->CA14NAME;$CA15NAME=$rs_reportdaily->CA15NAME;
                                $AP1NAME=$rs_reportdaily->AP1NAME;$AP2NAME=$rs_reportdaily->AP2NAME;$AP3NAME=$rs_reportdaily->AP3NAME;$AP4NAME=$rs_reportdaily->AP4NAME;$AP5NAME=$rs_reportdaily->AP5NAME;
                                $AP6NAME=$rs_reportdaily->AP6NAME;$AP7NAME=$rs_reportdaily->AP7NAME;$AP8NAME=$rs_reportdaily->AP8NAME;$AP9NAME=$rs_reportdaily->AP9NAME;$AP10NAME=$rs_reportdaily->AP10NAME;
                                $AP11NAME=$rs_reportdaily->AP11NAME;$AP12NAME=$rs_reportdaily->AP12NAME;$AP13NAME=$rs_reportdaily->AP13NAME;$AP14NAME=$rs_reportdaily->AP14NAME;$AP15NAME=$rs_reportdaily->AP15NAME;
                                }}
                                // }
                                $amt_section .='
                            <tr>
                                <td style="border: 2px solid black;text-align:right;" colspan="4"><b>ลงชื่อพนักงานขับรถ</b></td>';
                                $CA_NAMES = [];
                                for ($ica = 1; $ica <= $slot_count; $ica++) {
                                    $CA_NAMES[$ica] = $rs_reportdaily->{'CA'.$ica.'NAME'};
                                }
                                foreach ($CA_NAMES as $caname) {
                                    $amt_section .= '<td style="border: 2px solid black;" colspan="1">'.$caname.'</td>';
                                }$amt_section .='
                            </tr>
                            <tr style="height: 20px;">
                                <td style="border: 2px solid black;text-align:right;" colspan="4"><b>ลงชื่อผู้ควบคุม/เจ้าหน้าที่เท็งโกะ</b></td>';
                                $AP_NAMES = [];
                                for ($iap = 1; $iap <= $slot_count; $iap++) {
                                    $AP_NAMES[$iap] = $rs_reportdaily->{'AP'.$iap.'NAME'};
                                }
                                foreach ($AP_NAMES as $apname) {
                                    $amt_section .= '<td style="border: 2px solid black;" colspan="1">'.$apname.'</td>';
                                }$amt_section .='
                            </tr>
                        </tbody>
                    </table>
                    <img src="'.$path.'assets/images/TTASTCHECK.png" width="100%" height="20%">
                </div>
            </body>
        </html>';

    $mpdf->AddPageByArray(array(
        'orientation' => 'P', // 'P' สำหรับแนวตั้ง (Portrait), 'L' สำหรับแนวนอน (Landscape)
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
