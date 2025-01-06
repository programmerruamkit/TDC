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
                        <div class="col-span-12 card 2xl:col-span-12">
                            <div class="card-body">
                                <div class="grid grid-cols-1 gap-5 divide-y md:divide-x md:divide-y-0 md:grid-cols-2 2xl:grid-cols-2 rtl:divide-x-reverse divide-slate-200 dark:divide-zink-500">
                                    <div class="flex items-center justify-center py-5 first:pt-0 md:first:pt-5 md:last:pb-5 last:pb-0 md:px-5 md:ltr:first:pl-0 md:rtl:first:pr-0 md:ltr:last:pr-0 md:rtl:last:pl-0">
                                        <div class="flex mb-4">
                                            <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                                                <div class="col-span-12 md:col-span-12 lg:col-span-12 2xl:col-span-12">
                                                    <p class="text-lg text-gray-700 mb-4"><b>สถานะของระบบ</b> <font color="red" size="2">***โหลดข้อมูลใหม่ทุก ๆ 1 นาที</font></p>
                                                </div>
                                                <div class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4">
                                                    <div class="text-center card-body">
                                                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                                                        </div>
                                                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="CARTOTAL">0</span></h5>
                                                        <p class="text-slate-500 dark:text-zink-200">รถบรรทุกทั้งหมด</p>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4">
                                                    <div class="text-center card-body">
                                                        <div class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14 dark:bg-purple-500/20">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-text"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9.5 8h5"/><path d="M9.5 12H16"/><path d="M9.5 16H14"/></svg>
                                                        </div>
                                                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="CARDAILY">0</span></h5>
                                                        <p class="text-slate-500 dark:text-zink-200">แผนใช้รถประจำวัน</p>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4">
                                                    <div class="text-center card-body">
                                                        <div class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14 dark:bg-green-500/20">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-checks"><path d="m3 17 2 2 4-4"/><path d="m3 7 2 2 4-4"/><path d="M13 6h8"/><path d="M13 12h8"/><path d="M13 18h8"/></svg>
                                                        </div>
                                                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="CHECK">0</span></h5>
                                                        <p class="text-slate-500 dark:text-zink-200">พนักงานตรวจสภาพเรียบร้อย</p>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4">
                                                    <div class="text-center card-body">
                                                        <div class="flex items-center justify-center mx-auto text-yellow-500 bg-yellow-100 rounded-full size-14 dark:bg-yellow-500/20">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                                                        </div>
                                                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="WAIT_APPROVE">0</span></h5>
                                                        <p class="text-slate-500 dark:text-zink-200">รอยืนยันจากเจ้าหน้าที่</p>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4">
                                                    <div class="text-center card-body">
                                                        <div class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14 dark:bg-green-500/20">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-check"><path d="M2 21a8 8 0 0 1 13.292-6"/><circle cx="10" cy="8" r="5"/><path d="m16 19 2 2 4-4"/></svg>
                                                        </div>
                                                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="APPROVE_DONE">0</span></h5>
                                                        <p class="text-slate-500 dark:text-zink-200">ยืนยันการตรวจสอบแล้ว</p>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4">
                                                    <div class="text-center card-body">
                                                        <div class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14 dark:bg-red-500/20">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                                                        </div>
                                                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="NOCHECK">0</span></h5>
                                                        <p class="text-slate-500 dark:text-zink-200">ยังไม่ตรวจสภาพ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-5 first:pt-0 md:first:pt-5 md:last:pb-5 last:pb-0 md:px-5 md:ltr:first:pl-0 md:rtl:first:pr-0 md:ltr:last:pr-0 md:rtl:last:pl-0">
                                        <p class="text-lg text-gray-700 mb-4"><b>การตรวจสอบล่าสุด 5 อันดับ</b> <font color="red" size="2">***โหลดข้อมูลใหม่ทุก ๆ 1 นาที</font><br><small>ช่วงเวลาแสดงข้อมูล กะกลางวัน 00:00 - 11:59 / กะกลางคืน 12:00 - 23:59</small></p>
                                        <table id="last_check" class="table-lastcheck bordered group">
                                            <thead>
                                                <tr>
                                                    <th width="10%">ID</th>
                                                    <th width="10%">ทะเบียนรถ</th>
                                                    <th width="10%">ชื่อรถ</th>
                                                    <th width="10%">กะทำงาน</th>
                                                    <th width="10%">สถานะ</th>
                                                    <th width="10%">ยืนยัน</th>
                                                    <th width="10%">เวลา</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <input type="hidden" id="area" value="<?php echo $_SESSION["AD_AREA"]; ?>">
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
        var table = $('#last_check').DataTable({
            paging: false,
            searching: false,
            info: false,
            ordering: false,
            autoWidth: false,
            lengthChange: false,
            pageLength: 10,
            columnDefs: [
                { targets: [0], orderable: false },
                { targets: [5], orderable: false },
            ]
        });
        $('.table-lastcheck tbody').empty();
        $('.table-lastcheck tbody').append('<tr><td colspan="5" align="center" class="p-6 text-xl"><font size="4">กำลังโหลดข้อมูล...</font></td></tr>');
        function fetchDashboard() {
            $.ajax({
                url: 'api/dashboard/api.php',
                type: 'POST',
                dataType: 'json',
                data: { proc: 'dashboard' },
                success: function(data) {
                    // อัปเดตข้อมูลส่วน dailyData
                    const dailyData = data.dailyData;
                    $(".counter-value[data-target='CARTOTAL']").text(dailyData.CARTOTAL);
                    $(".counter-value[data-target='CARDAILY']").text(dailyData.CARDAILY);
                    $(".counter-value[data-target='CHECK']").text(dailyData.CHECK);
                    $(".counter-value[data-target='NOCHECK']").text(dailyData.NOCHECK);
                    $(".counter-value[data-target='WAIT_APPROVE']").text(dailyData.WAIT_APPROVE);
                    $(".counter-value[data-target='APPROVE_DONE']").text(dailyData.APPROVE_DONE);

                    // อัปเดตข้อมูลส่วน reportData
                    const reportData = data.reportData;
                    const reportTable = $(".table-lastcheck tbody"); // สมมติคุณมีตารางสำหรับแสดงข้อมูลนี้
                    reportTable.empty(); // ลบข้อมูลเก่าในตาราง
                    // ตรวจสอบว่ามีข้อมูลหรือไม่
                    if (reportData.length === 0) {
                        reportTable.append(`
                            <tr>
                                <td colspan="7" class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500">
                                    <font size="4">ไม่มีข้อมูล</font>
                                </td>
                            </tr>
                        `);
                    } else {
                        // วนลูปเพิ่มข้อมูลในตาราง
                        reportData.forEach(item => {
                            var rowstatus = (item.SHLC_STATUS === 'success') ? "<img src='assets/images/check_true.gif' alt='pic' width='16' height='16'>" :
                                            (item.SHLC_STATUS === 'wait') ? "<img src='assets/images/imgloading.gif' alt='pic' width='25' height='25'>" :
                                            (item.SHLC_STATUS === 'stopchecking') ? "<font color='red'><b>STOP</b></font>" : "0";
                            var rowapprove = (item.SHLR_CODE_FA === null) ? "<img src='assets/images/imgloading.gif' alt='pic' width='25' height='25'>" : "<img src='assets/images/check_true.gif' alt='pic' width='16' height='16'>";
                            var DaysAgo = (item.DaysAgo === null) ? "" : "";
                            var HoursAgo = (item.HoursAgo === null) ? "" : item.HoursAgo+":";
                            var MinutesAgo = (item.MinutesAgo === null) ? "" : item.MinutesAgo+" น.ที่ผ่านมา";
                            var MinutesAgoDefualt = (item.MinutesAgoDefualt === null) ? "" : item.MinutesAgoDefualt+" นาทีที่ผ่านมา";
                            reportTable.append(`
                                <tr>
                                    <td class="px-2 py-2.5 border-2 border-slate-200 dark:border-zink-500 text-custom-500"><a href="ยืนยันการตรวจสอบรายวันของรถทะเบียน_${item.REGIS}_วันที่_${item.SHLC_DATEINSERT}_ช่วงเวลา_${item.PERIODTIME}_${item.SUB_LINEOFWORK}" target="_blank">${item.SHLC_ID_RANDOM}</a></td>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500">${item.REGIS}</td>
                                    <td class="px-2 py-2.5 border-2 border-slate-200 dark:border-zink-500">${item.THAINAME}</td>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500">${item.PERIODTIME}</td>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500"><center>${rowstatus}</center></td>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500"><center>${rowapprove}</center></td>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500">${MinutesAgoDefualt}</td>
                                </tr>
                            `);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log(xhr.responseText); // แสดงข้อความข้อผิดพลาด
                }
            });
        }
        // เรียกใช้ฟังก์ชันทุก 60 วินาที
        setInterval(fetchDashboard, 60000);
        fetchDashboard();
    });
</script>

</body>
</html>
