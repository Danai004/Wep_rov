<div class="container-fluid p-4">
    <div class="container-sm  ps-4 pe-4">
        <div class="container-fluid   p-4">
            <div class="col-lg-7 m-auto">
                
                <center>
                    <iframe data-aos="<?php echo $anim; ?>" data-aos-duration="800" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $howtolink["link"]; ?>" allowfullscreen></iframe>
                </center>
                
            </div>
        </div>
    </div>
</div>

<script>
    $("#topup_btn").click(function(){
        var formData = new FormData();
        formData.append('link'  , $("#link").val());
        $.ajax({
            type: 'POST',
            url: 'services/topup.php',
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