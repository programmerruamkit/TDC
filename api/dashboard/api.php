<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');

    $PROC = $_POST["proc"];

    if($PROC=="dashboard"){
        $dateString = date('Y-m-d');
        $datecheck = date('Y-m-d', strtotime($dateString));  
        
        $query_sel_data_daily = $conn->prepare("EXECUTE ENB_DASHBOARD :proc,:datecheck");
        $query_sel_data_daily->execute(array(':proc'=>'dashboard',':datecheck'=>$datecheck,));
        $resul_sel_data_daily = $query_sel_data_daily->fetch(PDO::FETCH_OBJ);

        if($_SESSION["AD_AREA"]== "AMT"){
            $CARTOTAL=$resul_sel_data_daily->CAR_AMT;
            $CARDAILY=$resul_sel_data_daily->DAILY_AMT;
        }else{
            $CARTOTAL=$resul_sel_data_daily->CAR_GW;
            $CARDAILY=$resul_sel_data_daily->DAILY_GW;
        }
        $DAILY_CHECK=$CARDAILY-$resul_sel_data_daily->DAILY_CHECK;
        $CHECK=$CARDAILY-$DAILY_CHECK;
        $NOCHECK=$CARDAILY-$CHECK;

        echo json_encode([
            'CARTOTAL' => $CARTOTAL,
            'CARDAILY' => $CARDAILY,
            'CHECK' => $CHECK,
            'NOCHECK' => $NOCHECK
        ]);
        // echo json_encode($resul_sel_data_daily);
    }
