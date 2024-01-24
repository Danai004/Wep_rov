<style>
    .shops {
        padding: 20px;
        border-radius: 1vh;
    }

    .shops-body {
        position: relative;
        color: #fff;
        font-weight: 600;
        height: 100%;
    }

    .shops-body>.shops-img {
        width: 100%;
        height: 100%;
        border-radius: 1vh;
        transition: all .5s ease;
    }

    .shops-body>.shops-img:hover {
        transform: scale(1.035);
    }

    .shops-body>.shops-text-center {
        position: absolute;
        top: 80%;
        left: 20%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all .5s ease;
    }

    .shops-body:hover>.shops-text-center {
        left: 50%;
        opacity: 1;
        font-size: 20px;
        padding: 0 20px;
        border-radius: 2vh;
        background-color: ;
    }
</style>
<style>
   .img-anim {
        position: relative;
        text-align: center;
        overflow: hidden;
        border-radius: 1vh;
    }

    .img-anim img {
        width: 100%;
        height: auto;
        margin-left: auto;
    }

    .img-anim>img {
        background-size: cover;
        background-position: center;
        transition: all 0.3s ease;
    }

    .img-anim>div.bg {
        position: absolute;
        z-index: 2;
        opacity: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(1, 1, 1, 0.3);
        transition: all 0.3s ease;
    }

    .img-anim>div.text {
        position: absolute;
        z-index: 3;
        top: 120%;
        left: 50%;
        opacity: 0;
        color: #fff;
        font-size: 20px;
        border-bottom: 3px solid transparent;
        border-image: linear-gradient(to right, var(--main), var(--main));
        border-image-slice: 1;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
    }

    .img-anim:hover>img {
        transform: scale(1.1);
    }

    .img-anim:hover>div {
        opacity: 1;
    }

    .img-anim:hover>div.text {
        top: 80%;
        opacity: 1;
    }

    .content {
        height: auto;
        border: 3px solid rgba(0, 0, 0, .3);
        transition: all .5s ease;
    }

    .content:hover {
        border: 3.5px solid var(--main);
    }
    .font-bold {
        font-weight: 700;
    }
    .font-semibold {
        font-weight: 600;
    }  
    .border-hov {
        border: 1px solid #ccc;
        transition: 0.3s ease-in-out;
    }
</style>

<div class="container-fluid  mt-4 p-0 " data-aos="<?php echo $anim; ?>" data-aos-duration="600">
        <div class="container p-4 pt-0 pb-0 m-cent">
            <div id="carouselExampleControls" class="carousel slide border-spe" data-bs-ride="carousel" style="border-radius: 1vh;">
                <div class="carousel-inner" style="border-radius: 1vh;">
                    <?php
                    $active = false;
                    $find = dd_q("SELECT * FROM carousel");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="carousel-item <?php if (!$active) {
                                                        echo "active";
                                                        $active = true;
                                                    } ?>">
                            <img src="<?php echo $row['link'] ?>" class="d-block w-100" alt="..." style="border-radius: 1vh;">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
