<style>
    .font-bold {
        font-weight: 700;
    }
    .font-semibold {
        font-weight: 600;
    }  
</style>
<?php $bank = dd_q("SELECT * FROM bank WHERE 1")->fetch(PDO::FETCH_ASSOC); ?>
<div class="container-fluid p-4">
    <div class="container-sm  ps-4 pe-4">

        <div class="">
            <div class="row justify-content-center">
                
                <div class="col-12 col-lg-3 pe-3 mb-2">
                    <a href="?page=angpao" style="text-decoration: none;">
                    <div class="container-sm <?php echo $bg?> shadow p-3 mb-2" style="border-radius:1vh">
                        <div class="d-flex justify-content-between">
                            <img src="https://www.truemoney.com/wp-content/uploads/2022/01/truemoneywallet-sendgift-hongbao-20220125-icon-1.png" style="max-height: 70px;" alt="">
                            <div class="ms-1">
                                <h4 class="font-semibold text-dark mb-0">ซองอั่งเปาวอเลท</h4>
                                <p class="text-muted mb-0">กรอกลิงค์เลย</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-12 col-lg-3 pe-3 mb-2">
                    <a href="?page=slip" style="text-decoration: none;">
                    <div class="container-sm <?php echo $bg?> shadow p-3 mb-2" style="border-radius:1vh">
                        <div class="d-flex justify-content-between">
                            <img src="https://cdn.discordapp.com/attachments/1097917702875660358/1102660427453825074/slipscanpay.png" style="max-height: 70px;" alt="">
                            <div class="ms-1">
                                <h4 class="font-semibold text-dark mb-0">โอนด้วยธนาคาร</h4>
                                <p class="text-muted mb-0">เช็คสลิปเลย</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-12 col-lg-3 pe-3 mb-2">
                    <a href="?page=redeem" style="text-decoration: none;">
                    <div class="container-sm <?php echo $bg?> shadow p-3 mb-2" style="border-radius:1vh">
                        <div class="d-flex justify-content-between">
                            <img src="assets/icon/unboxing.png" style="max-height: 70px;" alt="">
                            <div class="ms-1">
                                <h4 class="font-semibold text-dark mb-0">โค้ดรางวัลพิเศษ</h4>
                                <p class="text-muted mb-0">กรอกโค้ดเลย</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                

            </div>
        </div>

        <div class="container-fluid <?php echo $bg?>   p-4">
            <div class="col-lg-7 m-auto">
                <h1 class="text-strongest " data-aos="fade-right" data-aos-duration="500"><i class="fa-duotone fa-coins"></i> &nbsp;Slip Verification (เช็คสลิป)</h1>
                <div data-aos="fade-right" data-aos-duration="600">
                    <hr class="mt-1 mb-2">
                    <h5 class="m-0"><i class="fa-regular fa-plus-circle"></i>&nbsp;ระบบเติมเงินด้วยระบบเช็คสลิป</h5>
                </div>
                <center>
                    <div class="col-lg-4" data-aos="fade-down" data-aos="700">
                        <img src="https://cdn.discordapp.com/attachments/1097917702875660358/1102660427453825074/slipscanpay.png" class="img-fluid">
                    </div>
                </center>
                <div data-aos="fade-left" data-aos-duration="750">
                    <center>
                        <div class="col-12 col-lg-8 text-start">
                            <h5 class="text-storg text-center">ชื่อบัญชี : <?= $bank["fname"] . " " . $bank["lname"] ?></h5>
                            <!--<h5 class="text-storg">เลขบัญชี : <?= $bank["bnum"] ?></h5>-->
                            <h5 class="text-storg text-center">ธนาคาร : <?= $bank["tname"] ?></h5>
                            <div class="input-group">
                                <input type="text" class="form-control text-center" value="<?= $bank["bnum"] ?>">
                                <button class="btn bg-main text-white" type="button" onclick="copyToClipboard('#bankno')">คัดลอกเลขที่บัญชี</button>
                                <p id="bankno" type="number" class="d-none text-center"><?= $bank["bnum"] ?></p>
                            </div>
                            <label for="upload" class="form-label">แนบรูปภาพสลิป</label>
                            <input type="file" class="form-control" id="upload" aria-label="Upload">
                            <img id="imageScanner" style="display: none;" src="#" alt="qr-code-scanner-online">
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.1.0/dist/jsQR.js"></script>
<script>
    $("#bnum").click(() => {
        var copyText = document.getElementById('bnumval').value;
        navigator.clipboard.writeText(copyText)
    });
    
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        Swal.fire({
            title: 'คัดลอกสำเร็จ',
            icon: 'success',
            timer: 1500,
            timerProgressBar: true
        })
    }
    
    function File2Base64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = (error) => reject(error);
        });
    }
    async function imageDataFromSource(source) {
        const image = Object.assign(new Image(), {
            src: source
        });
        await new Promise((resolve) => image.addEventListener('load', () => resolve()));
        const context = Object.assign(document.createElement('canvas'), {
            width: image.width,
            height: image.height,
        }).getContext('2d');
        context.imageSmoothingEnabled = false;
        context.drawImage(image, 0, 0);
        return context.getImageData(0, 0, image.width, image.height);
    }

    $(function() {
        $('#upload').change(function() {
            Swal.fire({
                icon: 'warning',
                title: 'โปรดรอสักครู่',
                text: "ระบบกำลังดำเนินการ โปรดห้ามรีเฟรช",
                showConfirmButton: false,
            });
            const input = this;
            const url = $(this).val();
            const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext === "png" || ext === "jpeg" || ext === "jpg")) {
                const reader = new FileReader();
                reader.onload = async function(e) {
                    const URLBase64 = await File2Base64(input.files[0]);
                    const ImageData = await imageDataFromSource(URLBase64);
                    const code = jsQR(ImageData.data, ImageData.width, ImageData.height);
                    if (code && code.data) {
                        var qrcode = code.data;
                        console.log(qrcode);
                        var formData = new FormData();
                        formData.append('qrcode', qrcode);
                        $.ajax({
                            type: 'POST',
                            url: 'services/slip.php',
                            data: formData,
                            contentType: false,
                            processData: false,
                        }).done(function(res) {
                            result = res;
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: result.message
                            }).then(function() {
                                window.location = "?page=slip";
                            });
                        }).fail(function(jqXHR) {
                            console.log(jqXHR.responseText)
                            res = jqXHR.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error โปรดแจ้งเจ้าของร้าน',
                                text: res.message
                            }).then(function() {
                                window.location = "?page=slip";
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'สลิปไม่มี Qr Code',
                        }).then(function() {
                            window.location = "?page=slip";
                        });
                    }
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'อนุญาตเฉพาะนามสกุล PNG , JPEG และ JPG เท่านั้น โปรดเลือกใหม่',
                });
            }
        });
    });
</script>