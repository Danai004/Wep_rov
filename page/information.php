<div class="container-sm p-4" data-aos="<?php echo $anim; ?>">
<center>
            <div class="col-12 col-lg-12 <?php echo $bg?> p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                    <h3 class=" m-0"><img src="<?php echo $ic_user?>" class="m-0 mb-2" style="height: 2.5rem;">&nbsp; ข้อมูลส่วนตัว</h3>
                    </div>
                    <button class="btn nav-link align-self-center <?php echo $bg?> underline-active" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                </div>
            </div>
        </center>
            <div class="container-fluid mt-2 mb-5 p-4">
                <div class="container-sm p-0">
                    <div class="row justify-content-center">
                        
                        <div class="col-lg-3">
                            <div class="container-fluid <?php echo $bg?> p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <center>
                                    <img src="<?php echo $ic_coin?>" class="img-fluid mb-3" style="height: 100px;">
                                    <h2 class=" ms-1 mb-0">POINT : <span class="ms-1"><?php echo number_format($user["point"]); ?></span></h2>
                                    <small class="ms-1">ยอดการเติมทั้งหมด : <span class="ms-1"><?php echo number_format($user["total"]); ?></span></small>
                                </center>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="container-fluid <?php echo $bg?> p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=profile&subpage=cpass" style="text-decoration: none;">
                                    <center>
                                        <img src="<?php echo $ic_edit?>" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">เปลี่ยนรหัสผ่าน</h2>
                                        <small class="ms-1">สามารถเปลี่ยนรหัสผ่านได้ที่นี่</small>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="container-fluid <?php echo $bg?> p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=my_order" style="text-decoration: none;">
                                    <center>
                                        <img src="<?php echo $ic_his?>" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">Order ของคุณ</h2>
                                        <small class="ms-1">ดูสถานะ Order ของคุณได้ที่นี่</small>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="container-fluid <?php echo $bg?> p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=history" style="text-decoration: none;">
                                    <center>
                                        <img src="<?php echo $ic_his?>" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">ประวัติทั้งหมด</h2>
                                        <small class="ms-1">ดูได้ที่นี่</small>
                                    </center>
                                </a>
                            </div>
                        </div>


                        <div class="col-lg-3 mt-3">
                            <div class="container-fluid <?php echo $bg?> p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=logout" style="text-decoration: none;">
                                    <center>
                                        <img src="<?php echo $ic_logout?>" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">ออกจากระบบ</h2>
                                        <small class="ms-1">Good Bye</small>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <?php if ($byshop_status == "on") {?>
                        <div class="col-lg-3 mt-3">
                            <div class="container-fluid <?php echo $bg?> p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=my_premiumapp" style="text-decoration: none;">
                                    <center>
                                        <img src="<?php echo $ic_service; ?>" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">แอพ Premium</h2>
                                        <small class="ms-1">ประวัติซื้อแอพพรีเมี่ยม</small>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                                    if ($user["rank"] == "1") {
                                    ?>
                                                <div class="col-lg-3 mt-3">
                            <div class="container-fluid <?php echo $bg?> p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=backend" style="text-decoration: none;">
                                    <center>
                                        <img src="<?php echo $ic_backend?>" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">จัดการหลังร้าน</h2>
                                        <small class="ms-1">สามารถเข้าไปจัดการหลังบ้านได้ที่นี่</small>
                                </a>
                            </div>
                        </div>
                        <?php
                                    }
                                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>