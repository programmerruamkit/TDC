<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='ร้องขอสิทธิ์.html';
    $_SESSION['DROPDOWN']='null';
    $_SESSION['DROPDOWN_ID']='null';
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
                        <h5 class="text-16">รายการร้องขอสิทธิ์ใช้งาน</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <table id="borderedTable" class="bordered group" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ID</th>
                                        <th>รหัสพนักงาน</th>
                                        <th>ชื่อพนักงาน</th>
                                        <th>เบอร์ติดต่อกลับ</th>
                                        <th>สถานะ</th>
                                        <!-- <th>รายละเอียด</th> -->
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=0;
                                        $query_requestrole = $conn->prepare("EXECUTE ENB_REQUESTROLE :proc");
                                        $query_requestrole->execute(array(':proc'=>'select_all',));
                                        while($rs_requestrole = $query_requestrole->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                    ?>                                        
                                        <tr align="center">
                                            <td align="center"><?php print "$no.";?></td>
                                            <td align="left"><?php echo $rs_requestrole->RQR_RANDOMID ?></td>
                                            <td align="center"><?php echo $rs_requestrole->RQR_PSC ?></td>
                                            <td align="left"><?php echo $rs_requestrole->RQR_NAME ?></td>
                                            <td align="left"><?php echo $rs_requestrole->RQR_CALLBACK ?></td>
                                            <td align="center">
                                                <?php 
                                                    if ($rs_requestrole->RQR_STATUS == "APPROVE") {
                                                        echo "<img src='assets/images/check_true.gif' alt='APPROVE' width='16' height='16'>";
                                                    } elseif ($rs_requestrole->RQR_STATUS == "WAIT") {
                                                        echo "<img src='assets/images/imgloading.gif' alt='WAIT' width='16' height='16'>";
                                                    } elseif ($rs_requestrole->RQR_STATUS == "D") {
                                                        echo "<img src='assets/images/check_del.gif' alt='DELETE' width='16' height='16'>";
                                                    } else {
                                                        echo "<img src='assets/images/warning.png' alt='UNKNOWN' width='16' height='16'>";
                                                    }
                                                ?>
                                            </td>
                                            <!-- <td align="left">< ?php echo $rs_requestrole->RQR_REMARK ?></td> -->
                                            <td align="center">
                                                <div class="flex justify-center gap-2">
                                                    <?php if ($rs_requestrole->RQR_STATUS == "WAIT") { ?>
                                                    <div class="edit">
                                                        <a href="ร้องขอสิทธิ์รหัส-<?php echo $rs_requestrole->RQR_PSC; ?>-<?php echo $rs_requestrole->RQR_ID; ?>.html" class="flex items-center gap-2">
                                                            <button aria-label="button" class="py-1 text-xs text-black btn bg-yellow-500 border-yellow-500 hover:text-black hover:bg-yellow-600 hover:border-yellow-600 focus:text-black focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-black active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20 edit-item-btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>    
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="remove">
                                                        <button aria-label="button" type="button" onclick="swaldelete_requestrole_main('<?php print $rs_requestrole->RQR_RANDOMID ?>','<?php print $no;?>')" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                        </button>
                                                    </div>
                                                    <?php }else{ ?>
                                                        อนุมัติวันที่ 
                                                        <b>
                                                        <?php
                                                            $datetime = $rs_requestrole->RQR_APPROVEDATE;
                                                            $formatted_date = date('d/m/Y', strtotime($datetime));
                                                            echo $formatted_date;
                                                        ?>  
                                                        </b>                                                      
                                                    <?php } ?>
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
<!-- <script src="assets/js/datatables/jszip.min.js"></script> -->
<!-- <script src="assets/js/datatables/pdfmake.min.js"></script> -->
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<!-- <script src="assets/js/datatables/buttons.print.min.js"></script> -->
<script src="assets/js/datatables/datatables.init.js"></script>
</body>
</html>