<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='รายงานการสรุปรายเดือน.html';
    $_SESSION['DROPDOWN']='9';
    $_SESSION['DROPDOWN_ID']='11';
    
    if(isset($_GET["datenow"])){
        $datenow = $_GET["datenow"];
    }else{
        $datenow = date("Y-m-d");
    }
    $date = date("m");
    $months = array(1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม');
    // $MONTHLY = $months[$date];
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
                        <div class="flex flex-wrap justify-left gap-2">
                            <div class="flex items-center gap-2">
                                <h5 class="text-16">รายงานการสรุปรายเดือน</h5>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <table id="report_monthly" class="table-reportmonthly bordered group">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ.</th>
                                        <th width="10%">รหัสบริษัท</th>
                                        <th width="20%">ชื่อไทย</th>
                                        <th width="10%">จำนวนรถ</th>
                                        <th width="10%">ตรวจสอบ</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" id="area" value="<?php echo $_SESSION["AD_AREA"]; ?>">
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
<script>
    $(document).ready(function() {
        var table = $('#report_monthly').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            autoWidth: false,
            lengthChange: true,
            pageLength: 10,
            columnDefs: [
                { targets: [0], orderable: false },
                { targets: [4], orderable: false },
            ]
        });
        $('.table-reportmonthly tbody').empty();
        $('.table-reportmonthly tbody').append('<tr><td colspan="5" align="center" class="p-6 text-xl"><font size="4">กำลังโหลดข้อมูล...</font></td></tr>');
        function fetch_reportmonthly() {
            var area = $('#area').val();
            $.ajax({
                url: 'api/report/api.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    proc: 'report_monthly',
                    a1: area
                },
                success: function(data) {
                    if (data.length === 0) {
                        table.clear();
                        table.draw();
                    } else {
                        table.clear();
                        data.forEach(function(item, index) {
                            var rowNumber = index + 1;
                            var rowcolor = (rowNumber % 2 === 0) ? 'bg-slate-50' : 'bg-white';
                            table.row.add([
                                '<div class="text-center">'+rowNumber+'</div>',
                                '<div class="text-center">'+item.CTM_COMCODE+'</div>', 
                                '<div class="text-left">'+item.CTM_NAMETH+'</div>', 
                                '<div class="text-center">'+item.COUNTCTMID+'</div>', 
                                '<div class="flex justify-center gap-2">'+
                                    '<a href="รายงานการสรุปรายเดือนของบริษัท-'+item.CTM_COMCODE+'.html" class="flex items-center gap-2">'+
                                        '<button aria-label="button" class="py-1 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 edit-item-btn">'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>'+
                                        '</button>'+
                                    '</a>'+
                                '</div>'
                            ]).draw();
                            var row = table.row(index).node();
                            $(row).addClass(rowcolor);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }
        // setInterval(fetch_reportmonthly, 20000);
        fetch_reportmonthly();
    });
</script>
</body>
</html>