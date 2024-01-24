<?php
if ($_GET['id'] != '') {
    $pdshop = dd_q("SELECT * FROM box_product WHERE id = ? LIMIT 1", [$_GET['id']]);
    if ($pdshop->rowCount() != 0) {
        $row_1 = $pdshop->fetch(PDO::FETCH_ASSOC);
        $count = dd_q("SELECT * FROM box_stock WHERE p_id = ?", [$row_1['id']])->rowCount();
?>
        <div class="container mt-3 mb-3">
            <div class="container-sm">
                <div class="<?php echo $bg?> shadow p-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb d-flex justify-content-center mt-3">
                            <li class="breadcrumb-item"><a href="?page=shop" style="text-decoration: none; color: #6C757D;"> สินค้าทั้งหมด</a></li>
                            <li class="breadcrumb-item"><a href="?page=shop&category=<?= htmlspecialchars($row_1['c_type']) ?>" style="text-decoration: none; color: #6C757D;"> <?= htmlspecialchars($row_1['c_type']) ?></a></li>
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
                                    <div class="col-auto">จำนวนสินค้าที่จะซื้อ</div>
                                    <div class="col">
                                        <hr>
                                    </div>

                                    <style>
                                        .font-bold {
                                            font-family: 'IBM Plex Sans Thai', sans-serif;
                                            font-weight: 600;
                                        }
                                    </style>
                                    <div class="d-flex mb-2">

                                        <button  onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="btn bg-main border-0 text-white font-bold" id="minus">
                                            <h5 class="font-bold text-white m-0">-</h5>
                                        </button>

                                        <input type="number" id="b_count" class="form-control ms-2 me-2 text-center h-100" min="1" max="200" value="1">

                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="btn bg-main border-0 text-white font-bold" id="plus">
                                            <h5 class="font-bold text-white m-0">+</h5>
                                        </button>

                                    </div>

                                    <div class="d-flex justify-content-between pe-3 ps-3 mt-2">
                                        <span class="m-0 align-self-center">สินค้าคงเหลือ <?= $count ?> ชิ้น</span>
                                        <span class="m-0 align-self-center">ราคาสินค้า <?= $row_1['price'] ?> บาท / ชิ้น</span>
                                    </div>
                                </div>
                                <button class="btn w-100 mt-2 text-white" id="shop-btn" onclick="buybox()" data-id="<?= $row_1['id'] ?>" data-name="<?= $row_1['name'] ?>" data-price="<?= $row_1['price'] ?>" style="background-color: var(--main);">สั่งซื้อ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<script>window.location.href = '?page=shop';</script>";
    }
} else {
    echo "<script>window.location.href = '?page=shop';</script>";
}
?>