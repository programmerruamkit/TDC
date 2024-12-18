<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');  

    $PROC = $_POST["proc"];
    
    if($PROC=="report_daily"){
        $datenow = $_POST["a1"];
        $P_FIND = $_POST["a2"];
        $query_reportdaily = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period");
        $query_reportdaily->execute(array(':proc'=>'select_all',':datenow'=>$datenow,':period'=>$P_FIND,));
        $rs_reportdaily = [];
        while ($result = $query_reportdaily->fetch(PDO::FETCH_OBJ)) {
            $rs_reportdaily[] = $result;
        }
        echo json_encode($rs_reportdaily);
    }
    
    if($PROC=="report_daily_check"){
        // รับข้อมูลจาก URL (เช่น shid, period, regis)
        $shid = isset($_POST['shid']) ? $_POST['shid'] : '';
        $period = isset($_POST['period']) ? $_POST['period'] : '';
        $datenow = isset($_POST['datenow']) ? $_POST['datenow'] : '';
        $regis = isset($_POST['regis']) ? $_POST['regis'] : '';
        // ฟังก์ชันดึงข้อมูลจากฐานข้อมูล
        function getReportData($conn, $shid, $period, $datenow, $regis) {
            // ดึงข้อมูลหัวข้อ
            $data = [];
            $qr_reportdaily_head = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
            $qr_reportdaily_head->execute(array(':proc'=>'select_report_gw_head',':datenow'=>'',':period'=>'',':reg'=>'',':countgroup'=>'',':shid'=>$shid,));
            $rs_reportdaily_head = $qr_reportdaily_head->fetchAll(PDO::FETCH_OBJ);
            // วนลูปผ่านข้อมูลหัวข้อ
            foreach ($rs_reportdaily_head as $row_head) {
                $head_data = [
                    'SHL_PERIODTIME' => $row_head->SHL_PERIODTIME,
                    'SHL_PERIODTIME_REAL' => $row_head->SHL_PERIODTIME_REAL,
                    'items' => []
                ];
                // ดึงข้อมูลรายการตรวจสอบ
                $qr_reportdaily = $conn->prepare("EXECUTE ENB_REPORT :proc,:datenow,:period,:reg,:countgroup,:shid");
                $qr_reportdaily->execute(array(':proc'=>'select_report_gw_day',':datenow'=>$datenow,':period'=>$period,':reg'=>$regis,':countgroup'=>$row_head->SHL_PERIODTIME_REAL,':shid'=>$shid,));
                $rs_reportdaily = $qr_reportdaily->fetchAll(PDO::FETCH_OBJ);
                // วนลูปผ่านข้อมูลรายการสินค้า
                foreach ($rs_reportdaily as $row_item) {
                    $item = [
                        'SHL_NUMBER' => $row_item->SHL_NUMBER,
                        'SHL_NAME' => $row_item->SHL_NAME,
                        'DAY1' => $row_item->DAY1,
                        'DAY1REMARK' => $row_item->DAY1REMARK,
                        'DAY1_CHECK' => null,  // ค่าเริ่มต้น
                        'SAVE_REPAIR' => $row_item->SAVE_REPAIR
                    ];
                    // เปลี่ยนจาก ternary เป็น if-elseif-else
                    if ($row_item->DAY1 == 'normal') {
                        $item['DAY1_CHECK'] = true;
                    } elseif ($row_item->DAY1 == 'abnormal') {
                        $item['DAY1_CHECK'] = false;
                    } elseif ($row_item->DAY1 == 'not_use') {
                        $item['DAY1_CHECK'] = 'not';
                    } elseif ($row_item->DAY1 == '') {
                        $item['DAY1_CHECK'] = null;
                    }
                    $head_data['items'][] = $item;
                }
                // เพิ่มข้อมูลหัวข้อที่มีรายการสินค้า
                $data[] = $head_data;
            }
            return $data;
        }
        // เรียกใช้งานฟังก์ชันดึงข้อมูล
        $response_data = getReportData($conn, $shid, $period, $datenow, $regis);
        // ส่งข้อมูลในรูปแบบ JSON
        echo json_encode($response_data);
    }
    
    if($PROC=="report_monthly"){
        $area = $_POST["a1"];
        if($area=="AMT"){
            $wh="AND CTM_COMCODE IN('RKR','RKS','RKL')";
        }else if($area=="GW"){
            $wh="AND CTM_COMCODE IN('RCC','RRC','RATC')";
        }
        $sql_customer = "SELECT * FROM CUSTOMER WHERE NOT CTM_STATUS='D' ".$wh."";
        $query_customer = $conn->query($sql_customer) or die($conn->error);
        $result_customer = [];
        while($result_customer_data  = $query_customer->fetch(PDO::FETCH_OBJ)) { 
            $sql_count = $conn->prepare("EXECUTE ENB_VEHICLEINFO :proc,:regis,:area");
            $sql_count->execute(array(':proc'=>'countctmid',':regis'=>'',':area'=>$result_customer_data ->CTM_COMCODE,));
            $result_count = $sql_count->fetch(PDO::FETCH_OBJ);
            $COUNTCTMID=$result_count->COUNTCTMID;

            $result_customer_data->COUNTCTMID = $COUNTCTMID;
            $result_customer[] = $result_customer_data ;
        }
        echo json_encode($result_customer);
    }
