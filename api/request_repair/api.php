<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');

    $PROC = $_POST["proc"];

    if($PROC=="RPM_NATUREREPAIR"){
        $TRPW_ID = $_POST['trpw_id'];
        $area = $_POST["area"];

        $query_typerepair = $conn->prepare("EXECUTE ENB_MAINTENANCE :proc,:area,:remark");
        $query_typerepair->execute(array(':proc' => 'select_naturerepair', ':area' => $area, ':remark' => $TRPW_ID));
    
        $options = [];
        while ($result_typerepair = $query_typerepair->fetch(PDO::FETCH_OBJ)) {
            $options[] = [
                'value' => $result_typerepair->TRPW_ID,
                'text'  => $result_typerepair->TRPW_NAME
            ];
        }

        if (!empty($options)) {
            echo json_encode($options);
        } else {
            echo json_encode([]);
        }
    } else {
        echo json_encode([]);
    }    
?>