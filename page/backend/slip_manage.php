<?php $bank = dd_q("SELECT * FROM bank WHERE 1")->fetch(PDO::FETCH_ASSOC); ?>
<div class="container-sm <?php echo $bg?>  mt-5  shadow-sm p-4 mb-4 rounded" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-browser"></i>&nbsp;จัดการธนาคาร</h1>
    </center>
    <hr>
    <div class="col-lg-6 m-auto">
        <div class="mb-2 ">
            <div class="row">
                <div class="col me-2">
                    <p class="m-0">ชื่อ<span class="text-danger">*</span></p>
                    <input type="text" id="fname" class="form-control" value="<?php echo $bank['fname']; ?>">
                </div>
                <div class="col">
                    <p class="m-0">นามสกุล<span class="text-danger">*</span></p>
                    <input type="text" id="lname" class="form-control" value="<?php echo $bank['lname']; ?>">
                </div>
            </div>
        </div>
        <div class="mb-2 ">
            <p class="m-0">เลขบัญชี<span class="text-danger">*</span></p>
            <input type="text" id="bnum" class="form-control" value="<?php echo $bank['bnum']; ?>">
        </div>
        <div class="mb-2">
            <p class="m-0">เลือกธนาคาร<span class="text-danger">*</span></p>
            <select name="tname" id="tname" class="form-control">
                <option class="text-dark" value="ธนาคารกสิกร" <?php if($bank['tname'] == 'ธนาคารกสิกร') echo "selected"; ?>>ธนาคารกสิกร</option>
                <option class="text-dark" value="ธนาคารกรุงศรี" <?php if($bank['tname'] == 'ธนาคารกรุงศรี') echo "selected"; ?>>ธนาคารกรุงศรี</option>
                <option class="text-dark" value="ธนาคารกรุงไทย" <?php if($bank['tname'] == 'ธนาคารกรุงไทย') echo "selected"; ?>>ธนาคารกรุงไทย</option>
                <option class="text-dark" value="ธนาคารกรุงเทพ" <?php if($bank['tname'] == 'ธนาคารกรุงเทพ') echo "selected"; ?>>ธนาคารกรุงเทพ</option>
                <option class="text-dark" value="ธนาคารไทยพาณิชย์" <?php if($bank['tname'] == 'ธนาคารไทยพาณิชย์') echo "selected"; ?>>ธนาคารไทยพาณิชย์</option>
                <option class="text-dark" value="ธนาคารออมสิน" <?php if($bank['tname'] == 'ธนาคารออมสิน') echo "selected"; ?>>ธนาคารออมสิน</option>
                <option class="text-dark" value="พร้อมเพย์" <?php if($bank['tname'] == 'พร้อมเพย์') echo "selected"; ?>>พร้อมเพย์</option>
            </select>
        </div>
        <div class="mb-2">
            <button class="btn  bg-main w-100" id="btn_regis">บันทึกข้อมูล</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#btn_regis").click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('fname', $("#fname").val());
        formData.append('lname', $("#lname").val());
        formData.append('bnum', $("#bnum").val());
        formData.append('tname', $("#tname").val());
        $('#btn_regis').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: 'services/backend/slip_manage.php',
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
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>