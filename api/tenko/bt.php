<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>จำลองปุ่มกดจากระบบ TENKO</h1>
    <button aria-label="button" type="button" onclick="window.open('http://61.91.5.111:85/เช็ค_100006_100006_71-8202_GW.html', '_blank')" style="font-size: 24px; padding: 15px 30px; border-radius: 10px; background-color: #007bff; color: white; border: none; cursor: pointer;">
        <i data-lucide="x" class="inline-block size-6"></i> 
        <span class="align-middle">ไม่มีสิทธิ์</span>
    </button>
    <br><br>
    <button aria-label="button" type="button" onclick="window.open('http://61.91.5.111:85/เช็ค_100012_100006_71-8202_GW.html', '_blank')" style="font-size: 24px; padding: 15px 30px; border-radius: 10px; background-color: #007bff; color: white; border: none; cursor: pointer;">
        <i data-lucide="x" class="inline-block size-6"></i> 
        <span class="align-middle">มีสิทธิ์</span>
    </button>

    <!-- <br><br> -->
    <!-- <button id="addDataBtn" style="font-size: 24px; padding: 15px 30px; border-radius: 10px; background-color: #007bff; color: white; border: none; cursor: pointer;">เพิ่มข้อมูล</button> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('addDataBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'เพิ่มข้อมูล',
            showCancelButton: true,
            confirmButtonText: 'เพิ่มข้อมูล',
                preConfirm: () => {
                    return Swal.fire({
                        title: 'กรอกข้อมูล',
                        html: `
                            <input type="text" id="code" class="swal2-input" placeholder="รหัสพนักงาน">
                            <input type="text" id="name" class="swal2-input" placeholder="ชื่อพนักงาน">
                            <input type="text" id="phone" class="swal2-input" placeholder="เบอร์โทรสำหรับติดต่อกลับ">
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'ส่งข้อมูล',
                        preConfirm: () => {
                            const code = Swal.getPopup().querySelector('#code').value;
                            const name = Swal.getPopup().querySelector('#name').value;
                            const phone = Swal.getPopup().querySelector('#phone').value;
                            if (!code || !name || !phone) {
                                Swal.showValidationMessage('กรุณากรอกข้อมูลให้ครบทุกช่อง');
                                return false;
                            }
                            return { code: code, name: name, phone: phone };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const data = result.value;
                            saveDataToDatabase(data).then(() => {
                                Swal.fire('บันทึกสำเร็จ!', 'ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว', 'success');
                            }).catch(() => {
                                Swal.fire('เกิดข้อผิดพลาด!', 'ไม่สามารถบันทึกข้อมูลได้', 'error');
                            });
                        }
                    });
                }
            });
        });
        function saveDataToDatabase(data) {
            // จำลองการบันทึกข้อมูลลงฐานข้อมูล
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    // เปลี่ยนเป็นการส่งคำขอไปยังเซิร์ฟเวอร์จริงเมื่อคุณพร้อม
                    resolve();
                }, 1000);
            });
        }
    </script>
</body>
</html>