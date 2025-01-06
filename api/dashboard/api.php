<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');

    $PROC = $_POST["proc"];
    $SS_AREA = $_SESSION["AD_AREA"];

    // if($PROC=="dashboard"){
    //     $dateString = date('Y-m-d');
    //     $datecheck = date('Y-m-d', strtotime($dateString));  
        
    //     $query_sel_data_daily = $conn->prepare("EXECUTE ENB_DASHBOARD :proc,:datecheck");
    //     $query_sel_data_daily->execute(array(':proc'=>'dashboard',':datecheck'=>$datecheck,));
    //     $resul_sel_data_daily = $query_sel_data_daily->fetch(PDO::FETCH_OBJ);

    //     if($SS_AREA== "AMT"){
    //         $CARTOTAL=$resul_sel_data_daily->CAR_AMT;
    //         $CARDAILY=$resul_sel_data_daily->DAILY_AMT;
    //     }else{
    //         $CARTOTAL=$resul_sel_data_daily->CAR_GW;
    //         $CARDAILY=$resul_sel_data_daily->DAILY_GW;
    //     }
    //     $DAILY_CHECK=$CARDAILY-$resul_sel_data_daily->DAILY_CHECK;
    //     $CHECK=$CARDAILY-$DAILY_CHECK;
    //     $NOCHECK=$CARDAILY-$CHECK;

    //     echo json_encode([
    //         'CARTOTAL' => $CARTOTAL,
    //         'CARDAILY' => $CARDAILY,
    //         'CHECK' => $CHECK,
    //         'NOCHECK' => $NOCHECK
    //     ]);
    //     // echo json_encode($resul_sel_data_daily);
    // }

    if($PROC=="dashboard"){
        $dateString = date('Y-m-d');
        $datecheck = date('Y-m-d', strtotime($dateString));  
        
        $query_sel_data_daily = $conn->prepare("EXECUTE ENB_DASHBOARD :proc,:datecheck,:area");
        $query_sel_data_daily->execute(array(':proc'=>'dashboard',':datecheck'=>$datecheck,':area'=>$SS_AREA));
        $resul_sel_data_daily = $query_sel_data_daily->fetch(PDO::FETCH_OBJ);

        if($SS_AREA== "AMT"){
            $CARTOTAL=$resul_sel_data_daily->CAR_AMT;
            $CARDAILY=$resul_sel_data_daily->DAILY_AMT;
        }else{
            $CARTOTAL=$resul_sel_data_daily->CAR_GW;
            $CARDAILY=$resul_sel_data_daily->DAILY_GW;
        }
        $WAIT_APPROVE=$resul_sel_data_daily->WAIT_APPROVE;
        $APPROVE_DONE=$resul_sel_data_daily->APPROVE_DONE;
        $DAILY_CHECK=$CARDAILY-$resul_sel_data_daily->DAILY_CHECK;
        $CHECK=$CARDAILY-$DAILY_CHECK;
        $NOCHECK=$CARDAILY-$CHECK;
        $dailyData = [
            'CARTOTAL' => $CARTOTAL,
            'CARDAILY' => $CARDAILY,
            'DAILY_CHECK' => $DAILY_CHECK,
            'CHECK' => $CHECK,
            'NOCHECK' => $NOCHECK,
            'WAIT_APPROVE' => $WAIT_APPROVE,
            'APPROVE_DONE' => $APPROVE_DONE
        ];
        $sel_chk_daily = $conn->prepare("EXECUTE ENB_DASHBOARD :proc,:datecheck,:area");
        $sel_chk_daily->execute(array(':proc'=>'dashboard_check',':datecheck'=>$datecheck,':area'=>$SS_AREA));
        $rs_chk_daily = [];
        while ($result = $sel_chk_daily->fetch(PDO::FETCH_OBJ)) {
            $rs_chk_daily[] = $result;
        }
        $response = [
            'dailyData' => $dailyData,
            'reportData' => $rs_chk_daily
        ];
        echo json_encode($response);
    }