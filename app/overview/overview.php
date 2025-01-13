<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'include/head.php');  
    unset($_SESSION['SIDEBAR']); 
    unset($_SESSION['DROPDOWN']);
    unset($_SESSION['DROPDOWN_ID']); 
    $_SESSION['SIDEBAR']='ข้อมูลรถ.html';
    $_SESSION['DROPDOWN']='null';
    
    if(isset($_GET['reg'])){
        if($_GET['reg']!=""){
            $RGNB = $_GET['reg'];
        }else{
            $RGNB = "xx-xxxx";
        }
    }else if(isset($_SESSION["AD_REGISTRATION"])){
        if($_SESSION["AD_REGISTRATION"]!=""){
            $RGNB = $_SESSION["AD_REGISTRATION"];
        }else{
            $RGNB = "xx-xxxx";
        }
    }else{
        $RGNB = "xx-xxxx";
    }
    $sql_get_data = $conn->prepare("EXECUTE ENB_VEHICLEINFO :proc,:regis");
    $sql_get_data->execute(array(':proc'=>'select_data',':regis'=>$RGNB,));
    $rs_get_data = $sql_get_data->fetch(PDO::FETCH_OBJ); 
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
                        <h5 class="text-16">ข้อมูลรถบรรทุก</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
                        <div class="xl:col-span-6">
                            <div class="sticky top-[calc(theme('spacing.header')_*_1.3)] mb-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="items-center">
                                            <div class="rounded-md md:col-span-8 md:row-span-2 bg-slate-100 dark:bg-zink-600 flex justify-center items-center">
                                                <?php 
                                                    $imgsrc = "http://61.91.5.110/images/truck/".$RGNB.".webp";
                                                    if(get_headers($imgsrc, 1)[0] == 'HTTP/1.1 200 OK'){
                                                        echo '<img src="'.$imgsrc.'" alt="" class="w-full h-full object-contain">';
                                                    } else {
                                                        echo 'ยังไม่มีรูปภาพ';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mt-0">
                                        <h6 class="mb-3 text-15">รายละเอียด:</h6>
                                        <div class="overflow-x-auto">
                                            <table class="w-full">
                                                <tbody>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">เลขทะเบียนรถ</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->VEHICLEREGISNUMBER)){echo $rs_get_data->VEHICLEREGISNUMBER;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">ชื่อรถ (ไทย)</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->THAINAME)){echo $rs_get_data->THAINAME;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">ประเภททะเบียน</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->REGISTYPE)){echo $rs_get_data->REGISTYPE;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">สายงาน</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->AFFCUSTOMER)){echo $rs_get_data->AFFCUSTOMER;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">ประเภทรถ</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->VEHICLETYPEDESC)){echo $rs_get_data->VEHICLETYPEDESC;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">วันที่จดทะเบียนครั้งแรก (วัน/เดือน/ปี)</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->VEHICLEREGISTERFIRSTDATE)){echo $rs_get_data->VEHICLEREGISTERFIRSTDATE;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">ซีรีส์/รุ่น</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->SERIES)){echo $rs_get_data->SERIES;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">GPS</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->GPS)){echo $rs_get_data->GPS;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">บริษัทประกันภัย</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->INSURANCE)){echo $rs_get_data->INSURANCE;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">วันที่หมดอายุตามป้ายภาษี</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->TAXEXPIREDDATE)){echo $rs_get_data->TAXEXPIREDDATE;}else{echo '';}?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 font-semibold border-b border-transparent w-64 ltr:text-left rtl:text-right text-slate-500 dark:text-zink-200">หมายเหตุ</th>
                                                        <td class="px-3.5 py-2.5 border-b border-transparent"><?php if(isset($rs_get_data->REMARK)){echo $rs_get_data->REMARK;}else{echo '';}?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
</body>
</html>