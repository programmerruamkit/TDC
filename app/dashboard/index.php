<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='ภาพรวม.html';
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
                        <h5 class="text-16">ภาพรวม ประจำวันที่ <?php echo thai_date_dmy(time())?></h5>
                    </div>
                </div>
                <?php 
                // print_r($_SESSION); 
                ?>
                <!-- Open Section  ############################################################## -->
                    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                            <div class="text-center card-body">
                                <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                                    <i data-lucide="wallet-2"></i>
                                </div>
                                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="CARTOTAL">0</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">รถทั้งหมด</p>
                            </div>
                        </div>
                        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                            <div class="text-center card-body">
                                <div class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14 dark:bg-purple-500/20">
                                    <i data-lucide="package"></i>
                                </div>
                                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="CARDAILY">0</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">แผนใช้รถประจำวัน</p>
                            </div>
                        </div>
                        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                            <div class="text-center card-body">
                                <div class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14 dark:bg-green-500/20">
                                    <i data-lucide="truck"></i>
                                </div>
                                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="CHECK">0</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">ตรวจสภาพรถเรียบร้อย</p>
                            </div>
                        </div>
                        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                            <div class="text-center card-body">
                                <div class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14 dark:bg-red-500/20">
                                    <i data-lucide="package-x"></i>
                                </div>
                                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="NOCHECK">0</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">ยังไม่ตรวจสภาพ</p>
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
<script>    
    function fetch_dashboard() {
        $.ajax({
            url: 'api/dashboard/api.php',
            type: 'POST',
            dataType: 'json',
            data:{proc:'dashboard'},
            success: function(data) {
                $(".counter-value[data-target='CARTOTAL']").text(data.CARTOTAL);
                $(".counter-value[data-target='CARDAILY']").text(data.CARDAILY);
                $(".counter-value[data-target='CHECK']").text(data.CHECK);
                $(".counter-value[data-target='NOCHECK']").text(data.NOCHECK);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }
    setInterval(fetch_dashboard, 5000);
    fetch_dashboard();
</script>

</body>
</html>
