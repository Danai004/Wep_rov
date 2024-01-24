<?php

$curl = curl_init();

$data = array(
    'keyapi' => $byshop_key,
    'username_customer' => $user["id"]
);


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://byshop.me/api/history-all', 
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_POSTFIELDS => http_build_query($data),
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
));

$response = curl_exec($curl);
curl_close($curl);
$load_packz = json_decode($response);

?>

<div class="modal fade text-white bg-glass" id="appInfoModal" tabindex="-1" role="dialog" aria-labelledby="appInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-white bg-glass" style="border-radius: 1vh;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="appInfoModalLabel">ข้อมูล App Premium</h5>
                <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body text-white" id="appInfoContent">
                <!-- ข้อมูลจะถูกแสดงที่นี่ -->
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-0 " data-aos="<?php echo $anim; ?>">
    <div class="container-sm p-4" data-aos="<?php echo $anim; ?>">
        <center>
            <div class="col-12 col-lg-12 <?php echo $bg?> p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                        <h3 class=" m-0"><img src="<?php echo $ic_byshop;?>" class="m-0 mb-2" style="height: 2.5rem;">&nbsp; App Premium ของคุณ</h3>
                    </div>
                    <button class="btn nav-link align-self-center <?php echo $bg?> underline-active" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                </div>
            </div>
        </center>
    </div>
    <div class="container-sm  m-cent  p-0 pt-4 ">
        <div class="container-sm ">
            <div class="container-fluid">
                <div class="container-fluid">
				<div class="row justify-content-center justify-content-lg-start">
					<div class="row" >
						<?php 
						foreach ($load_packz as $data) {
						?>
						<div class="col-12 col-lg-3 mb-4 cc aos-init aos-animate" data-aos="zoom-in">
							<div class="card-anim-main bg-glass border-ys shadow p-1" style="border-radius: 1vh; height: fit-content;">
								<div class="container-fluid p-0 ">
									
									<div class="card-body p-3 pt-3 pb-1">
										<h5 class="text-strongest mb-1" style="word-wrap: break-word;"><?=$data->name;?></h5>
										<div class="d-flex justify-content-between">
											<p class="text-main align-self-center m-0 "><strong><?=$data->price + $byshop_cost;?> บาท</strong></p>
										</div>
										<center>
											<button class="btn bg-main w-100 mb-2 view-info-btn" data-toggle="modal" data-target="#appInfoModal" data-info="Email : <?= htmlspecialchars($data->email); ?> | Password : <?= htmlspecialchars($data->password); ?>"><i class="fa-regular fa-search"></i>&nbsp;ดูข้อมูล</button>
										</center>
									</div>
								</div>
							</div>
						</div>			
						<?php  } ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    // Triggered when "ดูข้อมูล" button is clicked
    $(".view-info-btn").click(function() {
        // Get the info attribute from the button
        var appInfo = $(this).data("info");

        // Set the content of the modal body
        $("#appInfoContent").html(appInfo);
    });
</script>
