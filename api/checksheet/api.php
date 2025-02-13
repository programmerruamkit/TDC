<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');

    $regis = $_POST["regis"];  
    $dateins = $_POST["datenow"]; 
    $time = $_POST["time"]; 
    $shid = $_POST["shid"];  
    $num = $_POST["num"];  
    $SSPSC = $_SESSION['AD_PERSONCODE'];

    if($regis == '00-00GW'){ 
        $query_checknext = $conn->prepare("EXECUTE ENB_SHEETEXAMSELECT :proc,:regis,:dateins,:person,:code,:shid,:num");
        $query_checknext->execute(array(':proc'=>'check_nextcartestgw',':regis'=>$regis,':dateins'=>$dateins,':person'=>$SSPSC,':code'=>$time,':shid'=>$shid,':num'=>$num,));
        $resul_checknext = $query_checknext->fetch(PDO::FETCH_OBJ);
    }else{ 
        $query_checknext = $conn->prepare("EXECUTE ENB_SHEETEXAMSELECT :proc,:regis,:dateins,:person,:code,:shid,:num");
        $query_checknext->execute(array(':proc'=>'check_next',':regis'=>$regis,':dateins'=>$dateins,':person'=>'',':code'=>$time,':shid'=>$shid,':num'=>$num,));
        $resul_checknext = $query_checknext->fetch(PDO::FETCH_OBJ);
    } 

    // echo json_encode([
    //     'RPRQ_SAVE_REPAIR' => $resul_checknext->RPRQ_SAVE_REPAIR
    // ]);
    echo json_encode($resul_checknext);
