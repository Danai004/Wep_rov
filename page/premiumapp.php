<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://byshop.me/api/product', 
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);
$load_packz = json_decode($response);

?>




<div class="container-fluid p-0 ">
    <div class="container-sm  m-cent  p-0 pt-4 ">
        <div class="container-sm ">
            <div class="container-fluid">
                <div class="container-fluid">
				<div class="row justify-content-center justify-content-lg-start">
					<div class="row" >
						<?php 
						foreach ($load_packz as $data) {
						?>

						<!--<div class="col-12 col-lg-3 mb-4 cc aos-init aos-animate" data-aos="zoom-in">
							<div class="card-anim-main <?php echo $bg?> border-ys shadow p-1" style="border-radius: 1vh; height: fit-content;">
								<div class="container-fluid p-0 ">
									<a href="?page=buyapp&amp;id=<?=$data->id;?>">
									</a>
									<div class="view overlay"><a href="?page=buyapp&amp;id=<?=$data->id;?>">
										<center>
											<img class="img-fluid " src="<?=$data->img;?>" style="border-radius: 1vh; width: 100%; max-width: 100vh;">
										</center>
										</a><a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
									<div class="card-body p-3 pt-3 pb-1">
										<h5 class="  text-strongest mb-1" style="word-wrap: break-word;"><?=$data->name;?></h5>
										<div class="d-flex justify-content-between">
											<p class="text-main  align-self-center m-0 "><strong><?=$data->price + $byshop_cost;?> บาท</strong></p>
										</div>
										<center>
											<a href="?page=buyapp&amp;id=<?=$data->id;?>" class="btn bg-main w-100  mb-2" style="border-radius: 50px;"><i class="fa-regular fa-shopping-basket"></i>&nbsp;สั่งซื้อตอนนี้เลย</a>
											<p class=" m-0" style="width: fit-content;">สินค้าคงเหลือ <?=$data->stock;?> ชิ้น</p>
										</center>
									</div>
								</div>
							</div>
						</div>-->
						
						<div class="col-12 col-lg-3 mb-4 justify-content-center" data-aos="<?php echo $anim; ?>" data-aos-duration="800">
                            <div class="card-anim">
                                <div class="card-anim-main <?php echo $bg?> border-hov shadow-sm p-1" style="border-radius: 1vh; height: fit-content;">
                                    <div class="p-1">
                                        <a href="?page=buyapp&amp;id=<?=$data->id;?>">
                                            <div class="view overlay">
                                                <center>
                                                    <img class="img-fluid " src="<?=$data->img;?>" style="border-radius: 1vh; width: 100%; max-width: 100vh;">
                                                </center>
                                                <a href="#!">
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>

                                            <div class="p-3 pt-3 pb-1">
                                                <h5 class="text-strongest mb-1" style="word-wrap: break-word;"><?=$data->name;?></h5>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div class="d-flex">
                                                        <p class="text-main align-self-center m-0 h6 me-1"><strong>คงเหลือ <?=$data->stock;?> ชิ้น</strong></p>
                                                    </div>
                                                    <p class="text-white main-badge bg-main align-self-center m-0"><strong style="color: #ffffff;"><?=$data->price + $byshop_cost;?> บาท</strong></p>
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
                                                    <a class="btn-main btn w-100 pd-sm-font mb-2 font-semibold" href="?page=buyapp&amp;id=<?=$data->id;?>" style="border-radius: 10px;">สั่งซื้อตอนนี้เลย</a>
                                                </center>
                                            </div>
                                        </a>
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












