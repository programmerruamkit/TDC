// LOGIN
    function login_session(){ 
        var a0 = $('#username').val();
        var a1 = $('#password').val();
        var a2 = $('#registration').val();
        var a3 = $('#period').val();
        if(a0 == ""){
            var timerInterval;
            Swal.fire({
                icon: 'warning',
                title: 'โปรดกรอกชื่อผู้ใช้',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
            }).then(function (result) {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('USERNAME')
                }        
            })
        } else if(a1 == ""){
            var timerInterval;
            Swal.fire({
                icon: 'warning',
                title: 'โปรดกรอกรหัสผ่าน',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
            }).then(function (result) {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('PASSWORD')
                }        
            })
        } else if(a3 == ""){
            var timerInterval;
            Swal.fire({
                icon: 'warning',
                title: 'โปรดเลือกกะ',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
            }).then(function (result) {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('PASSWORD')
                }        
            })
        } else if(a0 != "" && a1 != "" && a3 != "") {
            $.ajax({
                type: 'post',
                url: 'controllers/controllers.php',
                data: {
                    keyword: "login_session", 
                    a0: a0,
                    a1: a1,
                    a2: a2,
                    a3: a3
                },
                cache: false,
                success: function(RS){
                    if (RS == '"complete"') {                   
                        Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบเรียบร้อย',
                            // html: '<b></b>',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        }).then(() => {
                            location.assign('ยินดีต้อนรับ.html')
                        })	
                    }else{                    
                        Swal.fire({
                            icon: 'error',
                            title: 'ตรวจสอบการเข้าสู่ระบบให้ถูกต้อง!',
                            // html: '<b></b>',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        })
                    }
                },
                error: function(){
                    // Display error message if the request fails
                    console.log('Error: Unable to login.')
                }
            });
        } else {
            alert('โปรดกรอกข้อมูลให้ถูกต้อง');
        }
    }
    function role_session(a0, a1, a2, a3){
        $.ajax({
            type: 'post',
            url: 'controllers/controllers.php',
            data: {
                keyword: "role_session", 
                a0: a0,
                a1: a1,
                a2: a2,
                a3: a3
            },
            cache: false,
             beforeSend: function(){
                console.log(1)
            },
            success: function(RS){
                console.log(2)
                console.log(RS)
                if (RS == '"complete"') {
                    location.href = "ยินดีต้อนรับ.html"
                }
            },
                error: function(){
                console.log(3)
            }
        });
    }
    function role_session_welcome(a0, a1, a2, a3){
        $.ajax({
            type: 'post',
            url: 'controllers/controllers.php',
            data: {
                keyword: "role_session", 
                a0: a0,
                a1: a1,
                a2: a2,
                a3: a3
            },
            cache: false,
             beforeSend: function(){
                console.log(1)
            },
            success: function(RS){
                console.log(2)
                console.log(RS)
                if (RS == '"complete"') {
                    location.href = "ยินดีต้อนรับ.html"
                }
            },
                error: function(){
                console.log(3)
            }
        });
    }
