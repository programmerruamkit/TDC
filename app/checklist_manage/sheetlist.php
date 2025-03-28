<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการสายงาน.html';
    $_SESSION['DROPDOWN']='null'; 
    
    $sql_lineofwork = $conn->prepare("EXECUTE ENB_CUSTOMER :proc,:regis,:lwid");
    $sql_lineofwork->execute(array(':proc'=>'select_lineofwork',':regis'=>'',':lwid'=>$_GET['get'],));
    $result_lineofwork = $sql_lineofwork->fetch(PDO::FETCH_OBJ);   
    $SUBLINE = $result_lineofwork->SUB_LINEOFWORK;

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
                    <div class="card">
                        <div class="card-body">
                            <?php 
                            // echo $SUBLINE;
                            ?>
                            <div class="shrink-0">    
                                <?php if($SUBLINE =='4L' || $SUBLINE =='RCC' || $SUBLINE =='RATC'){ ?>
                                    <a href="เพิ่มรายการตรวจสอบ_2-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>.html">
                                        <button aria-label="button" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มรายการตรวจสอบ 4L/RCC/RATC</span>
                                        </button>
                                    </a>&emsp;
                                <?php }else if($SUBLINE =='TTAST' || $SUBLINE =='GMT2' || $SUBLINE =='GMT'){ ?>
                                    <a href="เพิ่มรายการตรวจสอบ_3-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>.html">
                                        <button aria-label="button" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มรายการตรวจสอบ TTAST/GMT2/GMT</span>
                                        </button>
                                    </a>&emsp;
                                <?php }else if($SUBLINE =='SEMI'){ ?>
                                    <a href="เพิ่มรายการตรวจสอบ_4-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>.html">
                                        <button aria-label="button" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มรายการตรวจสอบ SEMI</span>
                                        </button>
                                    </a>&emsp;
                                <?php }else{ ?>
                                    <a href="เพิ่มรายการตรวจสอบ_1-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>.html">
                                        <button aria-label="button" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มรายการตรวจสอบ AMT</span>
                                        </button>
                                    </a>&emsp;
                                <?php } ?>
                                <a href="ข้อมูลแบบฟอร์ม-<?php echo $_GET['get']; ?>.html">
                                    <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                        <i data-lucide="undo-2" class="inline-block size-4"></i> <span class="align-middle">ย้อนกลับ</span>
                                    </button>
                                </a>
                            </div> 
                            <br>
                            <table id="borderedTable" class="bordered group" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ลำดับ</th>
                                        <th width="20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">หัวข้อตรวจสอบ</th>
                                        <?php if($SUBLINE =='4L' || $SUBLINE =='RCC' || $SUBLINE =='RATC'){ ?>
                                            <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">กลุ่ม</th>
                                        <?php }else if($SUBLINE =='TTAST' || $SUBLINE =='GMT2' || $SUBLINE =='GMT'){ ?>
                                            <th width="20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">มาตรฐานการตรวจสอบ</th>
                                            <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ระดับ</th>
                                            <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">กลุ่ม</th>
                                        <?php }else if($SUBLINE =='SEMI'){ ?>
                                            <th width="20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">มาตรฐานการตรวจสอบ</th>
                                            <th width="5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">วิธีการ</th>
                                            <th width="5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">เวลา</th>
                                            <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">กลุ่ม</th>
                                        <?php }else{ ?>
                                            <th width="20%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">มาตรฐานการตรวจสอบ</th>
                                            <th width="5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">ระดับ</th>
                                            <th width="5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">วิธีการ</th>
                                            <th width="5%"  class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">เวลา</th>
                                            <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">กลุ่ม</th>
                                        <?php } ?>
                                        <th width="10%" class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=0;
                                        $query_sheetlist = $conn->prepare("SELECT * FROM SHEET_LIST WHERE SH_ID = :SH_ID ORDER BY SHL_NUMBER ASC") or die($conn->error);
                                        $query_sheetlist->execute(array(":SH_ID" => $_GET['id']));
                                        while($rs_sheetlist = $query_sheetlist->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                            if($rs_sheetlist->SHL_TIME=='ALLDAY'){
                                                $RS_TIME = 'ทุกวัน';
                                            }else if($rs_sheetlist->SHL_TIME=='ALLWEEK'){
                                                $RS_TIME = 'ทุกสัปดาห์';
                                            }else{
                                                $RS_TIME = 'ไม่ได้ระบุเวลา';
                                            }
                                            if($rs_sheetlist->SHL_PERIODTIME=='BEFORESTART'){
                                                $RS_PERIODTIME = 'ก่อนติดเครื่องยนต์';
                                            }else if($rs_sheetlist->SHL_PERIODTIME=='AFTERSTART'){
                                                $RS_PERIODTIME = 'หลังติดเครื่องยนต์';
                                            }else if($rs_sheetlist->SHL_PERIODTIME=='TRAILLER'){
                                                $RS_PERIODTIME = 'เทรลเลอร์';
                                            }else if($rs_sheetlist->SHL_PERIODTIME=='BELT'){
                                                $RS_PERIODTIME = 'Belt';
                                            }else if($rs_sheetlist->SHL_PERIODTIME=='WIRE'){
                                                $RS_PERIODTIME = 'Wire';
                                            }else if($rs_sheetlist->SHL_PERIODTIME=='TRAILLERDEISEL'){
                                                $RS_PERIODTIME = 'เทรลเลอร์ดีเซล';
                                            }else if($rs_sheetlist->SHL_PERIODTIME=='TRAILLERTYPEBELT'){
                                                $RS_PERIODTIME = 'เทรลเลอ์ชนิดที่ใช้สายเบลท์ รัดล้อ';
                                            }else if($rs_sheetlist->SHL_PERIODTIME=='BEFOREWORK'){
                                                $RS_PERIODTIME = 'ก่อนปฏิบัติงาน';
                                            }else{
                                                $RS_PERIODTIME = 'ไม่ได้จัดกลุ่ม';
                                            }
                                    ?>                                        
                                    <tr align="center">
                                        <td width="5%" align="center"><?php echo $rs_sheetlist->SHL_NUMBER ?></td>
                                        <td width="20%" align="left"><?php echo truncateText($rs_sheetlist->SHL_NAME) ?></td>
                                        <?php if($SUBLINE =='4L' || $SUBLINE =='RCC' || $SUBLINE =='RATC'){ ?>
                                            <td width="10%" align="left"><?php echo $RS_PERIODTIME ?></td>
                                        <?php }else if($SUBLINE =='TTAST' || $SUBLINE =='GMT2' || $SUBLINE =='GMT'){ ?>
                                            <td width="20%" align="left"><?php echo truncateText($rs_sheetlist->SHL_DESCRIPTION); ?></td>
                                            <td width="10%" align="center"><?php echo $rs_sheetlist->SHL_RANK ?></td>
                                            <td width="10%" align="left"><?php echo $RS_PERIODTIME ?></td>
                                        <?php }else if($SUBLINE =='SEMI'){ ?>
                                            <td width="20%" align="left"><?php echo truncateText($rs_sheetlist->SHL_DESCRIPTION); ?></td>
                                            <td width="5%" align="left"><?php echo $rs_sheetlist->SHL_HOWTO ?></td>
                                            <td width="5%" align="left"><?php echo $RS_TIME ?></td>
                                            <td width="10%" align="left"><?php echo $RS_PERIODTIME ?></td>
                                        <?php }else{ ?>
                                            <td width="20%" align="left"><?php echo truncateText($rs_sheetlist->SHL_DESCRIPTION); ?></td>
                                            <td width="5%" align="center"><?php echo $rs_sheetlist->SHL_RANK ?></td>
                                            <td width="5%" align="left"><?php echo $rs_sheetlist->SHL_HOWTO ?></td>
                                            <td width="5%" align="left"><?php echo $RS_TIME ?></td>
                                            <td width="10%" align="left"><?php echo $RS_PERIODTIME ?></td>
                                        <?php } ?>
                                        <td width="10%" align="center">
                                            <div class="flex justify-center gap-2">
                                                <div class="edit">
                                                    <?php 
                                                        if($SUBLINE =='4L' || $SUBLINE =='RCC' || $SUBLINE =='RATC'){ 
                                                            $URL='แก้ไขรายการตรวจสอบ_2';
                                                        }else if($SUBLINE =='TTAST' || $SUBLINE =='GMT2'){ 
                                                            $URL='แก้ไขรายการตรวจสอบ_3';
                                                        }else if($SUBLINE =='SEMI'){ 
                                                            $URL='แก้ไขรายการตรวจสอบ_4';
                                                        }else{ 
                                                            $URL='แก้ไขรายการตรวจสอบ_1';
                                                        }
                                                    ?>                                                    
                                                    <a href="<?php echo $URL ?>-<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>-<?php echo $rs_sheetlist->SHL_ID; ?>.html">
                                                        <button aria-label="button" class="py-1 text-xs text-black btn bg-yellow-500 border-yellow-500 hover:text-black hover:bg-yellow-600 hover:border-yellow-600 focus:text-black focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-black active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20 edit-item-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button aria-label="button" type="button" onclick="swaldelete_sheetlist('<?php print $rs_sheetlist->SHL_CODE ?>','<?php print $no;?>','<?php echo $_GET['id']; ?>-<?php echo $_GET['get']; ?>')" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">
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
<script type="text/javascript">
    $(document).ready(function () {
        var rows = 1;
        $("#createRows").click(function () {
            var tr = "<tr>";
                tr = tr + "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><input type='text' name='param1"+rows+"' id='param1"+rows+"' size='5' class='form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200' autocomplete='off'></td>";
                tr = tr + "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><input type='text' name='param2"+rows+"' id='param2"+rows+"' size='5' class='form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200' autocomplete='off'></td>";
                tr = tr + "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><input type='text' name='param3"+rows+"' id='param3"+rows+"' size='5' class='form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200' autocomplete='off'></td>";
                tr = tr + "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><input type='text' name='param4"+rows+"' id='param4"+rows+"' size='5' class='form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200' autocomplete='off'></td>";
                tr = tr + "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><input type='text' name='param5"+rows+"' id='param5"+rows+"' size='5' class='form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200' autocomplete='off'></td>";
                tr = tr + "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><input type='text' name='param6"+rows+"' id='param6"+rows+"' size='5' class='form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200' autocomplete='off'></td>";
                tr = tr + "<td class='px-2 py-1 border border-slate-200 dark:border-zink-500'><input type='text' name='param7"+rows+"' id='param7"+rows+"' size='5' class='form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200' autocomplete='off'></td>";
                tr = tr + "</tr>";
            $('#myTable > tbody:last').append(tr);

            $('#hdnCount').val(rows);
            rows = rows + 1;
        });
        $("#deleteRows").click(function () {
            if ($("#myTable tr").length != 1) {
                $("#myTable tr:last").remove();
            }
        });

        $("#clearRows").click(function () {
            rows = 1;
            $('#hdnCount').val(rows);
            $('#myTable > tbody:last').empty(); // remove all
        });

    });
</script>
</body>
</html>