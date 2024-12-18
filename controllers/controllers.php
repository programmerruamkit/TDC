<?php include('../models/models.php');
	// echo "<script>";
	// echo "alert($logact);";
	// echo "</script>";
    if ($_POST['keyword'] == "login_session") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$rs = loginsession($KEYWORD,$a0,$a1,$a2,$a3);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "role_session") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$rs = rolesession($KEYWORD,$a0,$a1,$a2,$a3);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "menu_mainsub_manage") {
		$KEYWORD = $_POST['keyword'];
		$MN_CODE = $_POST['MN_CODE'];
		$MN_NAME = $_POST['MN_NAME'];
		$MN_ICON = $_POST['MN_ICON'];
		$MN_URL = $_POST['MN_URL'];
		$MN_SORT = $_POST['MN_SORT'];
		$MN_STATUS = $_POST['MN_STATUS'];
		$PROC = $_POST['PROC'];
		$MN_LEVEL = $_POST['MN_LEVEL'];
		$MN_PARENT = $_POST['MN_PARENT'];
		$rs = menumainsubmanage($KEYWORD,$MN_CODE,$MN_NAME,$MN_ICON,$MN_URL,$MN_SORT,$MN_STATUS,$PROC,$MN_LEVEL,$MN_PARENT);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "role_main_manage") {
		$KEYWORD = $_POST['keyword'];		
		$RU_CODE = $_POST["RU_CODE"];
		$RU_NAME = $_POST["RU_NAME"];
		$RU_AREA = $_POST["RU_AREA"];		
		$RU_STATUS = $_POST["RU_STATUS"];
		$PROC = $_POST['PROC'];
		$rs = rolemainmanage($KEYWORD,$RU_CODE,$RU_NAME,$RU_AREA,$RU_STATUS,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "role_sub_manage") {
		$KEYWORD = $_POST['keyword'];		
		$RM_CODE = $_POST["RM_CODE"];
		$MN_ID = $_POST["MN_ID"];
		$RM_STATUS = $_POST["RM_STATUS"];		
		$RU_ID = $_POST["RU_ID"];
		$RM_ID = $_POST["RM_ID"];
		$AREA = $_POST["AREA"];
		$PROC = $_POST['PROC'];
		$rs = rolesubmanage($KEYWORD,$RM_CODE,$MN_ID,$RM_STATUS,$RU_ID,$RM_ID,$AREA,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "user_main_manage") {
		$KEYWORD = $_POST['keyword'];
		$RA_CODE = $_POST['RA_CODE'];
		$RA_PERSONCODE = $_POST['RA_PERSONCODE'];
		$RU_ID = $_POST['RU_ID'];
		$RA_PASSWORD = $_POST['RA_PASSWORD'];
		$RA_STATUS = $_POST['RA_STATUS'];
		$RA_PASSWORD_TEXT = $_POST['RA_PASSWORD_TEXT'];
		$PROC = $_POST['PROC'];
		$rs = usermainmanage($KEYWORD,$RA_CODE,$RA_PERSONCODE,$RU_ID,$RA_PASSWORD,$RA_STATUS,$RA_PASSWORD_TEXT,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "car_main_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$PROC = $_POST['PROC'];
		$rs = carmainmanage($KEYWORD,$a0,$a1,$a2,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "setting_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$a9 = $_POST['a9'];
		$PROC = $_POST['PROC'];
		$rs = settingmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "linework_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$PROC = $_POST['PROC'];
		$rs = lineworkmanage($KEYWORD,$a0,$a1,$a2,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "list_main_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$PROC = $_POST['PROC'];
		$rs = listmainmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "sheet_list_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$PROC = $_POST['PROC'];
		$rs = sheetlistmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$PROC);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{echo $rs;}
		  break;
		}
	}
    if ($_POST['keyword'] == "check_sheet_question") {
		$KEYWORD = $_POST['keyword'];
		$PROC = $_POST['PROC'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$rs = checksheetquestion($KEYWORD,$PROC,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{
				// echo $rs;
			}
		  break;
		}
	}
    if ($_POST['keyword'] == "save_approve_daily") {
		$KEYWORD = $_POST['keyword'];
		$PROC = $_POST['PROC'];
		$a1 = $_POST['a1'];
		$rs = saveapprovedaily($KEYWORD,$PROC,$a1);
		switch ($rs) {
		  case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
		  break;
		  case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
		  break;
			default :{
				// echo $rs;
			}
		  break;
		}
	}