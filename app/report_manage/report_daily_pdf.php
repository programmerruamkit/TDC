<?php
session_start();
$path = "../../";   	
require($path.'config/connect.php');
require($path.'assets/pdf/PDF/vendor/autoload.php');

// ตรวจสอบว่ามีข้อมูลถูกส่งมาหรือไม่
if (isset($_POST['reportData'])) {
    $reportData = json_decode($_POST['reportData'], true);
    
    // ตรวจสอบว่า JSON ถูกต้อง
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Invalid JSON data']);
        exit;
    }
    
    // ตรวจสอบว่าข้อมูลที่ต้องการมีอยู่ใน JSON ที่ได้รับ
    if (empty($reportData)) {
        echo json_encode(['error' => 'No report data provided']);
        exit;
    }

    // การตั้งค่าและสร้าง PDF
    try {
        $mpdf = new mPDF('th', 'A4', '0', '');
        // ลดคุณภาพของภาพและขนาดไฟล์
        $mpdf->useSubstitutions = false;
        $mpdf->jpeg_quality = 75; // ลดคุณภาพของภาพ
        $mpdf->simpleTables = true;
        $mpdf->packTableData = true;
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setCompression = true; // เปิดการบีบอัดไฟล์ PDF
    } catch (\Mpdf\MpdfException $e) {
        echo json_encode(['error' => 'Failed to initialize mPDF: ' . $e->getMessage()]);
        exit;
    }
    
    $sql_get_data = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis");
    $sql_get_data->execute(array(':proc'=>'select_data',':regis'=>$_POST['regis'],));
    $rs_get_data = $sql_get_data->fetch(PDO::FETCH_OBJ);  

    $sql_customer = $conn->prepare("EXECUTE ENB_CUSTOMER :proc,:regis,:lwid");
    $sql_customer->execute(array(':proc'=>'select_customer',':regis'=>$_POST['regis'],':lwid'=>'',));
    $result_customer = $sql_customer->fetch(PDO::FETCH_OBJ);   
    if($result_customer->SUB_LINEOFWORK==''){
        $SUBLINE = $result_customer->LW_LINEOFWORK;    
    }else{
        $SUBLINE = $result_customer->SUB_LINEOFWORK;
    }

    $query_reportmonth_head = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
    $query_reportmonth_head->execute(array(':proc'=>'select_report_head',':datenow'=>'',':period'=>'',':reg'=>'',':countgroup'=>'',':shid'=>$rs_get_data->SH_ID,));

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

    $start = explode("-", $_POST['datenow']);
    $subday = $start[2];
    $submonth = $start[1];
    $subyear = $start[0]+543;

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
    $rsdate = $subday.' '.$month.' '.$subyear;
    // echo $dscon."<br>";
    
    // $shid=$_POST['shid'];
    $time=$_POST['time'];
    if($time=='กลางวัน'){
        $period='DAY';
        $cheked1='<img src="../../assets/images/checkbox_true.png" style="width: 15px;">';
        $cheked2='<img src="../../assets/images/checkbox_none.png" style="width: 15px;">';
    }else if($time=='กลางคืน'){
        $period='NIGHT';
        $cheked1='<img src="../../assets/images/checkbox_none.png" style="width: 15px;">';
        $cheked2='<img src="../../assets/images/checkbox_true.png" style="width: 15px;">';
    }

    $qr_reportdaily_who = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
    $qr_reportdaily_who->execute(array(':proc'=>'select_report_gw_who',':datenow'=>$_POST['datenow'],':period'=>$period,':reg'=>$_POST['regis'],':countgroup'=>'',':shid'=>'',));
    $rs_reportdaily_who = $qr_reportdaily_who->fetch(PDO::FETCH_OBJ);

    $qr_check_approve = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
    $qr_check_approve->execute(array(':proc'=>'check_approve',':datenow'=>$_POST['datenow'],':period'=>$period,':reg'=>$_POST['regis'],':countgroup'=>'',':shid'=>'',));
    $rs_check_approve = $qr_check_approve->fetch(PDO::FETCH_OBJ);

    // print_r($SHFEX3.'-'.$SHFEX2.'-'.$SHFEX1);
    // print_r($_POST);
    // exit;

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
            <link rel="shortcut icon" href="../../assets/images/pdf.png" loading="lazy">
        </head>
        <body style="background-color: #ffffff;">
            <div class="container">
                <table style="white-space:nowrap">
                    <thead>
                        <tr>
                            <td style="padding:0px;text-align:left;border: 1px solid black;border-bottom: none;">
                                <img src="../../assets/images/LogoNewPNG.png" style="float:left;width:30px;height:23px;margin-top:3px;margin-left:3px;margin-bottom:-3px;">
                                <font style="font-size:13;"><b>'.$result_customer->CTM_NAMEEN.'</b></font>&emsp;&emsp;&emsp;&emsp;';
                                if($SUBLINE =='4L' || $SUBLINE =='RCC' || $SUBLINE =='RATC'){$amt_section .= '
                                    <font style="font-size:15;"><b><u>ใบตรวจสภาพเทรลเลอร์</u></b></font><br>
                                    <font style="font-size:8;">เดือน '.$dscon.'</font>&emsp;&emsp;&emsp;
                                    <font style="font-size:8;">เบอร์เทรลเลอร์</font>
                                    <font style="font-size:14;"><b>'.$rs_get_data->THAINAME.'</b></font>&emsp;&emsp;';
                                }else{$amt_section .= '
                                    <font style="font-size:15;"><b>ใบตรวจสภาพรถ</b></font><br>
                                    <font style="font-size:8;">เดือน '.$dscon.'</font>&emsp;&emsp;&emsp;
                                    <font style="font-size:8;">ทะเบียนรถ</font>
                                    <font style="font-size:14;"><b>'.$_POST['regis'].'</b></font>&emsp;&emsp;
                                    <font style="font-size:8;">ชื่อรถ</font>
                                    <font style="font-size:14;"><b>'.$rs_get_data->THAINAME.'</b></font>&emsp;&emsp;';
                                }$amt_section .= '
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:3px;text-align:left;line-height:15px;border: 1px solid black;border-bottom: none;">
                                <font style="font-size:8;">
                                    <b><u>คำสั่งในการปฏิบัติงาน</u></b> : ให้ตรวจเทรลเลอร์ก่อนวิ่งงาน ตามรายการตรวจ ดังต่อไปนี้ <br>
                                    <b><u>วิธีการตรวจ</u></b> : ถ้าปกติพร้อมใช้งานให้ทำเครื่องหมายถูก <img src="../../assets/images/pdf_true.png" style="width: 5px;"> ในช่องผล ถ้าผิดปกติไม่พร้อมใช้งานให้ทำเครื่องหมายผิด <img src="../../assets/images/pdf_false.png" style="width: 5px;"> ในช่องผลพร้อมระบุสิ่งที่ผิดปกติ
                                    <br>อ้างอิงตามมาตรฐานการตรวจรถเทรลเลอร์ก่อนการปฏิบัติงาน (TRAILER READINESS CHECK STANDARD)
                                </font>
                            </div>
                            </td>
                        </tr>
                    </thead>
                </table>';$amt_section .='
                <table style="width: 100%;font-size:17;">
                    <thead>
                        <tr style="background-color:lightgray;">
                            <th rowspan="3" colspan="2"  style="border: 2px solid black;" width="900px"><h3>รายการตรวจสภาพความพร้อมที่ยอมรับได้</h3></th>
                            <td rowspan="1" colspan="2"  style="border: 2px solid black;" width="150px" align="left">วันที่....'.$rsdate.'....</td>
                        </tr>
                        <tr style="background-color:lightgray;">
                            <td style="border: 2px solid black;" colspan="2" align="left" width="150px">เวลา......กะ'.$time.'......</td>
                        </tr>
                        <tr style="background-color:lightgray;">
                            <td style="border: 2px solid black;" align="center" width="50px">ผล</td>
                            <td style="border: 2px solid black;" align="center" width="500px">หมายเหตุ</td>
                        </tr>
                    </thead>
                    <tbody>'; foreach ($reportData as $section) { $amt_section .='
                        <tr>
                            <th style="background-color:black;color:white;border: 2px solid black;text-align:left;" colspan="4">'.$section['SHL_PERIODTIME'].'</th>
                        </tr>'; foreach ($section['items'] as $item) { $amt_section .= '
                        <tr>
                            <td style="border-left: 2px solid black;border-right:none;width:10px">'.$item['SHL_NUMBER'].'</td>
                            <td style="border-left:none;border-right: 2px solid black;width:890px" align="left">'.$item['SHL_NAME'].'</td>
                            <td style="border-right: 2px solid black;width:3%">';
                                if(isset($item['DAY1'])){
                                    if($item['DAY1']=='normal'){
                                        $amt_section .='<font color="green"><b><img src="../../assets/images/check_true.gif" style="width: 20px;"></b></font>';
                                    }else if($item['DAY1']=='not_use'){
                                        $amt_section .='<font color="green"><b><img src="../../assets/images/remove-gray.png" style="width: 20px;"></b></font>';
                                    }else{                  
                                        $amt_section .='<font color="red"><b><img src="../../assets/images/check_del.gif" style="width: 20px;"></b></font>';
                                    }   
                                }else{
                                    if($item['CHECK_STATUS']=='stopchecking'){
                                        $amt_section .='<font color="red"><b>STOP</b></font>';
                                    }else{
                                        $amt_section .='';
                                    }
                                } $amt_section .='
                            </td>
                            <td style="border-right: 2px solid black;width:30%" align="left">';
                                if(isset($item['DAY1REMARK'])){
                                    if(isset($item['SAVE_REPAIR'])){
                                        $amt_section .=$item['DAY1REMARK'].' <font color="red" size="2"><b>(ส่งแจ้งซ่อมแล้ว)</b></font>';
                                    }else{
                                        $amt_section .=$item['DAY1REMARK'];
                                    }
                                }else{
                                    $amt_section .='';
                                } $amt_section .='
                            </td>
                        </tr>'; } } $amt_section .='
                        <tr>
                            <td style="border: 2px solid black;text-align:right;" colspan="2"><b>ลงชื่อพนักงานขับรถ</b></td>
                            <td style="border: 2px solid black;" colspan="2">'.$rs_reportdaily_who->EMP_NAME.'</td>
                        </tr>
                        <tr style="height: 20px;">
                            <td style="border: 2px solid black;text-align:right;" colspan="2"><b>ลงชื่อผู้ควบคุม/เจ้าหน้าที่เท็งโกะ</b></td>
                            <td style="border: 2px solid black;" colspan="2">'.$rs_check_approve->EMP_NAME.'</td>
                        </tr>
                    </tbody>
                </table>
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
    // บันทึกไฟล์ PDF
    $filename = 'REPORT-DAILY-'.$_POST['regis'].'-'.$_POST['datenow'].'-'.$period.'-'.$SUBLINE.'.pdf';
    $pdfFilePath = 'report/' . $filename ;
    $mpdf->Output($pdfFilePath, 'F');

    // ส่ง URL ของไฟล์ PDF กลับไปยัง AJAX
    echo json_encode(['pdfUrl' => $pdfFilePath]);
} else {
    // ส่งข้อความข้อผิดพลาดหากไม่มีข้อมูล
    echo json_encode(['error' => 'No report data provided']);
}
?>