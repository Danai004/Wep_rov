<style>
    .font-bold {
        font-weight: 700;
    }
    .font-semibold {
        font-weight: 600;
    }  
</style>
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

        <div class="container-fluid  <?php echo $bg?> p-4" style="border-radius:1vh">
            <div class="col-lg-7 m-auto">
            <h1 class="text-strongest " data-aos="fade-right" data-aos-duration="500"><i class="fa-duotone fa-code"></i> &nbsp;REDEEM (เติมโค้ด)</h1>
            <div data-aos="fade-right" data-aos-duration="600" >
                <hr class="mt-1 mb-2">
                <h5 class=" m-0"><i class="fa-regular fa-gift"></i>&nbsp;กรอกโค้ดเพื่อรับรางวัลจากเว็บของเรา</h5>
            </div>
            <center class="mt-4 mb-2">
                <div class="col-lg-7" data-aos="fade-down" data-aos="700">
                    <img src="assets/icon/unboxing.png"  class="img-fluid" style="max-height: 250px;">
                </div>
            </center>
            <div data-aos="<?php echo $anim; ?>" data-aos-duration="750">
                <center><small class="text-black ">* แต่ละโค้ดสามารถใช้งานได้หนึ่งครั้งต่อหนึ่งบัญชี</small></center>
                <input type="text" id="link" class="form-control text-center mt-1" style="border-radius: 10px;" placeholder="กรอกโค้ดที่นี่" >
            </div>
            <button class="bg-main-gra btn mt-2  w-100" id="redeem-btn" style="border-radius: 10px;" data-aos="fade-up" data-aos-duration="800">ยืนยันการเติมโค้ด</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#redeem-btn").click(function(){
        var formData = new FormData();
        formData.append('link'  , $("#link").val());
        $.ajax({
            type: 'POST',
            url: 'services/redeem.php',
            data:formData,
            contentType: false,
            processData: false,   
        }).done(function(res){
            result = res;
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: result.message
            }).then(function() {
                    window.location = "?page=<?php echo $_GET['page'];?>";
            });
        }).fail(function(jqXHR){
            console.log(jqXHR);
            res = jqXHR.responseJSON;
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
        });
        // $("#save_btn").attr("data-id") <- id user
    });
</script>