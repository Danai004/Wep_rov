<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<div class="container-sm <?php echo $bg?>  mt-5  shadow-sm p-4 mb-4 rounded" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-browser"></i>&nbsp;จัดการวิธีใช้</h1>
    </center>
    <hr>
    
    <div class="col-lg-6 m-auto">
        <h3>Video วิธีใช้</h3>
        <div class="mb-2 <?php echo $bg?> shadow-sm p-4 mb-4 rounded">
            <div class="mb-2 ">
                <p class="m-0  ">Youtube Video (ลิงค์) <span class="text-danger">*</span></p>
                <input type="text" id="link" class="form-control" value="https://www.youtube.com/watch?v=<?php echo $howtolink['link']; ?>">
            </div>
        </div>
        <center>
            <div class="col-lg-12 mb-2">
              <button class="btn text-white bg-main w-100" id="subm">บันทึกข้อมูล</button>
            </div>
        </center>
    </div>
</div>
<script type="text/javascript">
    
    $("#subm").click(function(e) {
        e.preventDefault();
        var check;
        // if ($('#pc').is(':checked')) {
        //     check = "on";
        // } else {
        //     check = "off";
        // }
        var formData = new FormData();
        formData.append('link', $("#link").val());
        

        $('#btn_regis').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: 'services/backend/howto.php',
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