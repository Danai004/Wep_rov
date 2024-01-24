<div class="container-sm p-4" data-aos="<?php echo $anim; ?>">
        
        </div>
    </div>

    <div class="container-sm <?php echo $bg?>  mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
            <div class="col-12 col-lg-12 <?php echo $bg?> p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                    <h3 class=" m-0"><img src="<?php echo $ic_user;?>" class="m-0 mb-2" style="height: 2.5rem;">&nbsp; Order</h3>
                    </div>
                    <button class="btn nav-link align-self-center <?php echo $bg?> underline-active" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                </div>
            </div>
        </center>
        <div class="d-flex justify-content-center">
            
        
    </div>
    
    <div class="table-responsive mt-3 ">
    
        <table id="table" class="table mt-2">
        <center>
                <h2>Order รอดำเนินการ</h2>
            </center>
            <thead class="table">
                <tr class="">
                    <th class="sorting sorting_asc">id</th>
                    <th> </th>
                    <th> ชื่อสินค้า</th>
                    <th> ผู้สั่งซื้อ</th>
                    <th> สถานะ</th>
                    <th> Username</th>
                    <th> Password</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_user = dd_q("SELECT * FROM service_order WHERE status = ? AND del = 'no' ORDER BY id DESC", ["no"]);

                function st($text)
                {
                    if ($text == "no") {
                        return "กำลังดำเนินการ";
                    } elseif ($text == "yes") {
                        return "สำเร็จ";
                    } elseif ($text == "not") {
                        return "ไม่สำเร็จ";
                    }
                }
                function getimg($text)
                {

                    $i = dd_q("SELECT * FROM service_prod WHERE name = ?",  [$text]);
                    $is = $i->fetch(PDO::FETCH_ASSOC);
                    return $is["img"];
                    
                    
                }
                function getuser($text)
                {

                    $i = dd_q("SELECT * FROM users WHERE id = ?",  [$text]);
                    $is = $i->fetch(PDO::FETCH_ASSOC);
                    return $is["username"];
                    
                    
                }
                
                while ($row = $get_user->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td class=""><?php echo $row['id']; ?></td>
                        <td class=""><img src="<?php echo htmlspecialchars(getimg($row['prod'])); ?>" width="100px" alt=""></td>
                        <td class=""><?php echo htmlspecialchars($row['prod']); ?></td>
                        <td class=""><?php echo htmlspecialchars(getuser($row['cosid'])); ?></td>
                        <td class=""><?php echo htmlspecialchars(st($row['status'])); ?></td>
                        <td class=""><?php echo htmlspecialchars($row['user']); ?></td>
                        <td class=""><?php echo htmlspecialchars($row['pass']); ?></td>
                        <td><button class="btn btn-success  w-100" style="width : 130px!important" onclick="suc('<?php echo $row['id']; ?>')"><i class="fa-solid fa-check"></i>&nbsp;สำเร็จ</button></td>
                        <td><button class="btn btn-danger  w-100" style="width : 130px!important" onclick="unsuc('<?php echo $row['id']; ?>')"><i class="fa-solid fa-x"></i>&nbsp;ไม่สำเร็จ</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>



    <a class="btn nav-link align-self-center <?php echo $bg?> underline-active" href="?page=order_success" style="height: fit-content;"><b><i class="fa-solid fa-check"></i> ไปยัง Order ที่สำเร็จแล้ว</b></a>
    <a class="btn nav-link align-self-center <?php echo $bg?> underline-active" href="?page=order_unsuccess" style="height: fit-content;"><b><i class="fa-solid fa-x"></i> ไปยัง Order ที่ไม่สำเร็จ</b></a> 
    <a class="btn nav-link align-self-center <?php echo $bg?> underline-active" href="?page=order_temp" style="height: fit-content;"><b><i class="fa-solid fa-bucket"></i> ไปยัง Order ในถังขยะ</b></a>    
    
</div>





<script>
    

    

    function suc(id) {
        Swal.fire({
            title: 'ยืนยันที่จะตั้งสถานะเป็นสำเร็จ',
            text: "คุณแน่ใจหรอที่จะตั้งสถานะ Order นี้เป็นสำเร็จ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.append('id', id);
                formData.append('st', "yes");
                $.ajax({
                    type: 'POST',
                    url: 'services/backend/order_update.php',
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

    function unsuc(id) {
        Swal.fire({
            title: 'ยืนยันที่จะตั้งสถานะเป็นไม่สำเร็จ',
            text: "คุณแน่ใจหรอที่จะตั้งสถานะ Order นี้เป็นไม่สำเร็จ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.append('id', id);
                formData.append('st', "not");
                $.ajax({
                    type: 'POST',
                    url: 'services/backend/order_update.php',
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