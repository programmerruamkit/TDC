<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการสายงาน.html';
    $_SESSION['DROPDOWN']='null'; 

    $sql_sheetlist_parent = $conn->prepare("SELECT * FROM SHEET_LIST WHERE SHL_ID = :SHL_ID");
    $sql_sheetlist_parent->execute(array(":SHL_ID" => $_GET['shl']));
    $rs_sheetlist_parent = $sql_sheetlist_parent->fetch(PDO::FETCH_OBJ);

    if(isset($_GET['shlp'])){
        $sql_sheetlist_parent_edit = $conn->prepare("SELECT * FROM SHEET_LIST_PARENT WHERE SHLP_ID = :SHLP_ID");
        $sql_sheetlist_parent_edit->execute(array(":SHLP_ID" => $_GET['shlp']));
        $rs_sheetlist_parent_edit = $sql_sheetlist_parent_edit->fetch(PDO::FETCH_OBJ);
    }
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
                        <h5 class="text-16">จัดการข้อมูลรายการตรวจสอบ-ภายในข้อที่ <?php echo $rs_sheetlist_parent->SHL_NUMBER; ?></h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <div class="shrink-0">             
                                <a href="แก้ไขรายการตรวจสอบ_3-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>-<?php echo $_GET['shl'];?>.html">
                                    <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                        <i data-lucide="undo-2" class="inline-block size-4"></i> <span class="align-middle">ย้อนกลับ</span>
                                    </button>
                                </a>
                            </div> 
                            <center><font color="red"><b><u>***พิมพ์ข้อความลงในตารางได้เลย***</u></b></font></center>
                            <!-- <form name="form2" method="post"> -->
                                <table id="crud_table" style="width: 100%">
                                    <thead class="ltr:text-left rtl:text-right">
                                        <tr>
                                            <th style="width: 5%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ลำดับ</th>
                                            <th style="width: 20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">หัวข้อตรวจสอบ</th>
                                            <th style="width: 20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">มาตรฐานการตรวจสอบ</th>
                                            <th style="width: 5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ระดับ</th>
                                            <th style="width: 5%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param1' id="focus"><?php if(isset($_GET['shlp'])){echo $rs_sheetlist_parent_edit->SHLP_NUMBER;}?></td>
                                            <td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param2'><?php if(isset($_GET['shlp'])){echo $rs_sheetlist_parent_edit->SHLP_NAME;}?></td>
                                            <td contenteditable='true' class='px-2 py-1 border border-slate-200 dark:border-zink-500 param3'><?php if(isset($_GET['shlp'])){echo $rs_sheetlist_parent_edit->SHLP_DESCRIPTION;}?></td>
                                            <td class='px-2 py-1 border border-slate-200 dark:border-zink-500 '>
                                                <select class="form-input appearance-none border-slate-300 focus:outline-none focus:border-custom-500 param4" data-choices-search-false=""><!-- data-choices="" -->
                                                    <option value="">-</option>
                                                    <option value="A" <?php if(isset($_GET['shlp'])){if($rs_sheetlist_parent_edit->SHLP_RANK=='A'){echo "selected";}}?>>A</option>
                                                    <option value="B" <?php if(isset($_GET['shlp'])){if($rs_sheetlist_parent_edit->SHLP_RANK=='B'){echo "selected";}}?>>B</option>
                                                </select>
                                            </td>
                                            <td class='px-2 py-1 border border-slate-200 dark:border-zink-500'>
                                                <center>
                                                    <button aria-label="button" type="button" class="py-1 text-xs text-white bg-slate-500 border-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-custom-400/20 remove-item-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-minus"></svg>
                                                    </button>
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div class="flex justify-center gap-2">
                                    <button aria-label="button" name="add" id="add" class="py-1 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 edit-item-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                                    </button>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" id="hdnCount" name="hdnCount">
                                    <button aria-label="button" type="button" onclick="ManageSheetList3parent('<?php if(isset($_GET['shlp'])){echo $rs_sheetlist_parent_edit->SHLP_CODE;}?>','<?php if(isset($_GET['shlp'])){echo 'editform3parent';}else{echo 'addform3parent';}?>','<?php echo $_GET['id'];?>','<?php echo $_GET['get'];?>','<?php echo $_GET['shl'];?>')" class="text-white transition-all duration-200 ease-linear btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20">บันทึกข้อมูล</button>
                                </div>
                            <!-- </form> -->
                            <br>
                            <hr>
                            <br>
                            <table id="borderedTable" class="bordered group" style="width:100%">
                                <thead>
                                    <tr>                                        
                                        <th width="5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ลำดับ</th>
                                        <th width="20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">หัวข้อตรวจสอบ</th>
                                        <th width="20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">มาตรฐานการตรวจสอบ</th>
                                        <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ระดับ</th>
                                        <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=0;
                                        $query_sheetlist = $conn->prepare("SELECT * FROM SHEET_LIST_PARENT WHERE SHL_PARENT = :SHL_PARENT ORDER BY SHLP_NUMBER ASC") or die($conn->error);
                                        $query_sheetlist->execute(array(":SHL_PARENT" => $_GET['shl']));
                                        while($rs_sheetlist = $query_sheetlist->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                    ?>                                        
                                    <tr align="center">
                                        <td width="5%" align="center"><?php echo $rs_sheetlist->SHLP_NUMBER ?></td>
                                        <td width="20%" align="left"><?php echo $rs_sheetlist->SHLP_NAME ?></td>
                                        <td width="20%" align="left"><?php echo $rs_sheetlist->SHLP_DESCRIPTION ?></td>
                                        <td width="10%" align="left"><?php echo $rs_sheetlist->SHLP_RANK ?></td>
                                        <td width="10%" align="center">
                                            <div class="flex justify-center gap-2">
                                                <div class="edit">
                                                    <a href="แก้ไขรายการตรวจสอบภายใน_3-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>-<?php echo $rs_sheetlist->SHL_PARENT; ?>-<?php echo $rs_sheetlist->SHLP_ID; ?>.html">
                                                        <button aria-label="button" class="py-1 text-xs text-black btn bg-yellow-500 border-yellow-500 hover:text-black hover:bg-yellow-600 hover:border-yellow-600 focus:text-black focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-black active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20 edit-item-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button aria-label="button" type="button" onclick="swaldelete_sheetlist_parent('<?php print $rs_sheetlist->SHLP_CODE ?>','<?php print $no;?>','<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>-<?php echo $_GET['shl'];?>')" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                    </button>
                                                </div>
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
            html_code += "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><center><button aria-label='button' type='button' name='remove' data-row='row"+count+"' class='py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn remove'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-square-minus'><rect width='18' height='18' x='3' y='3' rx='2'/><path d='M8 12h8'/></svg></button></center></td>";
            html_code += "</tr></tbody>";
            $('#crud_table').append(html_code);
        });

        $(document).on('click', '.remove', function () {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });
    });
</script>
</body>
</html>