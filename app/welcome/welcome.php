<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='null';
    $_SESSION['DROPDOWN']='null';
?>
<link rel="stylesheet" href="assets/css/welcome.css">
<body class="body text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
        <div class="grid grid-cols-12 2xl:grid-cols-2">
            <div class="col-span-12">
                <!-- Open Section  ############################################################## -->
                <div class="ag-format-container">
                    <h1 class="ag-format-container text-white"><?php echo $_SESSION['AD_ROLE_NAME']; ?> - <?php echo $_SESSION['AD_AREA']; ?></h1>
                    <div class="ag-courses_box">
                        <?php if($_SESSION['AD_ROLE_NAME']!='DRIVER'){ ?>
                            <div class="ag-courses_item">
                                <a href="ภาพรวม.html" class="ag-courses-item_link" aria-label="link">
                                    <div class="ag-courses-item_bg"></div>
                                    <div class="ag-courses-item_title">จัดการข้อมูล</div>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="ag-courses_item">
                            <a href="ใบตรวจสภาพ.html" class="ag-courses-item_link" aria-label="link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">ใบตรวจสภาพรถ</div>
                            </a>
                        </div>
                        <div class="ag-courses_item">
                            <a href="ไม่พบข้อมูล.html" class="ag-courses-item_link" aria-label="link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">ข้อมูลรถ</div>
                            </a>
                        </div>
                        <!-- <div class="ag-courses_item">
                            <a href="ไม่พบข้อมูล.html" class="ag-courses-item_link" aria-label="link">
                                <div class="ag-courses-item_bg"></div>
                                <div class="ag-courses-item_title">แจ้งซ่อม</div>
                            </a>
                        </div> -->
                    </div>
                </div>
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    </div>
<?php require_once($path.'include/settingtheme.php'); ?>
<?php require_once($path.'include/script.php'); ?>
<!-- <script src="assets/js/app.js"></script> -->
</body>
</html>