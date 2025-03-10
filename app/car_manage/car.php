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
<style>             
    .specific {
      width: 200px;
      height: 200px;
      margin: auto;
    }	                                      
    .boxqrcode {
      width: 250px;
      height: 180px;
      margin: auto;
    }
    .textcard {    
      align-items: center;
      justify-content: center;
      font-size: 15px;
      text-align: center;
      vertical-align: middle;
    }	
</style>
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
                            <table id="borderedTable" class="bordered group" width="100%">
                                <thead>
                                    <tr>
                                        <th width="3%" class="text-center">ลำดับ.</th>
                                        <th width="10%" class="text-center">ทะเบียนรถ</th>
                                        <th width="10%" class="text-center">ชื่อรถ</th>
                                        <th width="10%" class="text-center">กลุ่มรถ</th>
                                        <!-- <th rowspan="2" width="15%">หมายเหตุ</th> -->
                                        <th width="15%" class="text-center">สายงาน</th>
                                        <th width="15%" class="text-center">ภาษีหมดอายุ</th>		
                                        <th width="5%" class="text-center">QR-Code</th>		
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $PNG_WEB_DIR = '../../assets/car-qr/';
                                        include '../../assets/phpqrcode/qrlib.php';
                                        
                                        $query_vehicleinfo = $conn->prepare("EXECUTE ENB_VEHICLEINFO :proc,:regis,:area,:affc");
                                        $query_vehicleinfo->execute(array(':proc'=>'select_affcompany',':regis'=>'',':area'=>'',':affc'=>$_GET['id'],));
                                        $no=0;
                                        while($rs_car = $query_vehicleinfo->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                            $VEHICLEREGISNUMBER=$rs_car->VEHICLEREGISNUMBER;
                                            $stmt_vhctcmg = $conn->prepare("SELECT * FROM VEHICLECARTYPEMATCHGROUP WHERE VHCTMG_VEHICLEREGISNUMBER = :VEHICLEREGISNUMBER");
                                            $stmt_vhctcmg->execute(array(":VEHICLEREGISNUMBER" => $VEHICLEREGISNUMBER));
                                            $result_vhctcmg = $stmt_vhctcmg->fetch(PDO::FETCH_OBJ);
                                            
                                            $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
                                            if (!file_exists($PNG_WEB_DIR))
                                            mkdir($PNG_WEB_DIR);
                                            $filename = $PNG_WEB_DIR."$rs_car->VEHICLEREGISNUMBER.png";
                                            // ปรับระดับการแก้ไขข้อผิดพลาด (L, M, Q, H)
                                            $errorCorrectionLevel = 'M'; 
                                            // ปรับขนาดของ QR Code (1-10)
                                            $matrixPointSize = 10;     
                                            QRcode::png("$webhost/ทะเบียน_$rs_car->VEHICLEREGISNUMBER.html", $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                            
                                            // แสดงภาษีหมดอายุจาก TMS
                                            if (!empty($rs_car->TAXEXPIREDDATE)) {
                                                $taxExpireDate = $rs_car->TAXEXPIREDDATE;
                                                $datetime = DateTime::createFromFormat('Y-m-d H:i:s.u', substr($taxExpireDate, 0, 23));
                                                $thaiYear = $datetime->format('Y') + 543;
                                                $formattedDate = $datetime->format("d/m") . "/" . $thaiYear;
                                                $today = new DateTime();
                                                $diff = $today->diff($datetime);
                                                $daysRemaining = $diff->days;
                                                $TAXEXPIREDDATE = "$formattedDate (อีก $daysRemaining วัน)";
                                            } else {
                                                $TAXEXPIREDDATE = "<font color='red'><b>ไม่มีข้อมูลวันที่ภาษีหมดอายุ</b></font>";
                                            }
                                    ?>
                                    <tr>
                                        <td ><?php print "$no.";?></td>
                                        <td align="center"><?= $rs_car->VEHICLEREGISNUMBER ?></td>
                                        <td align="left"><?= $rs_car->THAINAME ?></td>
                                        <td align="left"><?= $rs_car->REGISTYPE ?></td>
                                        <!-- <td align="left"><?= $rs_car->REMARK ?></td> -->
                                        <td align="left">
                                            <?php
                                                $SESSION_AREA=$_SESSION["AD_AREA"];
                                                $stmt_selcartype = $conn->query("SELECT LW_ID,LW_LINEOFWORK,LW_AREA
                                                FROM LINEWORK WHERE LW_STATUS = 'Y' AND LW_AREA = '$SESSION_AREA'		
                                                UNION						
                                                SELECT DISTINCT A.LW_ID,LW_LINEOFWORK,LW_AREA
                                                FROM VEHICLECARTYPEMATCHGROUP A LEFT JOIN LINEWORK B ON A.LW_ID = B.LW_ID
                                                WHERE LW_STATUS = 'Y' AND A.VHCTMG_VEHICLEREGISNUMBER = '$rs_car->VEHICLEREGISNUMBER' ORDER BY LW_ID ASC") or die($conn->error);
                                                $num=0;
                                            ?>
                                            <select onchange="ManageCarMain('<?=$rs_car->VEHICLEREGISNUMBER ?>',this.value,'<?=$_GET['id']?>','cargroup')" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                <option value disabled selected>---เลือกสายงาน---</option>
                                                <option value="">---ว่าง---</option>
                                                <option value disabled>สายงาน</option>
                                                <?php while($result_selcartype = $stmt_selcartype->fetch(PDO::FETCH_OBJ)) {  $num++; ?>
                                                    <option value="<?=$result_selcartype->LW_ID?>" <?php if(isset($result_vhctcmg->LW_ID)){if($result_selcartype->LW_ID==$result_vhctcmg->LW_ID){echo "selected";}} ?>><?php print "$num.";?> <?=$result_selcartype->LW_LINEOFWORK?></option>
                                                <?php }; ?>
                                            </select>
                                        </td>
                                        <td align="center" >
                                            <!-- วันที่ภาษีหมดอายุ จากการแมตซ์ใน TDC ยกเลิกใช้ เนื่องจากดึงข้อมูลจาก TMS -->
                                            <!-- <input type="date" autocomplete="off" onchange="ManageCarMain('<?=$rs_car->VEHICLEREGISNUMBER ?>',this.value,'<?=$_GET['id']?>','dateexpire')" value="<?php print $result_vhctcmg->VHCTMG_DATEEXPIRE; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"> -->
                                            <?php echo "$TAXEXPIREDDATE"; ?>
                                        </td>
                                        <td align="center">       
                                            <button aria-label="button" data-modal-target="AddCarModal" 
                                            data-ref="<?=$rs_car->VEHICLEREGISNUMBER.' '.$rs_car->THAINAME;?>" 
                                            data-name="<?=$rs_car->VEHICLEREGISNUMBER.' '.$rs_car->THAINAME;?>" 
                                            onclick="getimgqrcode('assets/car-qr/<?php echo $rs_car->VEHICLEREGISNUMBER;?>.png')"
                                            type="button" class="btn-primary px-2.5 py-2 ltr:pl-[calc(theme('spacing.2')_*_5.5)] rtl:pr-[calc(theme('spacing.2')_*_5.5)] text-xs relative text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                <i class="ri-download-2-line w-[34px] bg-white/10 flex absolute ltr:-left-[1px] rtl:-right-[1px] -bottom-[1px] -top-[1px] items-center justify-center"></i> QR-Code
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- INSERT MODAL -->
                                    <div id="AddCarModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
                                        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto modal-body">
                                                <form name="form1" method="post">
                                                    <center>
                                                        <div class="mb-3">
                                                            <div class="specific" id="html2canvas">
                                                                <font class="textcard"><b><span id='REGIS'></span></b></font>
                                                                <img id="modalImg" src="" alt='QRCODE' class='boxqrcode'>
                                                            </div>
                                                            <button type="button" onclick="downloadQRCODE()" class="relative ltr:pl-[calc(theme('spacing.3')_*_4.2)] rtl:pr-[calc(theme('spacing.3')_*_4.2)] text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                                <i class="ri-download-2-line w-[37.5px] bg-white/10 flex absolute ltr:-left-[1px] rtl:-right-[1px] -bottom-[1px] -top-[1px] items-center justify-center"></i>
                                                                Download QR Code
                                                            </button>
                                                        </div>
                                                    </center>
                                                    <input type="hidden" class="form-control" name="name" id="name" readonly>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script>
    // เปลี่ยนหน้า แต่ติดชื่อเดิม
    // $(document).ready(function(){
    //     $('.btn-primary').click(function(){
    //         $('#REGIS').text($(this).data('ref'));
    //         $('#name').val($(this).data('name'));
    //     });
    // })
    // เปลี่ยนหน้า แต่ติดชื่อเดิม #แก้แล้ว
    $(document).on("click", ".btn-primary", function () {
        var ref = $(this).data('ref');
        var name = $(this).data('name'); 
        $(".modal-body #REGIS").text(ref );
        $(".modal-body #name").val(name );
    });
  </script>
</body>
</html>