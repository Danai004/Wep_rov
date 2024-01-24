<?php
if ($_GET['id'] != '') {
    $pdshop = dd_q("SELECT * FROM service_prod WHERE id = ? LIMIT 1", [$_GET['id']]);
    if ($pdshop->rowCount() != 0) {
        $row_1 = $pdshop->fetch(PDO::FETCH_ASSOC);
        
?>
        <div class="container mt-3 mb-3">
            <div class="container-sm">
                <div class="<?php echo $bg?> shadow p-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb d-flex justify-content-center mt-3">
                            <li class="breadcrumb-item"><a href="?page=service" style="text-decoration: none; color: #6C757D;"> บริการทั้งหมด</a></li>
                            <li class="breadcrumb-item"><a href="?page=service&category=<?= htmlspecialchars($row_1['cate']) ?>" style="text-decoration: none; color: #6C757D;"> <?= htmlspecialchars($row_1['cate']) ?></a></li>
                            <li class="breadcrumb-item" aria-current="page" style="color: var(--font)"><?= htmlspecialchars($row_1['name']) ?></li>

                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-12 col-lg-6 p-3">
                            <div class="d-flex justify-content-center">
                                <img src="<?= htmlspecialchars($row_1['img']) ?>" style="width: 60%;" class="rounded">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-3">
                            <div class="<?php echo $bg?> shadow p-3 rounded">
                                <h3 style="text-decoration: none; color: #000000;">สินค้า : <b><?= htmlspecialchars($row_1['name']) ?><b></h3>
                                <!-- <h4 class="text-main">ราคา : <?= $row_1['price'] ?> บาท / ชิ้น</h4> -->


                                <div class="row mt-2">
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col-auto">รายละเอียดสินค้า</div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <h5 class="" style="word-wrap: break-word; white-space:pre-wrap;"><?= htmlspecialchars($row_1['des']) ?></h5>

                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col-auto">กรอกข้อมูลของคุณ</div>
                                    <div class="col">
                                        <hr>
                                    </div>

                                    <div class="d-grid mt-2">
                                        <div class="mb-2 ">
                                            <p class="m-0  ">Username <span class="text-danger">*</span></p>
                                            <input type="text" id="user" class="form-control" placeholder="Username" aria-describedby="basic-addon1" style="border-radius: 0.5vh;">
                                            <p class="m-0  ">Password <span class="text-danger">*</span></p>
                                            <input type="text" id="pass" class="form-control" placeholder="Password" aria-describedby="basic-addon1" style="border-radius: 0.5vh;">
                                        </div>
                                    </div>

                                    <!-- <div class="mb-2">
                                        <input type="number" id="b_count" class="form-control text-center" value="1">
                                    </div> -->

                                    <div class="d-flex justify-content-between pe-3 ps-3 mt-2">
                                        <span class="m-0 align-self-center">ราคา <?= $row_1['price'] ?> บาท</span>
                                    </div>
                                </div>
                                <button class="btn w-100 mt-2 text-white" id="shop-btn" onclick="buybox()" data-id="<?= $row_1['id'] ?>" data-name="<?= $row_1['name'] ?>" data-price="<?= $row_1['price'] ?>" style="background-color: var(--main);">สั่งซื้อ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $("#shop-btn").click(function(e) {
                    e.preventDefault();
                    var formData = new FormData();
                    formData.append('user', $("#user").val());
                    formData.append('pass', $("#pass").val());
                    formData.append('id', $("#shop-btn").attr("data-id"));

                    Swal.fire({
                        title: 'ยืนยันการสั่งซื้อ?',
                        text: "โปรดตรวจสอบข้อมูลว่าถูกต้อง",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ยืนยัน'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#shop-btn').attr('disabled', 'disabled');
                            $.ajax({
                                type: 'POST',
                                url: 'services/buyservice.php',
                                data: formData,
                                contentType: false,
                                processData: false,
                            }).done(function(res) {

                                result = res;
                                console.log(result);
                                // grecaptcha.reset();
                                if (res.status == "success") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'สำเร็จ',
                                        text: result.message
                                    }).then(function() {
                                        window.location = "?page=home";
                                    });
                                }
                                if (res.status == "fail") {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ผิดพลาด',
                                        text: result.message
                                    });
                                    $('#shop-btn').removeAttr('disabled');
                                }
                            }).fail(function(jqXHR) {
                                console.log(jqXHR);
                                //   res = jqXHR.responseJSON;
                                // grecaptcha.reset();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: res.message
                                })
                                //console.clear();
                                $('#shop-btn').removeAttr('disabled');
                            });
                        }
                    })

                    // captcha = grecaptcha.getResponse();
                    // formData.append('captcha', captcha);
                    
                });
                function buyservice() {
                    var name = $("#shop-btn").attr("data-name");
                    var price = $("#shop-btn").attr("data-price");
                    var count = $("#b_count").val();
                    var formData = new FormData();
                    formData.append('id', $("#shop-btn").attr("data-id"));
                    formData.append('count', count);
                    
                }
            </script>
        </div>
<?php
    } else {
        echo "<script>window.location.href = '?page=shop';</script>";
    }
} else {
    echo "<script>window.location.href = '?page=shop';</script>";
}
?>