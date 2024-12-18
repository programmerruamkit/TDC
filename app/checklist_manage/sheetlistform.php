<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการสายงาน.html';
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
                        <h5 class="text-16">จัดการข้อมูลรายการตรวจสอบ</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <?php
                        if(isset($_GET['shl'])){
                            $sql_sheetlist_edit = $conn->prepare("SELECT * FROM SHEET_LIST WHERE SHL_ID = :SHL_ID");
                            $sql_sheetlist_edit->execute(array(":SHL_ID" => $_GET['shl']));
                            $rs_sheetlist_edit = $sql_sheetlist_edit->fetch(PDO::FETCH_OBJ);
                        }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="shrink-0">             
                                <a href="ข้อมูลรายการตรวจสอบ-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>.html">
                                    <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                        <i data-lucide="undo-2" class="inline-block size-4"></i> <span class="align-middle">ย้อนกลับ</span>
                                    </button>
                                </a>
                            </div> 
                            <center><font color="red"><b><u>***พิมพ์ข้อความลงในตารางได้เลย***</u></b></font></center>
                            <br>
                            <font color="red"><b><u>***ไม่ต้องสร้างรายการลำดับที่ 1</u></b></font>
                            <!-- <form name="form2" method="post"> -->
                                <table id="crud_table" style="width: 100%">
                                    <thead class="ltr:text-left rtl:text-right">
                                        <tr>
                                            <th style="width: 5%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ลำดับ</th>
                                            <th style="width: 20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">หัวข้อตรวจสอบ</th>
                                            <th style="width: 20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">มาตรฐานการตรวจสอบ</th>
                                            <th style="width: 5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ระดับ</th>
                                            <th style="width: 10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">วิธีการ</th>
                                            <th style="width: 10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">เวลา</th>
                                            <th style="width: 15%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">กลุ่ม</th>
                                            <?php if(!isset($_GET['shl'])){ ?>
                                                <th style="width: 5%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ลบ</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param1' id="focus"><?php if(isset($_GET['shl'])){echo $rs_sheetlist_edit->SHL_NUMBER;}?></td>
                                            <td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param2'><?php if(isset($_GET['shl'])){echo $rs_sheetlist_edit->SHL_NAME;}?></td>
                                            <td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param3'><?php if(isset($_GET['shl'])){echo $rs_sheetlist_edit->SHL_DESCRIPTION;}?></td>
                                            <td class='px-2 py-1 border border-slate-200 dark:border-zink-500 '>
                                                <select class="form-input appearance-none border-slate-300 focus:outline-none focus:border-custom-500 param4" data-choices-search-false=""><!-- data-choices="" -->
                                                    <option value="">-</option>
                                                    <option value="A" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_RANK=='A'){echo "selected";}}?>>A</option>
                                                    <option value="B" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_RANK=='B'){echo "selected";}}?>>B</option>
                                                </select></td>
                                            <td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param5'><?php if(isset($_GET['shl'])){echo $rs_sheetlist_edit->SHL_HOWTO;}?></td>
                                            <td class='px-2 py-1 border border-slate-200 dark:border-zink-500'>
                                                <select class="form-input appearance-none border-slate-300 focus:outline-none focus:border-custom-500 param6" data-choices-search-false=""><!-- data-choices="" -->
                                                    <option value="">-</option>
                                                    <option value="ALLDAY" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_TIME=='ALLDAY'){echo "selected";}}?>>ทุกวัน</option>
                                                    <option value="ALLWEEK" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_TIME=='ALLWEEK'){echo "selected";}}?>>ทุกสัปดาห์</option>
                                                </select>
                                            </td>
                                            <td class='px-2 py-1 border border-slate-200 dark:border-zink-500'>
                                                <select class="form-input appearance-none border-slate-300 focus:outline-none focus:border-custom-500 param7" data-choices-search-false=""><!-- data-choices="" -->
                                                    <option value="">-</option>
                                                    <option value="BEFORESTART" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_PERIODTIME=='BEFORESTART'){echo "selected";}}?>>ก่อนติดเครื่องยนต์</option>
                                                    <option value="AFTERSTART" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_PERIODTIME=='AFTERSTART'){echo "selected";}}?>>หลังติดเครื่องยนต์</option>
                                                    <option value="TRAILLER" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_PERIODTIME=='TRAILLER'){echo "selected";}}?>>เทรลเลอร์</option>
                                                    <option value="BELT" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_PERIODTIME=='BELT'){echo "selected";}}?>>Belt</option>
                                                    <option value="WIRE" <?php if(isset($_GET['shl'])){if($rs_sheetlist_edit->SHL_PERIODTIME=='WIRE'){echo "selected";}}?>>Wire</option>
                                                </select>
                                            </td>
                                            <?php if(!isset($_GET['shl'])){ ?>
                                                <td class='px-2 py-1 border border-slate-200 dark:border-zink-500'>
                                                    <center>
                                                        <button aria-label="button" type="button" class="py-1 text-xs text-white bg-slate-500 border-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-custom-400/20 remove-item-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-minus"></svg>
                                                        </button>
                                                    </center>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <?php if(!isset($_GET['shl'])){ ?>
                                    <div class="flex justify-center gap-2">
                                        <button aria-label="button" name="add" id="add" class="py-1 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 edit-item-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                                        </button>
                                    </div>
                                <?php } ?>
                                <div class="mb-4">
                                    <input type="hidden" id="hdnCount" name="hdnCount">
                                    <button aria-label="button" type="button" onclick="ManageSheetList('<?php if(isset($_GET['shl'])){echo $rs_sheetlist_edit->SHL_CODE;}?>','<?php if(isset($_GET['shl'])){echo 'edit';}else{echo 'add';}?>','<?php echo $_GET['id'];?>','<?php echo $_GET['get'];?>')" class="text-white transition-all duration-200 ease-linear btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20">บันทึกข้อมูล</button>
                                </div>
                            <!-- </form> -->
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
<script src="assets/libs/clipboard/clipboard.min.js"></script>
<script src="assets/js/pages/clipbord.init.js"></script>
<script type="text/javascript">    
    $(document).ready(function () {
        document.getElementById("focus").focus();
        var count = 1;
        $('#add').click(function () {
            count = count + 1;
            var html_code = "<tbody><tr id='row" + count + "'>";
            html_code += "<td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param1'></td>";
            html_code += "<td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param2'></td>";
            html_code += "<td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param3'></td>";
            html_code += "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><select class='form-input appearance-none border-slate-300 focus:outline-none focus:border-custom-500 param4' data-choices-search-false=''><option value=''>-</option><option value='A'>A</option><option value='B'>B</option></select></td>";
            html_code += "<td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param5'></td>";
            html_code += "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><select class='form-input appearance-none border-slate-300 focus:outline-none focus:border-custom-500 param6' data-choices-search-false=''><option value=''>-</option><option value='ALLDAY'>ทุกวัน</option><option value='ALLWEEK'>ทุกสัปดาห์</option></select></td>";
            html_code += "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><select class='form-input appearance-none border-slate-300 focus:outline-none focus:border-custom-500 param7' data-choices-search-false=''><option value=''>-</option><option value='BEFORESTART'>ก่อนติดเครื่องยนต์</option><option value='AFTERSTART'>หลังติดเครื่องยนต์</option><option value='TRAILLER'>เทรลเลอร์</option><option value='BELT'>Belt</option><option value='WIRE'>Wire</option></select></td>";
            html_code += "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><center><button aria-label='button' type='button' name='remove' data-row='row"+count+"' class='py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn remove'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-square-minus'><rect width='18' height='18' x='3' y='3' rx='2'/><path d='M8 12h8'/></svg></button></center></td>";
            html_code += "</tr></tbody>";
            $('#crud_table').append(html_code);
        });

        $(document).on('click', '.remove', function () {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });

        $('#save').click(function () {
            var param1 = [];
            var param2 = [];
            var param3 = [];
            var param4 = [];
            var param5 = [];
            var param6 = [];
            var param7 = [];
            $('.param1').each(function(){param1.push($(this).text());});
            $('.param2').each(function(){param2.push($(this).text());});
            $('.param3').each(function(){param3.push($(this).text());});
            $('.param4').each(function(){param4.push($(this).text());});
            $('.param5').each(function(){param5.push($(this).text());});
            $('.param6').each(function(){param6.push($(this).text());});
            $('.param7').each(function(){param7.push($(this).text());});
            alert(param1)
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: {
                    param1: param1,
                    param2: param2,
                    param3: param3,
                    param4: param4,
                    param5: param5,
                    param6: param6,
                    param7: param7
                },
                success: function (data) {
                    alert(data);
                    $("td[contentEditable='true']").text("");
                    for (var i = 2; i <= count; i++) {
                        $('tr#' + i + '').remove();
                    }
                    fetch_item_data();
                }
            });
        });
    });
</script>
</body>
</html>