// MENU
    function ManageMenuMain(code){
        var MN_CODE = code;
        var MN_NAME = $('#MN_NAME').val();
        var MN_ICON = $('#MN_ICON').val();
        var MN_URL = $('#MN_URL').val();
        var MN_SORT = $('#MN_SORT').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_LEVEL = $('#MN_LEVEL').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_PARENT = $('#MN_PARENT').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: MN_CODE,
                        MN_NAME: MN_NAME,
                        MN_ICON: MN_ICON,
                        MN_URL: MN_URL,
                        MN_SORT: MN_SORT,
                        MN_STATUS: MN_STATUS,
                        PROC: PROC,
                        MN_LEVEL: MN_LEVEL,
                        MN_PARENT: MN_PARENT
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนู.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_menu_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: ref,
                        MN_NAME: '',
                        MN_ICON: '',
                        MN_URL: '',
                        MN_SORT: '',
                        MN_STATUS: '',
                        PROC: 'delete',
                        MN_LEVEL: '',
                        MN_PARENT: ''
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนู.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function ManageMenuSub(code){
        var MN_CODE = code;
        var MN_NAME = $('#MN_NAME').val();
        var MN_ICON = $('#MN_ICON').val();
        var MN_URL = $('#MN_URL').val();
        var MN_SORT = $('#MN_SORT').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_LEVEL = $('#MN_LEVEL').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_PARENT = $('#MN_PARENT').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: MN_CODE,
                        MN_NAME: MN_NAME,
                        MN_ICON: MN_ICON,
                        MN_URL: MN_URL,
                        MN_SORT: MN_SORT,
                        MN_STATUS: MN_STATUS,
                        PROC: PROC,
                        MN_LEVEL: MN_LEVEL,
                        MN_PARENT: MN_PARENT
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนูย่อย-'+MN_PARENT+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_menu_sub(refcode,no,getmnid){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: ref,
                        MN_NAME: '',
                        MN_ICON: '',
                        MN_URL: '',
                        MN_SORT: '',
                        MN_STATUS: '',
                        PROC: 'delete',
                        MN_LEVEL: '',
                        MN_PARENT: ''
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนูย่อย-'+getmnid+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// ROLE
    function ManageRoleMain(code){
        var RU_CODE = code;
        var RU_NAME = $('#RU_NAME').val();
        var RU_AREA = $("input[type='radio']:checked").val();
        var RU_STATUS = $('#RU_STATUS').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_main_manage", 
                        RU_CODE: RU_CODE,
                        RU_NAME: RU_NAME,
                        RU_AREA: RU_AREA,
                        RU_STATUS: RU_STATUS,
                        PROC: PROC
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.assign('จัดการสิทธิ์.html')
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_role_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_main_manage", 
                        RU_CODE: ref,
                        RU_NAME: '',
                        RU_AREA: '',
                        RU_STATUS: '',
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการสิทธิ์.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
    function ManageRoleSub(code){
        var RM_CODE = code;
        var MN_ID = $('#MN_ID').val();
        var RM_STATUS = $('#RM_STATUS').val();
        var RU_ID = $('#RU_ID').val();
        var RM_ID = $('#RM_ID').val();
        var AREA = $('#AREA').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_sub_manage", 
                        RM_CODE: RM_CODE,
                        MN_ID: MN_ID,
                        RM_STATUS: RM_STATUS,
                        RU_ID: RU_ID,
                        RM_ID: RM_ID,
                        AREA: AREA,
                        PROC: PROC
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'สิทธิ์ใช้งานเมนู-'+RU_ID+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_role_sub(refcode,no,getruid){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_sub_manage", 
                        RM_CODE: ref,
                        MN_ID: '',
                        RM_STATUS: '',
                        RU_ID: '',
                        AREA: '',
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'สิทธิ์ใช้งานเมนู-'+getruid+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// USER
    function ManageUserMain(code){
        var RA_CODE = code;
        var RA_PERSONCODE = $('#RA_PERSONCODE').val();
        var RU_ID = $('#RU_ID').val();
        var RA_PASSWORD = $('#RA_PASSWORD').val();
        var RA_PASSWORD_TEXT = $('#RA_PASSWORD_TEXT').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "user_main_manage", 
                        RA_CODE: RA_CODE,
                        RA_PERSONCODE: RA_PERSONCODE,
                        RU_ID: RU_ID,
                        RA_PASSWORD: RA_PASSWORD,
                        RA_STATUS: 'Y',
                        RA_PASSWORD_TEXT: RA_PASSWORD_TEXT,
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.assign('จัดการสมาชิก.html')
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_role_user(psc,raid,no,proc){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "user_main_manage", 
                        RA_CODE: '',
                        RA_PERSONCODE: psc,
                        RU_ID: raid,
                        RA_PASSWORD: '',
                        RA_STATUS: '',
                        RA_PASSWORD_TEXT: '',
                        PROC: proc,
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการสมาชิก.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// CAR
    function ManageCarMain(regis,val,com,proc){
        $.ajax({
            type: "POST",
            url: "controllers/controllers.php",
            data: {
                keyword: "car_main_manage", 
                a0: regis,
                a1: val,                      
                a2: com,                      
                PROC: proc,
            },
            cache: false,
            success: function(RS){
                if (RS == '"complete"') { 
                    Toastify({
                        text: "บันทึกข้อมูลเสร็จสิ้น",
                        duration: 3000,
                        newWindow: true,
                        close: false,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                        style: {
                          background: "#006400",
                        },
                        onClick: function(){}
                      }).showToast(); 					
                }else{
                    Toastify({
                        text: "ไม่สามารถบันทึกได้!",
                        duration: 3000,
                        newWindow: true,
                        close: false,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                        style: {
                          background: "#FF0000",
                        },
                        onClick: function(){}
                      }).showToast(); 
                }
                
            }
        })
    }
    function getimgqrcode(srcimg) {
        var images = [srcimg];
        var randomIndex = Math.floor(Math.random() * images.length);
        var imgUrl = images[randomIndex];
        document.getElementById("modalImg").src = imgUrl;
    }
    function downloadQRCODE() {
        var regisname = document.getElementById("name").value;
        // alert(regisname)
        html2canvas(document.querySelector('#html2canvas')).then((canvas) => {
        // const name = 'QR';
        const name = regisname;
        let today = new Date();
        let dd = today.getDate();
        let mm = today.getMonth() + 1;
        let yyyy = today.getFullYear();
        if (dd < 10) {
          dd = '0' + dd;
        }
        if (mm < 10) {
          mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;
        let img = canvas.toDataURL('image/png');
        // downloadImageQRCODE(img, `${name}_${today}`);
        downloadImageQRCODE(img, `${name}`);
      });
    }
    function downloadImageQRCODE(blob, fileName) {
      const fakeLink = window.document.createElement('a');
      fakeLink.style = 'display:none;';
      fakeLink.download = fileName;
      fakeLink.href = blob;
      document.body.appendChild(fakeLink);
      fakeLink.click();
      document.body.removeChild(fakeLink);
      fakeLink.remove();
    } 
// SETTING
    function ManageSetting(code,get){
        var a0 = code;
        var a1 = $('#param1').val();
        var a2 = $('#param2').val();
        var a3 = $('#param3').val();
        var a4 = $('#param4').val();
        var a5 = $('#param5').val();
        var a6 = $('#param6').val();
        var a7 = $('#param7').val();
        var a8 = $('#param8').val();
        var a9 = $('#param9').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "setting_manage", 
                        a0: a0,
                        a1: a1,
                        a2: a2,
                        a3: a3,
                        a4: a4,
                        a5: a5,
                        a6: a6,
                        a7: a7,
                        a8: a8,
                        a9: a9,
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ข้อมูลเว็บ.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// LINEOFWORK
    function ManageLineWork(code){
        var a0 = code;
        var a1 = $('#param1').val();
        var a2 = $('#param2').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "linework_manage", 
                        a0: a0,
                        a1: a1,
                        a2: a2,
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการสายงาน.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_linework_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "linework_manage", 
                        a0: ref,
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการสายงาน.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
// CHECKLIST
    function ManageListMain(code){
        var a0 = code;
        var a1 = $('#param1').val();
        var a2 = $('#param2').val();
        var a3 = $('#param3').val();
        var a4 = $('#param4').val();
        var a5 = $('#param5').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "list_main_manage", 
                        a0: a0,
                        a1: a1,
                        a2: a2,
                        a3: a3,
                        a4: a4,
                        a5: a5,
                        PROC: PROC
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ข้อมูลแบบฟอร์ม-'+a5+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_listmain(refcode,no,get){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "list_main_manage", 
                        a0: ref,
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ข้อมูลแบบฟอร์ม-'+get+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
    function ManageSheetList(code,PROC,id,get){
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
        $('.param4').each(function(){param4.push($(this).val());});
        $('.param5').each(function(){param5.push($(this).text());});
        $('.param6').each(function(){param6.push($(this).val());});
        $('.param7').each(function(){param7.push($(this).val());});
        if(param1==1){            
            Swal.fire({
                icon: 'error',
                title: 'ไม่สามารถบันทึกลำดับที่ '+param1+' ได้!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            })
        }else{
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
                icon: 'warning',
                showCancelButton: true,
                // confirmButtonColor: '#C82333',
                confirmButtonText: 'บันทึก',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "controllers/controllers.php",
                        data: {
                            keyword: "sheet_list_manage", 
                            a0: code,
                            a1: param1,
                            a2: param2,
                            a3: param3,
                            a4: param4,
                            a5: param5,
                            a6: param6,
                            a7: param7,
                            a8: id,
                            PROC: PROC
                        },
                        cache: false,
                        success: function(RS){
                            if (RS == '"complete"') {                   
                                Swal.fire({
                                    icon: 'success',
                                    title: 'บันทึกข้อมูลเสร็จสิ้น',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                }).then(() => {
                                    location.href = 'ข้อมูลรายการตรวจสอบ-'+id+'-'+get+'.html'
                                })	
                            }else{                    
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สามารถบันทึกได้!',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                })
                            }
                        },
                            error: function(){
                            console.log(3)
                        }
                    })
                }
            })
        }
    }
    function ManageSheetList4LRCCRATC(code,PROC,id,get){
        var param1 = [];
        var param2 = [];
        var param3 = [];
        $('.param1').each(function(){param1.push($(this).text());});
        $('.param2').each(function(){param2.push($(this).text());});
        $('.param3').each(function(){param3.push($(this).val());});
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "sheet_list_manage", 
                        a0: code,
                        a1: param1,
                        a2: param2,
                        a3: param3,
                        a4: '',
                        a5: '',
                        a6: '',
                        a7: '',
                        a8: id,
                        PROC: PROC
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ข้อมูลรายการตรวจสอบ-'+id+'-'+get+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_sheetlist(a0,a1,a2){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+a1+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = a0; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "sheet_list_manage", 
                        a0: ref,
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ข้อมูลรายการตรวจสอบ-'+a2+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
// CHECKSHEET
    function RedirectQuestion(a0,a1,a2,a4,a5,a6){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะตรวจสอบสภาพ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            confirmButtonText: 'ใช่! ตรวจสอบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) { 
                if (a5==='-') {
                    Swal.fire({
                        title: 'เลือกช่วงเวลา',
                        input: 'select',
                        inputOptions: {
                          'DAY': 'กลางวัน',
                          'NIGHT': 'กลางคืน'
                        },
                        inputPlaceholder: '---โปรดเลือก---',
                        showCancelButton: true,
                        inputValidator: function (value) {
                            return new Promise(function (resolve, reject) {
                                if (value !== '') {
                                    resolve();
                                } else {
                                    resolve('กรุณาเลือกช่วงเวลา!!!');
                                }
                                return value;
                            });
                        },           
                        showCancelButton: true,
                        confirmButtonColor: 'blue',
                        confirmButtonText: 'ยืนยัน',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result2) => {
                        var a3 = result2.value;
                        if (result2.isConfirmed) {
                            if((a4=="4L")||(a4=="RCC")||(a4=="RATC")){
                                location.href = 'ใบตรวจสภาพรถเกตเวย์_'+a0+'_'+a1+'_'+a2+'_'+a3+'_'+a6+'.html'
                            }else{
                                location.href = 'ใบตรวจสภาพรถอมตะ_'+a0+'_'+a1+'_'+a2+'_'+a3+'_'+a6+'.html'
                            }
                        }
                    })
                }else{
                    var a3 = a5;
                    if((a4=="4L")||(a4=="RCC")||(a4=="RATC")){
                        location.href = 'ใบตรวจสภาพรถเกตเวย์_'+a0+'_'+a1+'_'+a2+'_'+a3+'_'+a6+'.html'
                    }else{
                        location.href = 'ใบตรวจสภาพรถอมตะ_'+a0+'_'+a1+'_'+a2+'_'+a3+'_'+a6+'.html'
                    }
                }
            }
        })
    }
    function RedirectQuestionContinue(a0,a1,a2,a3,a4,a5){
        Swal.fire({
            title: 'พร้อมที่จะทำรายการต่อจากเดิมหรือไม่ ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            confirmButtonText: 'ใช่! ตรวจสอบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) { 
                if((a4=="4L")||(a4=="RCC")||(a4=="RATC")){
                    location.href = 'ใบตรวจสภาพรถเกตเวย์_'+a0+'_'+a1+'_'+a2+'_'+a3+'_'+a5+'.html'
                }else{
                    location.href = 'ใบตรวจสภาพรถอมตะ_'+a0+'_'+a1+'_'+a2+'_'+a3+'_'+a5+'.html'
                }
            }
        })
    }
    function CHKNEXT(a0, a1, a2, a3, a4) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'post',
                url: "api/checksheet/api.php",
                data: {
                    num: a0,
                    regis: a1,
                    shid: a2,
                    time: a3,
                    datenow: a4
                },
                success: function(response) {
                    if (response) {
                        resolve(response.RPRQ_SAVE_REPAIR);
                    } else {
                        var selectcheck = $("input[type='radio']:checked").val();
                        if(selectcheck == "vertical"){
                            // reject("No response");
                            Swal.fire({
                                icon: 'warning',
                                title: 'โปรดเลือกคำตอบ',
                                timer: 1500,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                            return false;
                        }else{
                            resolve('0');
                        }
                    }
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
    }
    async function GoQuestion(a0, a1, a2, a3, a4) {
        var checkimage = $('#checkimage').val();        // alert(checkimage)
        var nameimage1 = $('#nameimage1').val();        // alert(nameimage1)
        var nameimage2 = $('#nameimage2').val();        // alert(nameimage2)
        var nameimage3 = $('#nameimage3').val();        // alert(nameimage3)
        var nameimage4 = $('#nameimage4').val();        // alert(nameimage4)
        if (checkimage === '1' && (!nameimage1 || nameimage1.trim() === '') && (!nameimage2 || nameimage2.trim() === '')) {
            Swal.fire({
                icon: 'warning',
                title: 'โปรดอัพโหลดรูปภาพก่อน',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
            return; 
        }
        if (checkimage === '2' && (!nameimage3 || nameimage3.trim() === '') && (!nameimage4 || nameimage4.trim() === '')) {
            Swal.fire({
                icon: 'warning',
                title: 'โปรดอัพโหลดรูปภาพก่อน',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
            return; 
        }
        try {
            const chkResponse = await CHKNEXT(a0, a1, a2, a3, a4);
            $.ajax({
                type: 'get',
                url: "./app/checksheet_manage/checksheetquestionajax.php",
                data: {
                    num: a0,
                    regis: a1,
                    shid: a2,
                    time: a3,
                    datenow: a4
                },
                success: function(response) {
                    if (response) {
                        document.getElementById("data_sr").innerHTML = response;
                        document.getElementById("data_def").innerHTML = "";
                        // console.log(chkResponse);
                        if (chkResponse === '1') {
                            $("#form_upimg3 :input").prop("disabled", true);
                            $("#form_upimg4 :input").prop("disabled", true);
                            disableTabsAndButton();
                        } 
                    }
                }
            });
        } catch (error) {
            console.error("Error in CHKNEXT:", error);
        }
    }
    
    function HideProblems(){
        document.getElementById('divproblems').style.display ='none';
        document.getElementById('param4').value ='';
        $('#checkimage').val('0');
    }
    function ShowProblems(){
        document.getElementById('divproblems').style.display = 'block';
        document.getElementById('divtab1').style.display = 'block';
        document.getElementById('divtab2').style.display = 'none';
        $('#checkimage').val('1');
    }
    function AddImagesQuestion(){
        document.getElementById('divaddimages').style.display = 'block';
    }
    function DeleteImagesQuestion(){
        document.getElementById('divaddimages').style.display = 'none';
    }
    function AddImagesQuestion_Request(){
        document.getElementById('divaddimages_repair').style.display = 'block';
    }
    function DeleteImagesQuestion_Request(){
        document.getElementById('divaddimages_repair').style.display = 'none';
    }
    function SelectCheckSheet(){
        var selectcheck = $("input[type='radio']:checked").val(); // alert(selectcheck)
        if(selectcheck == "vertical"){
            Swal.fire({
                icon: 'warning',
                title: 'โปรดเลือกคำตอบ',
                timer: 1500,
                timerProgressBar: true,
                showConfirmButton: false,
            })
            return false;
        }
    }
    function Save_Question(a0,a1,a2,a3,a4,a5,a6,a7,a8){
        $.ajax({
            type: "POST",
            url: "controllers/controllers.php",
            data: {
                keyword: "check_sheet_question", 
                PROC: a0,
                a1: a1,
                a2: a2,
                a3: a3,
                a4: a4,
                a5: a5,
                a6: a6,
                a7: a7,
                a8: a8,
            },
            cache: false,
            success: function(RS){
            // console.log(RS)                                      
            }
        })
    }
    function Success_Question(a0,a1,a2,a3,a4,a5,a6,a7,a8){
        Swal.fire({
            title: 'คุณยืนยันที่จะบันทึกการตรวจสอบหรือไม่',
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#C82333',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "check_sheet_question", 
                        PROC: a0,
                        a1: a1,
                        a2: a2,
                        a3: a3,
                        a4: a4,
                        a5: a5,
                        a6: a6,
                        a7: a7,
                        a8: a8,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ใบตรวจสภาพ.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function nullrepair(a0,a1,a2,a3,a4,a5,a6,a7,a8){
        $.ajax({
            type: "POST",
            url: "controllers/controllers.php",
            data: {
                keyword: "check_sheet_question", 
                PROC: a0,
                a1: a1,
                a2: a2,
                a3: a3,
                a4: a4,
                a5: a5,
                a6: a6,
                a7: a7,
                a8: a8,
            },
            cache: false,
            success: function(RS){
                // console.log(RS)    
                document.getElementById('param4').value ='';
                document.getElementById('SHLR_REMARK').value ='';
                if(a4!=''){
                    document.getElementById('hideimages1').style.display = 'none';
                }
                if(a5!=''){
                    document.getElementById('hideimages2').style.display = 'none';
                }
            }
        })
    }
    function resetTab2() { // กดปุ่ม 1
        document.getElementById('divtab1').style.display = 'block';
        document.getElementById('divtab2').style.display = 'none';
        document.getElementById('checkimage').value = '1';
        document.getElementById('preview_upimg3').style.display = 'none';
        document.getElementById('preview_upimg4').style.display = 'none';
        document.getElementById('divaddimages_repair').style.display = 'none';
        document.getElementById('datetimeRequest_in').value ='';
        document.getElementById('datetimeRequest_out').value ='';
        document.getElementById('RPRQ_REQUESTBY_SQ').value ='';
        document.getElementById('RPM_NATUREREPAIR').value ='';
        document.getElementById('RPRQ_TYPEREPAIRWORK').value ='';
    }
    function resetTab1() { // กดปุ่ม 2
        document.getElementById('divtab1').style.display = 'none';
        document.getElementById('divtab2').style.display = 'block';
        document.getElementById('checkimage').value = '2';
        document.getElementById('preview_upimg1').style.display = 'none';
        document.getElementById('preview_upimg2').style.display = 'none';
        document.getElementById('divaddimages').style.display = 'none';
        document.getElementById('divaddimages').style.display = 'none';
    }
    function RepairGroups(id_nature, area) {
        if (id_nature === "") {
            $('#RPRQ_TYPEREPAIRWORK').empty().append('<option value="">---เลือกกลุ่มงานซ่อม---</option>');
            return;
        }
        $.ajax({
            type: "POST",
            url: "api/request_repair/api.php", 
            data: {
                proc: 'RPM_NATUREREPAIR',
                trpw_id: id_nature,      
                area: area               
            },
            success: function(data) {
                $('#RPRQ_TYPEREPAIRWORK').empty();
                if (data) {
                    var options = data;
                    if (options.length > 0) {
                        if (id_nature === 'EL') {
                            $('#RPRQ_TYPEREPAIRWORK').append('<option value="">---เลือกกลุ่มงานระบบไฟ---</option>');
                        } else if (id_nature === 'TU') {
                            $('#RPRQ_TYPEREPAIRWORK').append('<option value="">---เลือกกลุ่มงานยาง/ช่วงล่าง---</option>');
                        } else if (id_nature === 'BD') {
                            $('#RPRQ_TYPEREPAIRWORK').append('<option value="">---เลือกกลุ่มงานโครงสร้าง---</option>');
                        } else if (id_nature === 'EG') {
                            $('#RPRQ_TYPEREPAIRWORK').append('<option value="">---เลือกกลุ่มงานเครื่องยนต์---</option>');
                        }
                        options.forEach(function(option) {
                            $('#RPRQ_TYPEREPAIRWORK').append('<option value="'+option.value+'">'+option.text+'</option>');
                        });
                    } else {
                        $('#RPRQ_TYPEREPAIRWORK').append('<option value="">ไม่พบข้อมูล</option>');
                    }
                } else {
                    $('#RPRQ_TYPEREPAIRWORK').append('<option value="">ไม่พบข้อมูล</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("เกิดข้อผิดพลาดในการเชื่อมต่อ API: " + error);
                $('#RPRQ_TYPEREPAIRWORK').empty().append('<option value="">เกิดข้อผิดพลาดในการโหลดข้อมูล</option>');
            }
        });
    }
    function RepairRequest(PROC,a1,a2,a3){
        var checkimage = $('#checkimage').val();        // alert(checkimage)
        var nameimage3 = $('#nameimage3').val();        // alert(nameimage3)
        var nameimage4 = $('#nameimage4').val();        // alert(nameimage4)

        if (checkimage === '2' && (!nameimage3 || nameimage3.trim() === '') && (!nameimage4 || nameimage4.trim() === '')) {
            Swal.fire({
                icon: 'warning',
                title: 'โปรดอัพโหลดรูปภาพก่อน',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
            return; 
        }
        Swal.fire({
            title: 'คุณยืนยันที่จะส่งแจ้งซ่อมหรือไม่?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "check_sheet_question", 
                        PROC: PROC,
                        a1: a1,
                        a2: a2,
                        a3: a3,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ส่งแจ้งซ่อมเรียบร้อย',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                disableTabsAndButton();
                                document.getElementById('stopchecking').style.display = 'block';
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                    error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function Stop_Checking(a0,a1,a2,a3,a4,a5,a6,a7,a8){
        Swal.fire({
            title: 'คุณยืนยันที่จะหยุดการตรวจสอบหรือไม่?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "check_sheet_question", 
                        PROC: a0,
                        a1: a1,
                        a2: a2,
                        a3: a3,
                        a4: a4,
                        a5: a5,
                        a6: a6,
                        a7: a7,
                        a8: a8,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ใบตรวจสภาพ.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function disableTabsAndButton() {
        $("#param1").prop("disabled", true);
        $("#param2").prop("disabled", true);
        $("#param3").prop("disabled", true);
        $("#datetimeRequest_in").prop("disabled", true);
        $("#datetimeRequest_out").prop("disabled", true);
        $("#RPRQ_REQUESTBY_SQ").prop("disabled", true);
        $("#RPM_NATUREREPAIR").prop("disabled", true);
        $("#RPRQ_TYPEREPAIRWORK").prop("disabled", true);
        $("#RPRQ_TYPEREPAIRWORK_NAME").prop("disabled", true);
        $("#SHLR_REMARK").prop("disabled", true);
        $("#image3").prop("disabled", true);
        $("#image4").prop("disabled", true);
        $("#BTNrepairrequest").css({
            "background-color": "#DCDCDC", 
            "color": "white", 
            "cursor": "not-allowed",
            "border-color":"#DCDCDC"
        });
        $("#tab1").css({
            "background-color": "#DCDCDC", 
            "border-color":"#DCDCDC",
            "pointer-events": "none",
            "color": "#ccc",
            "cursor": "not-allowed"
        });
        $("#tab2").css({
            "background-color": "#DCDCDC", 
            "border-color":"#DCDCDC",
            "pointer-events": "none",
            "color": "#ccc",
            "cursor": "not-allowed"
        });
    }
    function activateTab(activeId, inactiveId) {
        document.getElementById(inactiveId).parentElement.classList.remove('bg-custom-500', 'text-white');
        document.getElementById(inactiveId).parentElement.classList.add('bg-white', 'text-custom-500');
        document.getElementById(activeId).parentElement.classList.remove('bg-white', 'text-custom-500');
        document.getElementById(activeId).parentElement.classList.add('bg-custom-500', 'text-white');
    }
// REPORT
    function redirect_daily(a0,a1) {
        window.location.href = 'รายงานตรวจสอบสภาพรายวัน_'+a0+'_ช่วงเวลา_'+a1+'.html';
    }
    function redirect_monthly() {
        var a0 = $('#GETMONTH').val();
        var a1 = $('#REGIS').val();
        // var a2 = $('#PERIODTIME').val();
        var a3 = $('#GETYEAR').val();
        var a4 = $('#LINEOFWORK').val();
        var a5 = $('#SUB_LINEOFWORK').val();
        var a6 = $('#GETWEEK').val();
        if(a4 == ""){
            Swal.fire({
                icon: 'warning',
                title: 'โปรดเลือกสายงานให้เสร็จสิ้น ก่อนเข้าดูรายงาน PDF',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            })
            return result;
        }
        if((a5=="4L")||(a5=="RCC")||(a5=="RATC")){
            var a2 = $('#PERIODTIMEGW').val();
            if(a6 == ""){
                Swal.fire({
                    icon: 'warning',
                    title: 'โปรดเลือกสัปดาห์ ก่อนเข้าดูรายงาน PDF',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                })
                return result;
            }
            window.open('รายงานเกตเวย์สรุปสัปดาห์ที่_'+a6+'_ของรถทะเบียน_'+a1+'_ช่วงเวลา_'+a2+'_ปี_'+a3+'.pdf','_blank').focus();
        }else{
            var a2 = $('#PERIODTIMEAMT').val();
            window.open('รายงานอมตะสรุปรายเดือน_'+a0+'_ของรถทะเบียน_'+a1+'_ช่วงเวลา_'+a2+'_ปี_'+a3+'.pdf','_blank').focus();
        }
    }
    function save_approve_reportdaily(a0,a1){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะยืนยันการตรวจสอบ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "save_approve_daily", 
                        PROC: a0,
                        a1: a1
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                window.close();
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }  