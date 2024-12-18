<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'include/head.php');  
    unset($_SESSION['SIDEBAR']); 
    unset($_SESSION['DROPDOWN']);
    unset($_SESSION['DROPDOWN_ID']); 
    $_SESSION['SIDEBAR']='จัดการข้อมูลรถ.html';
    $_SESSION['DROPDOWN']='null';
?>

<body class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
<div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
    <div class="app-menu w-vertical-menu bg-vertical-menu ltr:border-r rtl:border-l border-vertical-menu-border fixed bottom-0 top-0 z-[1003] transition-all duration-75 ease-linear group-data-[sidebar-size=md]:w-vertical-menu-md group-data-[sidebar-size=sm]:w-vertical-menu-sm group-data-[sidebar-size=sm]:pt-header group-data-[sidebar=dark]:bg-vertical-menu-dark group-data-[sidebar=dark]:border-vertical-menu-dark group-data-[sidebar=brand]:bg-vertical-menu-brand group-data-[sidebar=brand]:border-vertical-menu-brand group-data-[sidebar=modern]:bg-gradient-to-tr group-data-[sidebar=modern]:to-vertical-menu-to-modern group-data-[sidebar=modern]:from-vertical-menu-form-modern group-data-[layout=horizontal]:w-full group-data-[layout=horizontal]:bottom-auto group-data-[layout=horizontal]:top-header hidden md:block print:hidden group-data-[sidebar-size=sm]:absolute group-data-[sidebar=modern]:border-vertical-menu-border-modern group-data-[layout=horizontal]:dark:bg-zink-700 group-data-[layout=horizontal]:border-t group-data-[layout=horizontal]:dark:border-zink-500 group-data-[layout=horizontal]:border-r-0 group-data-[sidebar=dark]:dark:bg-zink-700 group-data-[sidebar=dark]:dark:border-zink-600 group-data-[layout=horizontal]:group-data-[navbar=scroll]:absolute group-data-[layout=horizontal]:group-data-[navbar=bordered]:top-[calc(theme('spacing.header')_+_theme('spacing.4'))] group-data-[layout=horizontal]:group-data-[navbar=bordered]:inset-x-4 group-data-[layout=horizontal]:group-data-[navbar=hidden]:top-0 group-data-[layout=horizontal]:group-data-[navbar=hidden]:h-16 group-data-[layout=horizontal]:group-data-[navbar=bordered]:w-[calc(100%_-_2rem)] group-data-[layout=horizontal]:group-data-[navbar=bordered]:[&.sticky]:top-header group-data-[layout=horizontal]:group-data-[navbar=bordered]:rounded-b-md group-data-[layout=horizontal]:shadow-md group-data-[layout=horizontal]:shadow-slate-500/10 group-data-[layout=horizontal]:dark:shadow-zink-500/10 group-data-[layout=horizontal]:opacity-0">
        <?php require_once($path.'include/sidebar.php'); ?>
    </div>
    <?php require_once($path.'include/navbar.php'); ?>
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <div class="grow">
                        <h5 class="text-16">จัดการข้อมูลรถ</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="shrink-0">   
                                <a href="caradd.html">              
                                    <button aria-label="button" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มข้อมูลรถ</span>
                                    </button>   
                                </a>                                                
                            </div>
                             <br> -->
                            <table id="borderedTable" class="bordered group">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ.</th>
                                        <th width="10%">รหัสบริษัท</th>
                                        <th width="20%">ชื่อไทย</th>
                                        <th width="10%">จำนวนรถ</th>
                                        <th width="10%">ตรวจสอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($_SESSION["AD_AREA"]=="AMT"){
                                            $wh="AND CTM_COMCODE IN('RKR','RKS','RKL')";
                                        }else if($_SESSION["AD_AREA"]=="GW"){
                                            $wh="AND CTM_COMCODE IN('RCC','RRC','RATC')";
                                        }
                                        $sql_customer = "SELECT * FROM CUSTOMER WHERE NOT CTM_STATUS='D' ".$wh."";
                                        $query_customer = $conn->query($sql_customer) or die($conn->error);
                                        $no=0;
                                        while($result_customer = $query_customer->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                            $sql_count = $conn->prepare("EXECUTE ENB_VEHICLEINFO :proc,:regis,:area");
                                            $sql_count->execute(array(':proc'=>'countctmid',':regis'=>'',':area'=>$result_customer->CTM_COMCODE,));
                                            $result_count = $sql_count->fetch(PDO::FETCH_OBJ);
                                            $COUNTCTMID=$result_count->COUNTCTMID;
                                    ?>
                                    <tr>
                                        <td ><?php print "$no.";?></td>
                                        <td align="center"><?php print $result_customer->CTM_COMCODE; ?></td>
                                        <td align="left" ><?php print $result_customer->CTM_NAMETH; ?></td>
                                        <td align="center" ><b><?php print $result_count->COUNTCTMID;?></b></td>
                                        <td align="center">
                                            <div class="flex justify-center gap-2">
                                                <a href="รถของบริษัท-<?php echo $result_customer->CTM_COMCODE; ?>.html" class="flex items-center gap-2">
                                                    <button aria-label="button" class="py-1 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 edit-item-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                                    </button>
                                                    <!-- <img src="assets/images/add-icon16.png" width="16" height="16"> -->
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    <?php require_once($path.'include/footer.php'); ?>
    </div>
</div>
<?php require_once($path.'include/settingtheme.php'); ?>
<?php require_once($path.'include/script.php'); ?>
<script src="assets/js/app.js"></script>
<script src="assets/js/datatables/data-tables.min.js"></script>
<script src="assets/js/datatables/data-tables.tailwindcss.min.js"></script>
<script src="assets/js/datatables/datatables.buttons.min.js"></script>
<script src="assets/js/datatables/jszip.min.js"></script>
<script src="assets/js/datatables/pdfmake.min.js"></script>
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<script src="assets/js/datatables/buttons.print.min.js"></script>
<script src="assets/js/datatables/datatables.init.js"></script>
</body>
</html>