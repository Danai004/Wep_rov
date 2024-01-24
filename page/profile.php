<div class="container-fluid ">
    <div class="container-sm m-auto ">
        <div class="container-fluid shadow-sm" data-aos="<?php echo $anim; ?>">
            
                    <?php 
                    if(isset($_GET['subpage']) && $_GET['subpage'] == "cpass"){
                        require_once('page/cpass.php'); 
                    }elseif(isset($_GET['subpage']) && $_GET['subpage'] == "topuphis"){
                        require_once('page/topuphis.php');
                    }elseif(isset($_GET['subpage']) && $_GET['subpage'] == "buyhis" ){
                        require_once('page/buyhis.php');
                    }else{
                        require_once('page/cpass.php');
                    }
                    ?>
            </div>
    </div>
</div>