<div class="container mt-0 p-0 " data-aos="<?php echo $anim; ?>" data-aos-duration="800">

    <div class="container m-cent p-4 pt-2 pb-0 " style="border-radius: 1vh;" data-aos="<?php echo $anim; ?>" data-aos-duration="800">

        <?php
        $boxlog = dd_q("SELECT * FROM users");
        $m_count = $boxlog->rowCount() + $static['m_count'];

        $boxlog = dd_q("SELECT * FROM category");
        $c_count = $boxlog->rowCount() + $static['c_count'];

        $boxlog = dd_q("SELECT * FROM box_stock");
        $s_count = $boxlog->rowCount() + $static['s_count'];

        $boxlog = dd_q("SELECT * FROM boxlog");
        $b_count = $boxlog->rowCount() + $static['b_count'];
        
        ?>

        <div class="mb-0 mt-2 w-100">
            <div class="row">

                <div class="col-12 col-lg-3 pe-3 mb-2">
                    <div class="container-sm <?php echo $bg?> shadow p-3 mb-2" style="border-radius:1vh">
                        <div class="d-flex justify-content-between">
                            <h1 class="m-0 text-main" style="font-size: 70px;"><i class="fa-regular fa-user"></i><br></h1>
                            <div class="me-2 text-end">
                                <h3 class="font-bold mb-1">สมาชิกทั้งหมด</h3>
                                <h3 class="font-bold  text-main mb-1"><?php echo $m_count; ?> คน</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 pe-3 mb-2">
                    <div class="container-sm <?php echo $bg?> shadow p-3 mb-2" style="border-radius:1vh">
                        <div class="d-flex justify-content-between">
                            <h1 class="m-0 text-main" style="font-size: 70px;"><i class="fa-regular fa-list"></i><br></h1>
                            <div class="me-2 text-end">
                                <h3 class="font-bold mb-1">หมวดหมู่</h3>
                                <h3 class="font-bold  text-main mb-1"><?php echo $c_count; ?> หมวด</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 pe-3 mb-2">
                    <div class="container-sm <?php echo $bg?> shadow p-3 mb-2" style="border-radius:1vh">
                        <div class="d-flex justify-content-between">
                            <h1 class="m-0 text-main" style="font-size: 70px;"><i class="fa-regular fa-box-taped"></i><br></h1>
                            <div class="me-2 text-end">
                                <h3 class="font-bold mb-1">พร้อมจำหน่าย</h3>
                                <h3 class="font-bold  text-main mb-1"><?php echo $s_count; ?> ชิ้น</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 pe-3 mb-2">
                    <div class="container-sm <?php echo $bg?> shadow p-3 mb-2" style="border-radius:1vh">
                        <div class="d-flex justify-content-between">
                            <h1 class="m-0 text-main" style="font-size: 70px;"><i class="fa-regular fa-box-open"></i><br></h1>
                            <div class="me-2 text-end">
                                <h3 class="font-bold mb-1">จำหน่ายไปแล้ว</h3>
                                <h3 class="font-bold  text-main mb-1"><?php echo $b_count; ?> ครั้ง</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-sm ps-4 pe-4 mb-3">
        <div class="w-100 <?php echo $bg?> shadow ps-0 pe-1 pe-lg-4 align-contant-center" style="border-radius: 1vh;">
            <div class="row p-2">
                <div class="col-6 col-lg-2 text-main">
                    <div class="p-2" style="border-radius: 1vh;background-color: var(--main);font-size: 20px;">
                        <p class="text-center text-white m-0 font-semibold"><i class="fa-regular fa-bullhorn font-semibold" style="color: #ffffff;"></i>&nbsp;ประกาศ</p>
                    </div>
                </div>
                <div class="col-6 col-lg-10 p-0 font-semibold text-main" style="margin-top: 2.5px;">
                    <marquee class="mt-2"><?= $config['ann'] ?></marquee>
                </div>
            </div>
        </div>
    </div>
    

    <!-- หมวดหมู่แนะนำ -->
    <div class="container-sm p-4 btn" data-aos="<?php echo $anim; ?>" data-aos-duration="600">

        <center>
            <div class="col-12 col-lg-12  p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                        <h2 class=" mt-2 mb-0 font-bold"><b>บริการแนะนำ</b></h2>
                        <h5 class=" mb-0" style="color: var(--font)">Services Recommended</h5>
                    </div>
                    <a class="btn nav-link align-self-center bg-main mt-4 font-semibold" href="?page=service" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">เลือกดูทั้งหมด</b></a>
                </div>
            </div>
        </center>

        <div class="row justify-content-center justify-content-lg-start">

            <?php
                $find = dd_q("SELECT * FROM service_cate ORDER BY RAND() LIMIT 4");
                while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="col-12 col-lg-6 mb-3">
                <a href="?page=service&category=<?= htmlspecialchars($row['name']) ?>">
                    <div class="img-anim content w-100">
                        <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                        <div class="text font-bold">
                            <?= htmlspecialchars($row['des']) ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php }?>

        </div>

        <center>
            <div class="col-12 col-lg-12  p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                        <h2 class=" mt-2 mb-0 font-bold"><b>หมวดหมู่แนะนำ</b></h2>
                        <h5 class=" mb-0" style="color: var(--font)">Category Recommended</h5>
                    </div>
                    <a class="btn nav-link align-self-center bg-main mt-4 font-semibold" href="?page=shop" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">เลือกดูทั้งหมด</b></a>
                </div>
            </div>
        </center>
            
            <style>
                .cc {
                    width: 100%;
                    max-width: 250px;
                }

                @media only screen and (max-width: 1000px) {
                    .cc {
                        width: 100%;
                        max-width: 100vh;
                    }
                }
            </style>
            
            <div class="row justify-content-center justify-content-lg-start">
                        
                <?php
                // $check = dd_q("SELECT * FROM crecom WHERE recom_1 != 0 AND recom_2 != 0 AND recom_3 != 0 AND recom_4 != 0"); #44444
                $check = dd_q("SELECT * FROM crecom WHERE recom_1 != 0 AND recom_2 != 0");
                if ($check->rowCount() == 1) {
                    $data = $check->fetch(PDO::FETCH_ASSOC);
                    for ($i = 1; $i <= 2; $i++) {
                        $recom = "recom_" . $i;
                        $find = dd_q("SELECT * FROM category WHERE c_id = ? ", [$data[$recom]]);
                        $row = $find->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="col-12 col-lg-6  mb-3">
                    <a href="?page=shop&category=<?= htmlspecialchars($row['c_name']) ?>">
                        <div class="img-anim content w-100">
                            <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                            <div class="text font-bold">
                                <?= htmlspecialchars($row['des']) ?>
                            </div>
                        </div>
                    </a>
                </div>
                    <?php
                    }
                } else {
                    ?>
                    <?php
                    $find = dd_q("SELECT * FROM category ORDER BY RAND() LIMIT 4");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-12 col-lg-6  mb-3">
                        <a href="?page=shop&category=<?= htmlspecialchars($row['c_name']) ?>">
                            <div class="img-anim content w-100">
                                <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                                <div class="text font-bold">
                                    <?= htmlspecialchars($row['des']) ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }
                } ?>
            </div>

            <center>
                <div class="col-12 col-lg-12  p-2 mb-2" style="border-radius: 1vh;">
                    <div class="d-flex justify-content-between">
                        <div class="text-center text-lg-start">
                            <h2 class=" mt-2 mb-0 font-bold"><b>สินค้าแนะนำ</b></h2>
                            <h5 class=" mb-0" style="color: var(--font)">Product Recommended</h5>
                        </div>
                        <a class="btn nav-link align-self-center bg-main mt-4 font-semibold" href="?page=shop" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">เลือกดูทั้งหมด</b></a>
                    </div>
                </div>
            </center>
    
        

            <style>
                .cc {
                    width: 100%;
                    max-width: 250px;
                }

                @media only screen and (max-width: 1000px) {
                    .cc {
                        width: 100%;
                        max-width: 100vh;
                    }
                }

                .card-anim-main {
                    border: 1px solid #ffffff00;
                    transition: all .5s ease;
                }

                .border-hov {
                    border: 1px solid #ccc;
                    transition: 0.3s ease-in-out;
                }

                .card-anim:hover .card-anim-main {
                    border: 1px solid var(--main);
                }
            </style>
            <div class="row justify-content-center justify-content-lg-start">
                <?php
                $check = dd_q("SELECT * FROM recom WHERE recom_1 != 0 AND recom_2 != 0 AND recom_3 != 0 AND recom_4 != 0 AND recom_5 != 0 AND recom_6 != 0 AND recom_7 != 0 AND recom_8 != 0 AND recom_9 != 0 AND recom_10 != 0");
                if ($check->rowCount() == 1) {
                    $data = $check->fetch(PDO::FETCH_ASSOC);
                    for ($i = 1; $i <= 10; $i++) {
                        $recom = "recom_" . $i;
                        $find = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data[$recom]]);
                        $row = $find->fetch(PDO::FETCH_ASSOC);
                        $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
                        $count = $stock->rowCount();
                        if ($count  == NULL) {
                            $count = 0;
                        }
                ?>
                        <div class="col-12 col-lg-3 mb-4 cc" data-aos="<?php echo $anim; ?>">
                            <div class="card-anim-main <?php echo $bg?> border-ys shadow p-1" style="border-radius: 1vh; height: fit-content;">
                                <div class="container-fluid p-0 ">
                                    <a href="?page=buy&id=<?= $row['id'] ?>">
                                        <div class="view overlay">
                                            <center>
                                                <img class="img-fluid " src="<?php echo htmlspecialchars($row["img"]); ?>" style="border-radius: 1vh; width: 100%; max-width: 100vh;">
                                            </center>
                                            <a href="#!">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <div class="card-body p-3 pt-3 pb-1">
                                            <h5 class="  text-strongest mb-1" style="word-wrap: break-word;"><?php echo htmlspecialchars($row["name"]); ?></h5>
                                            <div class="d-flex justify-content-between">
                                                <p class="text-white align-self-center m-0 "><strong class="tex">ราคา : <?php echo number_format($row['price']); ?> บาท</strong></p>
                                            </div>
                                            <center>
                                                <a href="?page=buy&id=<?= $row['id'] ?>" class="btn bg-main w-100  mb-2" style="border-radius: 50px;"><i class="fa-regular fa-shopping-basket"></i>&nbsp;สั่งซื้อตอนนี้เลย</a>
                                                <p class=" m-0" style="width: fit-content;">สินค้าคงเหลือ <?php echo $count; ?> ชิ้น</p>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <?php
                    $find = dd_q("SELECT * FROM box_product ORDER BY id DESC LIMIT 8");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                        $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
                        $count = $stock->rowCount();
                        if ($count  == NULL) {
                            $count = 0;
                        }
                    ?>

                            <div class="col-12 col-lg-3 mb-4 justify-content-center" data-aos="<?php echo $anim; ?>" data-aos-duration="800">
                            <div class="card-anim">
                                <div class="card-anim-main <?php echo $bg?> border-hov shadow-sm p-1" style="border-radius: 1vh; height: fit-content;">
                                    <div class="p-1">
                                        <a href="?page=buy&id=<?= $row['id'] ?>">
                                            <div class="view overlay">
                                                <center>
                                                    <img class="img-fluid " src="<?php echo htmlspecialchars($row["img"]); ?>" style="border-radius: 1vh; width: 100%; max-width: 100vh;">
                                                </center>
                                                <a href="#!">
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>

                                            <div class="p-3 pt-3 pb-1">
                                                <h5 class="text-strongest mb-1" style="word-wrap: break-word;"><?php echo htmlspecialchars($row["name"]); ?></h5>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div class="d-flex">
                                                        <p class="text-main align-self-center m-0 h6 me-1"><strong>คงเหลือ <?php echo $count; ?> ชิ้น</strong></p>
                                                    </div>
                                                    <p class="text-white main-badge bg-main align-self-center m-0"><strong style="color: #ffffff;"><?php echo number_format($row['price']); ?> บาท</strong></p>
                                                </div>
                                                <style>
                                                    .btn-main {
                                                        color: var(--main);
                                                        background: var(--main-30);
                                                        border: 1px solid var(--main);
                                                        transition: all .5s ease;
                                                    }
                                                    .btn-main.active {
                                                        color: white;
                                                        background-color: var(--main);
                                                        border: 1px solid var(--main);
                                                    }

                                                    .btn-main.active i {
                                                        color: white !important;
                                                    }

                                                    .btn-main:hover {
                                                        color: white;
                                                        background-color: var(--main);
                                                        border: 1px solid var(--main);
                                                    }
                                                    @media only screen and (max-width: 500px) {
                                                        .pd-sm-font {
                                                            font-size: 13px !important;
                                                        }

                                                        .pd-h-font {
                                                            font-size: 16px;
                                                        }
                                                    }
                                                </style>
                                                <center>
                                                    <a class="btn-main btn w-100 pd-sm-font mb-2 font-semibold" href="?page=buy&id=<?= $row['id'] ?>" style="border-radius: 10px;">สั่งซื้อตอนนี้เลย </a>
                                                </center>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </div>

                    <?php } ?>
                <?php
                }
                ?>

            <!--<center>
                <div class="col-12 col-lg-12  p-2 mb-2" style="border-radius: 1vh;">
                    <div class="d-flex justify-content-between">
                        <div class="text-center text-lg-start">
                            <h2 class=" mt-2 mb-0 font-bold"><b>สุ่มรางวัล</b></h2>
                            <h5 class=" mb-0" style="color: var(--font)">Random Prizes</h5>
                        </div>
                        <a class="btn nav-link align-self-center bg-main mt-4 font-semibold" href="?page=random_wheel" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">เลือกดูทั้งหมด</b></a>
                    </div>
                </div>
            </center>

            <div class="row justify-content-center justify-content-lg-start">

                <?php
                    $find = dd_q("SELECT * FROM wheel ORDER BY RAND() LIMIT 2");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="col-12 col-lg-6 mb-3">
                    <a href="?page=play&wheel=<?= $row['id']; ?>">
                        <div class="container-fluid p-0 <?php echo $bg?> border-hov p-3 mb-2 shadow" style="border-radius: 1vh;">
                            <div class="img-anim content w-100">
                                <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                                <div class="text">
                                    <?= htmlspecialchars($row['name']) ?>
                                </div>
                            </div>
                            <center>
                                <a class="btn-main btn w-100 pd-sm-font mb-0 mt-2 font-semibold" href="?page=play&wheel=<?= $row['id']; ?>" style="border-radius: 10px;">เริ่มสุ่ม <?= htmlspecialchars($row['name']) ?> เลย</a>
                            </center>
                        </div>
                    </a>
                </div>

                <?php }?>

            </div>-->

        </div>
    </div>

   
    <!-- </div>
</div> -->

    <script src="services/js/countup.js"></script>
</div>
</div>
</div>
</div>