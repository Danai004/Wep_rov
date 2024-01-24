<div class="container-fluid p-0 ">
    <div class="container-sm  m-cent  p-0 pt-4 ">
        <div class="container-sm ">
            <div class="container-fluid">
                <div class="container-fluid" data-aos="<?php echo $anim; ?>">
                
                    <?php if (!isset($_GET['category'])) : ?>

                        <center>
                            <div class="col-12 col-lg-12 p-0 mb-2" style="border-radius: 1vh;">
                                <div class="d-flex justify-content-between">
                                    <div class="text-center text-lg-start">
                                        <h2 class=" mt-2 mb-0 font-semibold"><b>หมวดหมู่ทั้งหมด</b></h2>
                                    </div>
                                    <a class="btn nav-link align-self-center bg-main mt-0" onclick="window.history.back()" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">ย้อนกลับ</b></a>
                                </div>
                            </div>
                        </center>

                    <?php else : ?>

                        <center>
                            <div class="col-12 col-lg-12 <?php echo $bg?> shadow p-2" style="border-radius: 1vh;">
                                <div class="d-flex justify-content-between">
                                    <div class="text-center text-lg-start">
                                        <h4 class="font-semibold m-0">หมวดหมู่ : <?= htmlspecialchars($_GET['category']); ?></h4>
                                    </div>
                                    <button class="btn nav-link align-self-center <?php echo $bg?> underline-active" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                                </div>
                            </div>
                        </center>
                                            
                    <?php endif ?>
                    <hr>
                    <div class="row justify-content-center justify-content-lg-start">
                        <?php if (!isset($_GET['category'])) {
                            $cfind = dd_q("SELECT * FROM category ");
                            $check = $cfind->rowCount();
                            if ($check  == NULL) {
                                echo '<h6 class=" text-center">ไม่มีหมวดหมู่ในตอนนี้</h6>';
                            } elseif ($_GET['category'] == NULL) {
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
                            }
                            while ($row = $cfind->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <style>
                            .font-bold {
                                font-weight: 700;
                            }
                            .font-semibold {
                                font-weight: 600;
                            }  
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

                        </style>    
                                <div class="col-12 col-lg-6  mb-3">
                                    <a href="?page=shop&category=<?= htmlspecialchars($row['c_name']) ?>">
                                        <div class="img-anim content w-100">
                                            <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                                            <div class="text font-semibold">
                                                <?= htmlspecialchars($row['des']) ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            <?php } ?>
                            <?php
                        } else {
                            $find = dd_q("SELECT * FROM box_product WHERE c_type = ? ORDER BY id DESC", [$_GET['category']]);
                            while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                                $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
                                $count = $stock->rowCount();
                                if ($count  == NULL) {
                                    $count = 0;
                                }
                            ?>
  
                            <div class="col-12 col-lg-3 mb-4" data-aos="<?php echo $anim; ?>" data-aos-duration="800">
                                <div class="card-anim-main <?php echo $bg?> border-ys shadow p-1" style="border-radius: 1vh; height: fit-content;">
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

                                            <div class=" p-3 pt-3 pb-1">
                                                <h5 class="text-center text-strongest mb-1" style="word-wrap: break-word;"><?php echo htmlspecialchars($row["name"]); ?></h5>
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
                                                    <a class="btn-main btn w-100 pd-sm-font mb-2" href="?page=buy&id=<?= $row['id'] ?>" style="border-radius: 10px;">สั่งซื้อตอนนี้เลย </a>
                                                </center>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php             }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>