<div class="container-sm p-4" data-aos="<?php echo $anim; ?>">
        
        </div>
    </div>

    <div class="container-sm <?php echo $bg?>  mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
            <div class="col-12 col-lg-12 <?php echo $bg?> p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                    <h3 class=" m-0"><img src="<?php echo $ic_cat;?>" class="m-0 mb-2" style="height: 2.5rem;">&nbsp; จัดการหมวดหมู่บริการ</h3>
                    </div>
                    <button class="btn nav-link align-self-center <?php echo $bg?> underline-active" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                </div>
            </div>
        </center>
        <div class="d-flex justify-content-center">
        <button class="ms-2 me-2 mt-3 mb-0 btn btn-success col-12 col-lg-5 text-white" id="open_insert"> เพิ่มสินค้าใหม่</button>
    </div>
    <div class="table-responsive mt-3 ">
        <table id="table" class="table mt-2">
            <thead class="table">
                <tr class="">
                    <th class="sorting sorting_asc">id</th>
                    <th> ภาพบริการ</th>
                    <th> ชื่อบริการ</th>
                    <th> ราคา</th>
                    <th> หมวดหมู่</th>
                    <th> แก้ไข</th>
                    <th> ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_user = dd_q("SELECT * FROM service_prod ORDER BY id DESC");
                while ($row = $get_user->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td class=""><?php echo $row['id']; ?></td>
                        <td class=""><img src="<?php echo htmlspecialchars($row['img']); ?>" width="100px" alt=""></td>
                        <td class=""><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class=""><?php echo number_format($row['price']); ?></td>
                        <td class=""><?php echo htmlspecialchars($row['cate']); ?></td>
                        <td><button class="btn btn-warning  w-100" style="width : 130px!important" onclick="get_detail(<?php echo $row['id']; ?>)"><i class="fa-solid fa-pencil"></i>&nbsp;แก้ไข</button></td>
                        <td><button class="btn btn-danger  w-100" style="width : 130px!important" onclick="del('<?php echo $row['id']; ?>','<?php echo htmlspecialchars($row['username']); ?>')"><i class="fa-solid fa-trash"></i> ลบ</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="product_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;เพิ่มสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ชื่อสินค้า <span class="text-danger">*</span></p>
                            <input type="text" id="p_name" class="form-control" value="">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ลิงค์รูปภาพ <span class="text-danger">*</span></p>
                            <input type="text" id="p_img" class="form-control" value="">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">รายละเอียด <span class="text-danger">*</span></p>
                            <textarea id="p_des" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ราคาสินค้า <span class="text-danger">*</span></p>
                            <input type="text" id="p_price" class="form-control" value="0">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">หมวดหมู่สินค้า <span class="text-danger">*</span></p>
                            <select class="form-select text-dark" id="p_type_category">
                                <option value="0" selected style="color: #000">เลือกหมวดหมู่</option>
                                <?php
                                $getrow = dd_q("SELECT * FROM service_cate ORDER BY s_id DESC");
                                while ($row = $getrow->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $row['name'] ?>" style="color: #000"> <?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้านี้</button>
                <button type="button" class="btn btn-primary ps-4 pe-4" id="insert_btn" data-id="">เพิ่มสินค้า</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="product_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;แก้ไขสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ชื่อสินค้า <span class="text-danger">*</span></p>
                            <input type="text" id="name" class="form-control" value="username">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ลิงค์รูปภาพ <span class="text-danger">*</span></p>
                            <input type="text" id="img" class="form-control" value="">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">รายละเอียด <span class="text-danger">*</span></p>
                            <textarea id="des" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ราคาสินค้า <span class="text-danger">*</span></p>
                            <input type="text" id="price" class="form-control" value="0">
                        </div>
                        
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">หมวดหมู่สินค้า <span class="text-danger">*</span></p>
                            <select class="form-select text-dark" id="type_category">
                                <option value="0" selected style="color: #000">เลือกหมวดหมู่</option>
                                <?php
                                $addgr = dd_q("SELECT * FROM service_cate ORDER BY s_id DESC");
                                while ($row = $addgr->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option id="c_type_selected" value="<?= $row['name'] ?>" style="color: #000"><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="save_btn" data-id="">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#open_insert").click(function() {
        const myModal = new bootstrap.Modal('#product_insert', {
            keyboard: false
        })
        myModal.show();
    });
    $("#save_btn").click(function() {
        var formData = new FormData();
        formData.append('id', $("#save_btn").attr("data-id"));
        formData.append('img', $("#img").val());
        formData.append('price', $("#price").val());
        formData.append('des', $("#des").val());
        formData.append('name', $("#name").val());
        formData.append('c_type', $("#type_category").val());
        $.ajax({
            type: 'POST',
            url: 'services/backend/service_product_update.php',
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
                window.location = "?page=<?php echo $_GET['page']; ?>";
            });
        }).fail(function(jqXHR) {
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
    $("#insert_btn").click(function() {
        var formData = new FormData();
        formData.append('img', $("#p_img").val());
        formData.append('price', $("#p_price").val());
        formData.append('des', $("#p_des").val());
        formData.append('name', $("#p_name").val());
        formData.append('type', $("#p_type_product").val());
        formData.append('c_type', $("#p_type_category").val());
        $.ajax({
            type: 'POST',
            url: 'services/backend/service_product_insert.php',
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
                window.location = "?page=<?php echo $_GET['page']; ?>";
            });
        }).fail(function(jqXHR) {
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

    function get_detail(id) {
        var formData = new FormData();
        formData.append('id', id);

        $.ajax({
            type: 'POST',
            url: 'services/backend/call/service_product_detail.php',
            data: formData,
            contentType: false,
            processData: false,
        }).done(function(res) {
            console.log(res);
            $("#name").val(res.name);
            $("#img").val(res.img);
            $("#price").val(res.price);
            $("#des").val(res.des);
            $("#c_type").val(res.c_type);
            $("#type_selected").val(res.type);
            if (res.type == "1") {
                $("#type_selected").html("ได้ของรางวัลแน่นอน");
                $("#type_unselected").html("สุ่มรางวัล");
                $("#type_unselected").val("0");
            } else {
                $("#type_selected").html("สุ่มรางวัล");
                $("#type_unselected").html("ได้ของรางวัลแน่นอน");
                $("#type_unselected").val("1");
            }
            $("option[value='"+res.c_type+"']").attr('selected', 'selected');
            $("#save_btn").attr("data-id", id);
            const myModal = new bootstrap.Modal('#product_detail', {
                keyboard: false
            })
            myModal.show();
        }).fail(function(jqXHR) {
            console.log(jqXHR);
            res = jqXHR.responseJSON;
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
        });

    }

    function del(id, username) {
        Swal.fire({
            title: 'ยืนยันที่จะลบ?',
            text: "คุณแน่ใจหรอที่จะลบผู้ใช้  " + username,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบเลย'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    url: 'services/backend/service_product_del.php',
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
                        window.location = "?page=<?php echo $_GET['page']; ?>";
                    });
                }).fail(function(jqXHR) {
                    console.log(jqXHR);
                    res = jqXHR.responseJSON;
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: res.message
                    })
                    //console.clear();
                });
            }
        })


    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });
    $("#btn_regis").click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $("#site_name").val());
        // formData.append('bg', $("#site_bg").val());
        formData.append('phone', $("#site_phone").val());
        formData.append('main_color', $("#site_main_color").val());
        formData.append('logo', $("#site_logo").val());
        formData.append('sec_color', $("#site_sec_color").val());
        formData.append('font_color', $("#site_font_color").val());
        formData.append('widget_discord'  , $("#site_widget_discord").val() );
        formData.append('discord'  , $("#site_contact_discord").val() );
        formData.append('facebook'  , $("#site_contact_facebook").val() );
        formData.append('des', $("#site_des").val());
        $('#btn_regis').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: 'services/backend/website.php',
            data: formData,
            contentType: false,
            processData: false,
        }).done(function(res) {
            result = res;
            console.log(result);
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: result.message
            }).then(function() {
                window.location = "?page=<?php echo $_GET['page']; ?>";
            });
        }).fail(function(jqXHR) {
            console.log(jqXHR);
            res = jqXHR.responseJSON;
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
            $('#btn_regis').removeAttr('disabled');
        });
    });
</script>