<?php
	session_start();
    
	// echo"<pre>";
	// print_r($_POST);
	// echo"</pre>";
    // echo "<pre>";
    // print_r($_GET['id']);
    // echo "</pre>";    
	// echo"<pre>";
	// print_r($_SESSION);
	// echo"</pre>";
	// exit();

    function loginsession($KEYWORD,$a0,$a1,$a2,$a3){
        $part = "../";   	
        include ($part.'config/connect.php');               
 
        if($a0==='100012'){
            $rsusername=100012;
        }else{
            $rsusername=$a0;
        }
        if($a1==='1234'){
            $rspassword=100012;
        }else{
            if($a1==='100012'){
                $rspassword=0;
            }else{
                $rspassword=$a1;
            }
        }
        
        $stmt = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username");
        $stmt->execute(array(':proc'=>'check_login',':username'=>$rsusername,));
        $row = $stmt->fetch(PDO::FETCH_OBJ); 
        if(!empty($row) && password_verify($rspassword, $row->RA_PASSWORD)) {            
            $_SESSION["auth"] = true;
            $_SESSION["start"] = time();
            $_SESSION["expire"] = $_SESSION["start"] + (5*60);
            // $_SESSION["expire"] = $_SESSION["start"] + (30*60);
            $_SESSION["AD_ID"] = $row->ID;
            $_SESSION['AD_PERSONID'] = $row->PersonID;
            $_SESSION['AD_PERSONCODE'] = $row->PersonCode;
            $_SESSION['AD_FIRSTNAME'] = $row->FnameT;
            $_SESSION['AD_LASTNAME'] = $row->LnameT;
            $_SESSION['AD_NAMETHAI'] = $row->nameT;
            $_SESSION['AD_NAMEENGLISH'] = $row->nameE;
            $_SESSION['AD_CURRENTTEL'] = $row->CurrentTel;
            $_SESSION['AD_COMPANYCODE'] = $row->Company_Code;
            $_SESSION['AD_COMPANYNAME'] = $row->Company_NameT;
            $_SESSION['AD_POSITIONID'] = $row->PositionID;
            $_SESSION['AD_POSITION'] = $row->PositionNameT;
            $_SESSION['AD_ROLEACCOUNT_USERNAME'] = $row->RA_USERNAME;
            $_SESSION['AD_ROLEACCOUNT_PASSWORD'] = $row->RA_PASSWORD;
            $_SESSION['AD_ROLE_ID'] = $row->RU_ID;
            $_SESSION["AD_ROLE_NAME"] = $row->RU_NAME;
            $_SESSION["AD_AREA"] = $row->AREA;
            $_SESSION["AD_REGISTRATION"] = $a2;
            $_SESSION["AD_PERIOD"] = $a3;
                        
            date_default_timezone_set("Asia/Bangkok");
            $proc = 'insert_login';
            $SSPSC = $_SESSION['AD_PERSONCODE'];
            $SSROID ='';
            $SSLGS = 1;
            $SSLGD = date("Y-m-d H:i:s");
            $chk = 0;
            
            $check = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username");
            $check->execute(array(':proc'=>'check_oldlogin',':username'=>$rsusername,));
            $chk1null = $check->fetch(PDO::FETCH_OBJ); 
            if(!isset($chk1null->PersonCode)) {
                $stm_loging = $conn->prepare('INSERT INTO LOGING (PersonCode,RU_ID,LOGING_STATUS,LOGING_DATETIME,LAC) VALUES (:personcode,:ruid,:lgst,:lgdt,:lac)');
                $stm_loging->execute(array(':personcode'=>$SSPSC,':ruid'=>$SSROID,':lgst'=>$SSLGS,':lgdt'=>$SSLGD,':lac'=>'LA1',));
                if($stm_loging === false){ 
                    $RS="error";
                }else{
                    $RS="complete";
                }			
            }else{    
                $count = $conn->exec("UPDATE LOGING SET LOGING_DATETIME = '".date("Y-m-d H:i:s")."' WHERE PersonCode = $row->PersonCode");
                if($count){  
                    $RS="complete";
                } else {
                    $RS="error";
                }
            }
        } else {
            $RS="error";
        }
        echo json_encode($RS);
        return $RS;
    }
    
    function rolesession($KEYWORD,$a0,$a1,$a2,$a3){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $stmt = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username,:password,:role,:roleaccount");
        $stmt->execute(array(':proc'=>'check_role',':username'=>$a0,':password'=>$a1,':role'=>$a2,':roleaccount'=>$a3,));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if(!empty($row)) {             
            $_SESSION["AD_ID"] = $row->ID;
            $_SESSION['AD_PERSONID'] = $row->PersonID;
            $_SESSION['AD_PERSONCODE'] = $row->PersonCode;
            $_SESSION['AD_FIRSTNAME'] = $row->FnameT;
            $_SESSION['AD_LASTNAME'] = $row->LnameT;
            $_SESSION['AD_NAMETHAI'] = $row->nameT;
            $_SESSION['AD_NAMEENGLISH'] = $row->nameE;
            $_SESSION['AD_CURRENTTEL'] = $row->CurrentTel;
            $_SESSION['AD_COMPANYCODE'] = $row->Company_Code;
            $_SESSION['AD_COMPANYNAME'] = $row->Company_NameT;
            $_SESSION['AD_POSITIONID'] = $row->PositionID;
            $_SESSION['AD_POSITION'] = $row->PositionNameT;
            $_SESSION['AD_ROLEACCOUNT_USERNAME'] = $row->RA_USERNAME;
            $_SESSION['AD_ROLEACCOUNT_PASSWORD'] = $row->RA_PASSWORD;
            $_SESSION['AD_ROLE_ID'] = $row->RU_ID;
            $_SESSION["AD_ROLE_NAME"] = $row->RU_NAME;
            $_SESSION["AD_AREA"] = $row->AREA;
            $_SESSION["AD_ROLE_NAME"] = $row->RU_NAME;

            $RS="complete";
        } else {
            $RS="error";
        }
        echo json_encode($RS);
        return $RS;
    }

    function menumainsubmanage($KEYWORD,$MN_CODE,$MN_NAME,$MN_ICON,$MN_URL,$MN_SORT,$MN_STATUS,$PROC,$MN_LEVEL,$MN_PARENT){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="MN_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_MN_CODE = $rand;
            $sql = "INSERT INTO MENU (MN_CODE,MN_NAME,MN_LEVEL,MN_SORT,MN_PARENT,MN_ICON,MN_URL,MN_STATUS,MN_CREATEBY,MN_CREATEDATE)
                    VALUES ('$NEW_MN_CODE','$MN_NAME','$MN_LEVEL','$MN_SORT','$MN_PARENT','$MN_ICON','$MN_URL','$MN_STATUS','$PROCESS_BY','$PROCESS_DATE')";
        }
        if($PROC=="edit"){
            $sql = "UPDATE MENU SET 
                    MN_NAME = '$MN_NAME',
                    MN_LEVEL = '$MN_LEVEL',
                    MN_SORT = '$MN_SORT',
                    MN_PARENT = '$MN_PARENT',
                    MN_ICON = '$MN_ICON',
                    MN_URL = '$MN_URL',
                    MN_STATUS = '$MN_STATUS',
                    MN_EDITBY = '$PROCESS_BY',
                    MN_EDITDATE = '$PROCESS_DATE'
                    WHERE MN_CODE = '$MN_CODE'";
        }
        if($PROC=="delete"){            
            $sql = "UPDATE MENU SET 
                    MN_STATUS = 'D',
                    MN_EDITBY = '$PROCESS_BY',
                    MN_EDITDATE = '$PROCESS_DATE'
                    WHERE MN_CODE = '$MN_CODE'";
        }	
        $result = $conn->query($sql);   
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }	
        echo json_encode($RS);
        return $RS;
    }
    
    function rolemainmanage($KEYWORD,$RU_CODE,$RU_NAME,$RU_AREA,$RU_STATUS,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="RU_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_RU_CODE = $rand;
            $sql = "INSERT INTO ROLE_USER (RU_CODE,RU_NAME,RU_AREA,RU_STATUS,RU_CREATE_BY, RU_CREATE_DATE)
                    VALUES ('$NEW_RU_CODE','$RU_NAME','$RU_AREA','$RU_STATUS','$PROCESS_BY','$PROCESS_DATE')";
        }
        if($PROC=="edit"){
            $sql = "UPDATE ROLE_USER SET 
                    RU_NAME = '$RU_NAME',
                    RU_AREA = '$RU_AREA',
                    RU_STATUS = '$RU_STATUS',
                    RU_EDIT_BY = '$PROCESS_BY',
                    RU_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RU_CODE = '$RU_CODE'";
        }
        if($PROC=="delete"){    
            $sql = "UPDATE ROLE_USER SET 
                    RU_STATUS = 'D',
                    RU_EDIT_BY = '$PROCESS_BY',
                    RU_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RU_CODE = '$RU_CODE'";	
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }	
        echo json_encode($RS);
        return $RS;
    }
    
    function rolesubmanage($KEYWORD,$RM_CODE,$MN_ID,$RM_STATUS,$RU_ID,$RM_ID,$AREA,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="RM_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_RM_CODE = $rand;

            $sql = "INSERT INTO ROLE_MENU (RU_ID,RM_CODE,MN_ID,RM_STATUS,AREA,RM_CREATE_BY,RM_CREATE_DATE)
                    VALUES ('$RU_ID','$NEW_RM_CODE','$MN_ID','$RM_STATUS','$AREA','$PROCESS_BY','$PROCESS_DATE')";	
        }
        if($PROC=="edit"){
            $sql = "UPDATE ROLE_MENU SET 
                    MN_ID = '$MN_ID',
                    AREA = '$AREA',
                    RM_STATUS = '$RM_STATUS',
                    RM_EDIT_BY = '$PROCESS_BY',
                    RM_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RM_ID = '$RM_ID'";
        }
        if($PROC=="delete"){    
            $sql = "UPDATE ROLE_MENU SET 
                    RM_STATUS = 'D',
                    RM_EDIT_BY = '$PROCESS_BY',
                    RM_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RM_CODE = '$RM_CODE'";
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }		
        echo json_encode($RS);
        return $RS;
    }
    
    function usermainmanage($KEYWORD,$RA_CODE,$RA_PERSONCODE,$RU_ID,$RA_PASSWORD,$RA_STATUS,$RA_PASSWORD_TEXT,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="RA_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_RA_CODE = $rand;
            if($RA_PASSWORD!=''){
                $RSPASS = $RA_PASSWORD;
                $RSPASS_TEXT = $RA_PASSWORD_TEXT;
            }else{
                $RSPASS = password_hash($RA_PERSONCODE, PASSWORD_DEFAULT);
                $RSPASS_TEXT = $RA_PERSONCODE;
            }

            $check = $conn->prepare("SELECT DISTINCT RA_PERSONCODE,RA_PASSWORD,RA_PASSWORD_TEXT FROM ROLE_ACCOUNT WHERE RA_PERSONCODE = :personcode AND RA_STATUS = 'Y'");
            $check->execute(array(":personcode" => $RA_PERSONCODE));
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if(empty($chk1null)) {
                $sql = "INSERT INTO ROLE_ACCOUNT (RA_CODE,RA_PERSONCODE, RU_ID, RA_USERNAME, RA_PASSWORD, RA_PASSWORD_TEXT, RA_STATUS, RA_CREATE_BY, RA_CREATE_DATE)
                        VALUES ('$NEW_RA_CODE','$RA_PERSONCODE','$RU_ID','$RA_PERSONCODE','$RSPASS','$RSPASS_TEXT','$RA_STATUS','$PROCESS_BY','$PROCESS_DATE')";
            }else{    
                $RS="error";
            }	
        }
        if($PROC=="addnewrole"){
            $NEW_RA_CODE = $rand;
            $check = $conn->prepare("SELECT DISTINCT RA_PERSONCODE,RA_PASSWORD,RA_PASSWORD_TEXT FROM ROLE_ACCOUNT WHERE RA_PERSONCODE = :personcode AND RA_STATUS = 'Y'");
            $check->execute(array(":personcode" => $RA_PERSONCODE));
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if(empty($chk1null)) {
                $RSPASS = password_hash($RA_PERSONCODE, PASSWORD_DEFAULT);
                $RSPASS_TEXT = $RA_PERSONCODE;
                $sql = "INSERT INTO ROLE_ACCOUNT (RA_CODE,RA_PERSONCODE, RU_ID, RA_USERNAME, RA_PASSWORD, RA_PASSWORD_TEXT, RA_STATUS, RA_CREATE_BY, RA_CREATE_DATE)
                        VALUES ('$NEW_RA_CODE','$RA_PERSONCODE','$RU_ID','$RA_PERSONCODE','$RSPASS','$RSPASS_TEXT','$RA_STATUS','$PROCESS_BY','$PROCESS_DATE')";
            }else{   
                $RSPASS = $chk1null->RA_PASSWORD;
                $RSPASS_TEXT = $chk1null->RA_PASSWORD_TEXT; 
                $sql = "INSERT INTO ROLE_ACCOUNT (RA_CODE,RA_PERSONCODE, RU_ID, RA_USERNAME, RA_PASSWORD, RA_PASSWORD_TEXT, RA_STATUS, RA_CREATE_BY, RA_CREATE_DATE)
                        VALUES ('$NEW_RA_CODE','$RA_PERSONCODE','$RU_ID','$RA_PERSONCODE','$RSPASS','$RSPASS_TEXT','$RA_STATUS','$PROCESS_BY','$PROCESS_DATE')";
            }
        }
        if($PROC=="deleteuser"){    
            $sql = "UPDATE ROLE_ACCOUNT SET 
                    RA_STATUS = 'D',
                    RA_EDIT_BY = '$PROCESS_BY',
                    RA_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RA_PERSONCODE = '$RA_PERSONCODE'";		
        }
        if($PROC=="deleterole"){    
            $sql = "UPDATE ROLE_ACCOUNT SET 
                    RA_STATUS = 'D',
                    RA_EDIT_BY = '$PROCESS_BY',
                    RA_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RA_ID = '$RU_ID'";		
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }		
        echo json_encode($RS);
        return $RS;
    }
    
    function carmainmanage($KEYWORD,$a0,$a1,$a2,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="VHCCTMG_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="cargroup"){	
            $filed='LW_ID';
        }else if($PROC=="dateexpire"){
            $filed='VHCTMG_DATEEXPIRE';
        }
        
        $check = $conn->prepare("SELECT DISTINCT VHCTMG_VEHICLEREGISNUMBER FROM VEHICLECARTYPEMATCHGROUP WHERE VHCTMG_VEHICLEREGISNUMBER = :a0");
        $check->execute(array(":a0" => $a0));
        $chk1null = $check->fetch(PDO::FETCH_OBJ);
        if(empty($chk1null)) {
            $NEW_VHCTMG_CODE = $rand;
            $sql = "INSERT INTO VEHICLECARTYPEMATCHGROUP (VHCTMG_CODE,VHCTMG_VEHICLEREGISNUMBER, $filed, VHCTMG_COMPANY, VHCTMG_CREATEBY, VHCTMG_CREATEDATE)
                    VALUES ('$NEW_VHCTMG_CODE','$a0','$a1','$a2','$PROCESS_BY','$PROCESS_DATE')";
        }else{    
            $sql = "UPDATE VEHICLECARTYPEMATCHGROUP SET 
                $filed = '$a1',
                VHCTMG_EDITBY = '$PROCESS_BY',
                VHCTMG_EDITDATE = '$PROCESS_DATE'
                WHERE VHCTMG_VEHICLEREGISNUMBER = '$a0'";
        }
        $result = $conn->query($sql);	
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }	
        echo json_encode($RS);
        return $RS;
    }
    
    function settingmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       

        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="edit"){
            $sql = "UPDATE SETTING SET 
                ST_TITLE = '$a1',
                ST_NAMETH = '$a2',
                ST_NAMEEN = '$a3',
                ST_NAMEEN_SHOT = '$a4',
                ST_ICON = '$a5',
                ST_LOGO_LIGHT = '$a6',
                ST_LOGO_DARK = '$a7',
                ST_DES0 = '$a8',
                ST_DES1 = '$a9'
                WHERE ST_ID = '$a0'";
        }
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }	
        echo json_encode($RS);
        return $RS;
    }
    
    function lineworkmanage($KEYWORD,$a0,$a1,$a2,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="LW_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");
        

        if($PROC=="add"){
            $NEW_LW_CODE = $rand;

            $check = $conn->prepare("SELECT DISTINCT LW_CODE,LW_LINEOFWORK FROM LINEWORK WHERE LW_LINEOFWORK = :a1");
            $check->execute(array(":a1" => $a1));
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if(empty($chk1null)) {
                $sql = "INSERT INTO LINEWORK (LW_CODE,LW_LINEOFWORK, LW_STATUS, LW_AREA, LW_CREATEBY, LW_CREATEDATE)
                        VALUES ('$NEW_LW_CODE','$a1','$a2','".$_SESSION["AD_AREA"]."','$PROCESS_BY','$PROCESS_DATE')";
            }else{    
                $RS="error";
            }	
        }
        if($PROC=="edit"){    
            $sql = "UPDATE LINEWORK SET 
                    LW_LINEOFWORK = '$a1',
                    LW_STATUS = '$a2',
                    LW_EDITBY = '$PROCESS_BY',
                    LW_EDITDATE = '$PROCESS_DATE'
                    WHERE LW_CODE = '$a0'";	
        }
        if($PROC=="delete"){    
            $sql = "UPDATE LINEWORK SET 
                    LW_STATUS = 'D',
                    LW_EDITBY = '$PROCESS_BY',
                    LW_EDITDATE = '$PROCESS_DATE'
                    WHERE LW_CODE = '$a0'";			
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }
        echo json_encode($RS);
        return $RS;
    }
    
    function listmainmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="SH_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_SH_CODE = $rand;

            $sql = "INSERT INTO SHEET (SH_CODE,SH_NAME,SH_TIMES,SH_EFFECT,SH_STATUS,LW_ID,SH_AREA,SH_CREATEBY,SH_CREATEDATE)
                    VALUES ('$NEW_SH_CODE','$a1','$a2','$a3','$a4','$a5','".$_SESSION["AD_AREA"]."','$PROCESS_BY','$PROCESS_DATE')";
        }
        if($PROC=="edit"){    
            $sql = "UPDATE SHEET SET 
                    SH_NAME = '$a1',
                    SH_TIMES = '$a2',
                    SH_EFFECT = '$a3',
                    SH_STATUS = '$a4',
                    LW_ID = '$a5',
                    SH_EDITBY = '$PROCESS_BY',
                    SH_EDITDATE = '$PROCESS_DATE'
                    WHERE SH_CODE = '$a0'";	
        }
        if($PROC=="delete"){    
            $sql = "UPDATE SHEET SET 
                    SH_STATUS = 'D',
                    SH_EDITBY = '$PROCESS_BY',
                    SH_EDITDATE = '$PROCESS_DATE'
                    WHERE SH_CODE = '$a0'";			
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }
        echo json_encode($RS);
        return $RS;
    }
    
    function sheetlistmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        } 
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $sql = '';
            for($count = 0; $count<count($a1); $count++){ 
                $rand="SHL_".RandNum($n);
                $NEW_SHL_CODE = $rand;
                $a1_clean = $a1[$count];
                $a2_clean = $a2[$count];
                $a3_clean = $a3[$count];
                $a4_clean = $a4[$count];
                $a5_clean = $a5[$count];
                $a6_clean = $a6[$count];
                $a7_clean = $a7[$count];
                if($a1_clean != '' && $a2_clean != '' && $a3_clean != '' && $a4_clean != '' && $a5_clean != '' && $a6_clean != '' && $a7_clean != ''){
                    $sql .= "INSERT INTO SHEET_LIST (SHL_CODE,SH_ID,SHL_NUMBER,SHL_NAME,SHL_DESCRIPTION,SHL_RANK,SHL_HOWTO,SHL_TIME,SHL_PERIODTIME,SHL_CREATEBY,SHL_CREATEDATE)
                    VALUES('$NEW_SHL_CODE','$a8','$a1_clean','$a2_clean','$a3_clean','$a4_clean','$a5_clean','$a6_clean','$a7_clean','$PROCESS_BY','$PROCESS_DATE');";
                }
            }
        }
        if($PROC=="edit"){    
            $sql = '';
            for($count = 0; $count<count($a1); $count++){
                $a1_clean = $a1[$count];
                $a2_clean = $a2[$count];
                $a3_clean = $a3[$count];
                $a4_clean = $a4[$count];
                $a5_clean = $a5[$count];
                $a6_clean = $a6[$count];
                $a7_clean = $a7[$count];
                if($a1_clean != '' && $a2_clean != '' && $a3_clean != '' && $a4_clean != '' && $a5_clean != '' && $a6_clean != '' && $a7_clean != ''){
                    $sql .= "UPDATE SHEET_LIST SET 
                    SHL_NUMBER = '$a1_clean',
                    SHL_NAME = '$a2_clean',
                    SHL_DESCRIPTION = '$a3_clean',
                    SHL_RANK = '$a4_clean',
                    SHL_HOWTO = '$a5_clean',
                    SHL_TIME = '$a6_clean',
                    SHL_PERIODTIME = '$a7_clean',
                    SHL_EDITBY = '$PROCESS_BY',
                    SHL_EDITDATE = '$PROCESS_DATE'
                    WHERE SHL_CODE = '$a0'";	
                }
            }
        }
        if($PROC=="add4L"){
            $sql = '';
            for($count = 0; $count<count($a1); $count++){ 
                $rand="SHL_".RandNum($n);
                $NEW_SHL_CODE = $rand;
                $a1_clean = $a1[$count];
                $a2_clean = $a2[$count];
                $a3_clean = $a3[$count];
                if($a1_clean != '' && $a2_clean != '' && $a3_clean != ''){
                    $sql .= "INSERT INTO SHEET_LIST (SHL_CODE,SH_ID,SHL_NUMBER,SHL_NAME,SHL_PERIODTIME,SHL_CREATEBY,SHL_CREATEDATE)
                    VALUES('$NEW_SHL_CODE','$a8','$a1_clean','$a2_clean','$a3_clean','$PROCESS_BY','$PROCESS_DATE');";
                }
            }
        }
        if($PROC=="edit4L"){    
            $sql = '';
            for($count = 0; $count<count($a1); $count++){
                $a1_clean = $a1[$count];
                $a2_clean = $a2[$count];
                $a3_clean = $a3[$count];
                if($a1_clean != '' && $a2_clean != '' && $a3_clean != ''){
                    $sql .= "UPDATE SHEET_LIST SET 
                    SHL_NUMBER = '$a1_clean',
                    SHL_NAME = '$a2_clean',
                    SHL_PERIODTIME = '$a3_clean',
                    SHL_EDITBY = '$PROCESS_BY',
                    SHL_EDITDATE = '$PROCESS_DATE'
                    WHERE SHL_CODE = '$a0'";	
                }
            }
        }
        if($PROC=="delete"){    
            $sql = "DELETE FROM SHEET_LIST WHERE SHL_CODE = '$a0' ";
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }
        echo json_encode($RS);
        return $RS;
    }
    
    function checksheetquestion($KEYWORD,$PROC,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8){
        $part = "../";   	
        include ($part.'config/connect.php');       
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        } 
        $n2=9;
        function RandNum2($n2) {
            $characters2 = '0123456789';
            $randomString2 = '';      
            for ($i2 = 0; $i2 < $n2; $i2++) {
                $index2 = rand(0, strlen($characters2) - 1);
                $randomString2 .= $characters2[$index2];
            }      
            return $randomString2;
        } 
        $rand="SHLC_".RandNum($n);
        $rand_request="RPRQ_".RandNum($n);
        $rand_id="#".RandNum2($n2);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){ 
            $check = $conn->prepare("SELECT DISTINCT SHLR_CODE FROM SHEET_LIST_RECORD WHERE SHLR_CODE = :code AND SH_ID = :shid AND SHL_NUMBER = :num");
            $check->execute(array(":code" => $a1,":shid" => $a2,":num" => $a3));
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if(empty($chk1null)) {
                $sql = "INSERT INTO SHEET_LIST_RECORD (SHLR_CODE,SH_ID,SHL_NUMBER,$a4,SHLR_REGIS,SHLR_DATEINSERT,SHLR_PERIODTIME,SHLR_CREATEBY,SHLR_CREATEDATE)
                        VALUES ('$a1','$a2','$a3','$a5','$a6','$a7','$a8','$PROCESS_BY','$PROCESS_DATE')";
            }else{    
                $sql = "UPDATE SHEET_LIST_RECORD SET 
                        $a4 = '$a5',
                        SHLR_REMARK = null,
                        SHLR_IMG1 = null,
                        SHLR_IMG2 = null,
                        USE_TAB = null,
                        RPRQ_SAVE_REPAIR = null,
                        RPRQ_REQUESTCARDATE = null,
                        RPRQ_REQUESTCARTIME = null,
                        RPRQ_USECARDATE = null,
                        RPRQ_USECARTIME = null,
                        RPRQ_AREA = null,
                        RPRQ_CREATEDATE_REQUEST = null,
                        RPRQ_TYPEREPAIRWORK = null,
                        RPRQ_REQUESTBY_SQ = null,
                        RPM_NATUREREPAIR = null,
                        RPRQ_TYPEREPAIRWORK_NAME = null,
                        SHLR_EDITBY = '$PROCESS_BY',
                        SHLR_EDITDATE = '$PROCESS_DATE'
                        WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";	
            }
            if($a3=='1'){
                $NEW_SHLC_CODE=$rand;
                
                $checknum1 = $conn->prepare("SELECT DISTINCT SHLR_CODE FROM SHEET_LIST_CONFIRM WHERE SHLR_CODE = :code");
                $checknum1->execute(array(":code" => $a1,));
                $rs_checknum1 = $checknum1->fetch(PDO::FETCH_OBJ);
                if(empty($rs_checknum1)) {
                    $sql2 = "INSERT INTO SHEET_LIST_CONFIRM (SHLC_CODE,SHLR_CODE,SHLC_STATUS,SHLC_REGIS,SHLC_DATEINSERT,SHLC_PERIODTIME,SHLC_CREATEBY,SHLC_CREATEDATE,SHLC_ID_RANDOM,SHLC_AREA)
                            VALUES ('$NEW_SHLC_CODE','$a1','wait','$a6','$a7','$a8','$PROCESS_BY','$PROCESS_DATE','$rand_id','".$_SESSION["AD_AREA"]."')";
                    $result2 = $conn->query($sql2);
                }
            }
        }
        if($PROC=="addremark"){ 
            $sql = "UPDATE SHEET_LIST_RECORD SET 
                    $a4 = '$a5',
                    SHLR_EDITBY = '$PROCESS_BY',
                    SHLR_EDITDATE = '$PROCESS_DATE'
                    WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";	
        }
        if($PROC=="edit"){    
            $sql = "UPDATE SHEET SET 
                    SH_NAME = '$a1',
                    SH_TIMES = '$a2',
                    SH_EFFECT = '$a3',
                    SH_STATUS = '$a4',
                    LW_ID = '$a5',
                    SH_EDITBY = '$PROCESS_BY',
                    SH_EDITDATE = '$PROCESS_DATE'
                    WHERE SH_CODE = '$a0'";	
        }	
        if($PROC=="addimage"){    
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt');
            $path = '../uploads/'; 
            if (isset($_FILES['image1']) && $_FILES['image1']['error'] == 0) {
                $img = $_FILES['image1']['name'];
                $tmp = $_FILES['image1']['tmp_name'];
            }
            if (isset($_FILES['image2']) && $_FILES['image2']['error'] == 0) {
                $img = $_FILES['image2']['name'];
                $tmp = $_FILES['image2']['tmp_name'];
            }
            if (isset($_FILES['image3']) && $_FILES['image3']['error'] == 0) {
                $img = $_FILES['image3']['name'];
                $tmp = $_FILES['image3']['tmp_name'];
            }
            if (isset($_FILES['image4']) && $_FILES['image4']['error'] == 0) {
                $img = $_FILES['image4']['name'];
                $tmp = $_FILES['image4']['tmp_name'];
            }
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $final_image = strtoupper($a1).'_'.rand(10,100).$img;
            if(in_array($ext, $valid_extensions)){ 
                $nameimg = $path.strtolower($final_image); 
                if(move_uploaded_file($tmp,$nameimg)){
                    shell_exec("icacls \"$nameimg\" /grant IIS_IUSRS:R");
                    echo "<div class='mb-3'><b>รูปภาพใหม่</b><img src='uploads/$final_image' width='50%'></div>";                        
                    $sql = "UPDATE SHEET_LIST_RECORD SET 
                        $a4 = '$final_image',
                        SHLR_EDITBY = '$PROCESS_BY',
                        SHLR_EDITDATE = '$PROCESS_DATE'
                        WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";	
                    //echo $insert?'ok':'err';
                    if(isset($a5) && !empty($a5)) {
                        $filePath = $path.$a5;
                        if(file_exists($filePath)) {
                            unlink($filePath);
                        }else{
                            echo "";
                        }
                    }else{
                        echo "";
                    }
                }
            }else{
                echo 'อัพโหลดไม่สำเร็จนะจ๊ะ';
            }
        }
        if($PROC=="success"){    
            $sql = "UPDATE SHEET_LIST_CONFIRM SET 
                    SHLC_STATUS = 'success',
                    SHLC_EDITBY = '$PROCESS_BY',
                    SHLC_EDITDATE = '$PROCESS_DATE'
                    WHERE SHLR_CODE = '$a1' AND SHLC_REGIS = '$a6' AND SHLC_DATEINSERT = '$a7' AND SHLC_PERIODTIME = '$a8'";
        }
        if($PROC=="stopchecking"){    
            $sql = "UPDATE SHEET_LIST_CONFIRM SET 
                    SHLC_STATUS = 'stopchecking',
                    SHLC_EDITBY = '$PROCESS_BY',
                    SHLC_EDITDATE = '$PROCESS_DATE'
                    WHERE SHLR_CODE = '$a1' AND SHLC_REGIS = '$a6' AND SHLC_DATEINSERT = '$a7' AND SHLC_PERIODTIME = '$a8'";
        }
        if($PROC=="nullnorepair"){ 
            $path = '../uploads/'; 
            $check = $conn->prepare("SELECT SHLR_IMG1,SHLR_IMG2 FROM SHEET_LIST_RECORD WHERE SHLR_CODE = :code AND SH_ID = :shid AND SHL_NUMBER = :num");
            $check->execute(array(":code" => $a1,":shid" => $a2,":num" => $a3));
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if(empty($chk1null)) {
                if(isset($a4) && !empty($a4)) {$filePatha4 = $path.$a4;if(file_exists($filePatha4)) {unlink($filePatha4);}else{echo "";}}else{echo "";}
                if(isset($a5) && !empty($a5)) {$filePatha5 = $path.$a5;if(file_exists($filePatha5)) {unlink($filePatha5);}else{echo "";}}else{echo "";}  
            }else{
                if(isset($chk1null->SHLR_IMG1) && !empty($chk1null->SHLR_IMG1)) {$filePatha4 = $path.$chk1null->SHLR_IMG1;if(file_exists($filePatha4)) {unlink($filePatha4);}else{echo "";}}else{echo "";}
                if(isset($chk1null->SHLR_IMG2) && !empty($chk1null->SHLR_IMG2)) {$filePatha5 = $path.$chk1null->SHLR_IMG2;if(file_exists($filePatha5)) {unlink($filePatha5);}else{echo "";}}else{echo "";}               
            }
            $sql = "UPDATE SHEET_LIST_RECORD SET 
                    USE_TAB = '$a8',
                    SHLR_REMARK = null,
                    SHLR_IMG1 = null,
                    SHLR_IMG2 = null,
                    RPRQ_SAVE_REPAIR = null,
                    RPRQ_REQUESTCARDATE = null,
                    RPRQ_REQUESTCARTIME = null,
                    RPRQ_USECARDATE = null,
                    RPRQ_USECARTIME = null,
                    RPRQ_AREA = null,
                    RPRQ_CREATEDATE_REQUEST = null,
                    RPRQ_TYPEREPAIRWORK = null,
                    RPRQ_REQUESTBY_SQ = null,
                    RPM_NATUREREPAIR = null,
                    RPRQ_TYPEREPAIRWORK_NAME = null
                    WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3'";	 
        }
        if($PROC=="addrequest"){
            $SESSION_AREA=$_SESSION["AD_AREA"];
            $RPRQ_CREATEDATE_REQUEST = date("d/m/Y");
            if($a4=='RPRQ_REQUESTCARDATETIME'){
                $datetimeRequest_in = $a5;
                $exin = explode("T", $datetimeRequest_in);
                $exin1 = $exin[0];
                $exin2 = $exin[1]; 
                $RPRQ_REQUESTCARDATE = $exin1;
                $RPRQ_REQUESTCARTIME = $exin2;
                $sql = "UPDATE SHEET_LIST_RECORD SET 
                        RPRQ_REQUESTCARDATE = '$RPRQ_REQUESTCARDATE',
                        RPRQ_REQUESTCARTIME = '$RPRQ_REQUESTCARTIME'
                        WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";	
            }else if($a4=='RPRQ_USECARDATETIME'){
                $datetimeRequest_out = $a5;
                $exout = explode("T", $datetimeRequest_out);
                $exout1 = $exout[0];
                $exout2 = $exout[1]; 
                $RPRQ_USECARDATE = $exout1;
                $RPRQ_USECARTIME = $exout2;
                $sql = "UPDATE SHEET_LIST_RECORD SET 
                        RPRQ_USECARDATE = '$RPRQ_USECARDATE',
                        RPRQ_USECARTIME = '$RPRQ_USECARTIME'
                        WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";	
            }else if($a4=='RPRQ_TYPEREPAIRWORK'){
                    $query_typerepair = $conn->prepare("EXECUTE ENB_MAINTENANCE :proc,:area,:remark");
                    $query_typerepair->execute(array(':proc'=>'select_typerepair',':area'=>$SESSION_AREA,':remark'=>$a5));
                    $result_typerepair = $query_typerepair->fetch(PDO::FETCH_OBJ);
                    $sql = "UPDATE SHEET_LIST_RECORD SET 
                            RPRQ_TYPEREPAIRWORK = '$a5',
                            RPRQ_TYPEREPAIRWORK_NAME = '$result_typerepair->TRPW_NAME'
                            WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";
            }else{
                $sql = "UPDATE SHEET_LIST_RECORD SET 
                        $a4 = '$a5',
                        RPRQ_CREATEDATE_REQUEST = '$RPRQ_CREATEDATE_REQUEST',
                        RPRQ_AREA = '$SESSION_AREA'
                        WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";	
            }
        }
        if($PROC=="repairrequest"){                 
            $RPRQ_CODE=$rand_request;
            
            $select_data = $conn->prepare("EXECUTE ENB_SHEETEXAMSELECT :proc,:regis,:dateins,:person,:code,:shid,:num");
            $select_data->execute(array(':proc'=>'check_select',':regis'=>'',':dateins'=>'',':person'=>'',':code'=>$a1,':shid'=>$a2,':num'=>$a3,));
            $result_data = $select_data->fetch(PDO::FETCH_OBJ);
            
            $query_car = $conn->prepare("EXECUTE ENB_SHEETEXAM :proc,:regis");
            $query_car->execute(array(':proc'=>'select_data',':regis'=>$result_data->SHLR_REGIS,));
            $result_car = $query_car->fetch(PDO::FETCH_OBJ); 

            $sql = "INSERT INTO TEST_EMS2_203.dbo.REPAIRREQUEST (RPRQ_CODE,RPRQ_WORKTYPE,RPRQ_NUMBER,RPRQ_REGISHEAD,RPRQ_CARNAMEHEAD,
            RPRQ_REGISTAIL,RPRQ_CARNAMETAIL,
            RPRQ_CARTYPE,RPRQ_LINEOFWORK,RPRQ_REQUESTCARDATE,RPRQ_REQUESTCARTIME,RPRQ_USECARDATE,RPRQ_USECARTIME,RPRQ_PRODUCTINCAR,RPRQ_NATUREREPAIR,RPRQ_TYPECUSTOMER,RPRQ_COMPANYCASH,
            RPRQ_REQUESTBY,RPRQ_REQUESTBY_SQ,RPRQ_CREATEDATE_REQUEST,RPRQ_AREA,RPRQ_STATUS,RPRQ_STATUSREQUEST,RPRQ_CREATEBY,RPRQ_CREATEDATE,RPRQ_TYPEREPAIRWORK) 
            VALUES ('$RPRQ_CODE','BM','BM-1','$result_car->VEHICLEREGISNUMBER','$result_car->THAINAME',
            null,null,
            '$result_car->VEHICLETYPEDESC','$result_car->SUB_LINEOFWORK','$result_data->RPRQ_REQUESTCARDATE','$result_data->RPRQ_REQUESTCARTIME','$result_data->RPRQ_USECARDATE','$result_data->RPRQ_USECARTIME','ist','bfw','cusin','$result_car->SUB_LINEOFWORK',
            '$PROCESS_BY','$result_data->RPRQ_REQUESTBY_SQ','$result_data->RPRQ_CREATEDATE_REQUEST','$result_data->RPRQ_AREA','Y','รอส่งแผน','$PROCESS_BY','$PROCESS_DATE','$result_data->RPRQ_TYPEREPAIRWORK')";

            $sql_cause = "INSERT INTO TEST_EMS2_203.dbo.REPAIRCAUSE (RPRQ_CODE,RPC_SUBJECT,RPC_DETAIL) 
            VALUES ('$RPRQ_CODE','$result_data->RPM_NATUREREPAIR','$result_data->SHLR_REMARK')";
            $result_cause = $conn->query($sql_cause);

            $old_folder = "../uploads/";
            $new_folder = "../../TEST/uploads/";
            if(isset($result_data->SHLR_IMG1)){
                $image_path1 = $result_data->SHLR_IMG1;
                $source_file1 = $old_folder.$image_path1;
                $destination_file1 = $new_folder.$image_path1;
                if (file_exists($source_file1)) {
                    $result1 = copy($source_file1, $destination_file1); 
                    if ($result1) {
                        // $RS="complete";                         
						$sql_img1 = "INSERT INTO TEST_EMS2_203.dbo.REPAIRCAUSE_IMAGE (RPRQ_CODE,RPC_SUBJECT,RPCIM_GROUP,RPCIM_IMAGES,RPCIM_PROCESSBY,RPCIM_PROCESSDATE) 
                        VALUES ('$RPRQ_CODE','$result_data->RPM_NATUREREPAIR',null,'$image_path1','$PROCESS_BY','$PROCESS_DATE')";
                        $result_img1 = $conn->query($sql_img1);
                    } else {
                        $RS="error";
                    }
                } else {
                    $RS="complete";
                }
            }
            if(isset($result_data->SHLR_IMG2)){
                $image_path2 = $result_data->SHLR_IMG2;
                $source_file2 = $old_folder.$image_path2;
                $destination_file2 = $new_folder.$image_path2;
                if (file_exists($source_file2)) {
                    $result2 = copy($source_file2, $destination_file2); 
                    if ($result2) {
                        // $RS="complete";
						$sql_img2 = "INSERT INTO TEST_EMS2_203.dbo.REPAIRCAUSE_IMAGE (RPRQ_CODE,RPC_SUBJECT,RPCIM_GROUP,RPCIM_IMAGES,RPCIM_PROCESSBY,RPCIM_PROCESSDATE) 
                        VALUES ('$RPRQ_CODE','$result_data->RPM_NATUREREPAIR',null,'$image_path2','$PROCESS_BY','$PROCESS_DATE')";
                        $result_img2 = $conn->query($sql_img2);
                    } else {
                        $RS="error";
                    }
                } else {
                    $RS="complete";
                }
            }
            $sql_saverepair = "UPDATE SHEET_LIST_RECORD SET RPRQ_SAVE_REPAIR = '1' WHERE SHLR_CODE = '$a1' AND SH_ID = '$a2' AND SHL_NUMBER = '$a3' ";	
            $result_saverepair = $conn->query($sql_saverepair);
        }

        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }
        echo json_encode($RS);
        return $RS;
    }
    
    function saveapprovedaily($KEYWORD,$PROC,$a1){
        $part = "../";   	
        include ($part.'config/connect.php');       
        $n=6;
        function RandNum($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        } 
        $rand="SHLA_".RandNum($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="approve"){ 
            $sql = "INSERT INTO SHEET_LIST_APPROVE (SHLA_CODE,SHLR_CODE,SHLA_CREATEBY,SHLA_CREATEDATE)
                    VALUES ('$rand','$a1','$PROCESS_BY','$PROCESS_DATE')";
        }
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }
        echo json_encode($RS);
        return $RS;
    }



