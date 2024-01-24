<?php 
    //topup by day
    date_default_timezone_set("Asia/Bangkok");
    $midnight = strtotime("today 00:00");
    $date_day =  date('Y-m-d H:i:s', $midnight);
    $q_1 = dd_q("SELECT sum(amount) AS total FROM topup_his WHERE date > ?",[$date_day]);
    $day = $q_1->fetch(PDO::FETCH_ASSOC);
    if($day["total"] == null){
        $day["total"] = "0.00";
    }
    // topup by month
    date_default_timezone_set("Asia/Bangkok");
    $midnight = strtotime("today 00:00");
    $date_month =  date('Y-m-01 H:i:s', $midnight);
    $q_2 = dd_q("SELECT sum(amount) AS total FROM topup_his WHERE date > ?",[$date_month]);
    $month = $q_2->fetch(PDO::FETCH_ASSOC);
    if($month["total"] == null){
        $month["total"] = "0.00";
    }
    // topup all
    $q_3 = dd_q("SELECT sum(amount) AS total FROM topup_his ");
    $topup = $q_3->fetch(PDO::FETCH_ASSOC);
    if($topup["total"] == null){
        $topup["total"] = "0.00";
    }
    //shop by day
    $q_4 = dd_q("SELECT id FROM boxlog WHERE date > ?",[$date_day]);
    $box_day = $q_4->rowCount();
    // shop by month
    $q_5 = dd_q("SELECT id FROM boxlog WHERE date > ?",[$date_month]);
    $box_month = $q_5->rowCount();
    // shop by all
    $q_6 = dd_q("SELECT id FROM boxlog");
    $box_all = $q_6->rowCount();

?>
<style>
    .font-bold {
        font-weight: 700;
    }
    .font-semibold {
        font-weight: 600;
    } 
    .font-semiboldx {
        font-weight: 550;
    } 
</style>

<div class="container-sm <?php echo $bg?>  mt-5 shadow-sm p-4 mb-4" style="border-radius: 10px;" data-aos="fade-down">
    <center>
        <h1 class="font-semibold"><i class="fa-duotone fa-chart-simple"></i>&nbsp;หน้าแดชบอร์ด</h1>
    </center>
    <style>
        hr{
            border-top: 2px solid var(--main);
            opacity: 1;
        }
    </style>
    <hr style="color: #000;">
    <div class="row jusify-content-between mt-4">

        <div class="col-lg-8 mb-2">
            <div class=" <?php echo $bg?> shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-2">

            <div class="container-fluid mb-2 p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class="font-semibold"><?php echo $day["total"];?>฿</h1>
                    <h5 class="font-semiboldx">ยอดการเติมในวันนี้</h5>
                </center>
            </div>

            <div class="container-fluid mb-2 p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class="font-semibold"><?php echo $month["total"];?>฿</h1>
                    <h5 class="font-semiboldx">ยอดการเติมในเดือนนี้</h5>
                </center>
            </div>

            <div class="container-fluid mb-2 p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class="font-semibold"><?php echo $topup["total"];?>฿</h1>
                    <h5 class="font-semiboldx">ยอดการเติมทั้งหมด</h5>
                </center>
            </div>

        </div>

        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class="font-semibold"><?php echo $box_day;?></h1>
                    <h5 class="font-semiboldx">ยอดกาารซื้อสินค้าวันนี้</h5>
                </center>
            </div>
        </div>

        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class="font-semibold"><?php echo $box_month;?></h1>
                    <h5 class="font-semiboldx">ยอดกาารซื้อสินค้าเดือนนี้</h5>
                </center>
            </div>
        </div>

        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class="font-semibold"><?php echo $box_all;?></h1>
                    <h5 class="font-semiboldx">ยอดกาารซื้อสินค้าทั้งหมด</h5>
                </center>
            </div>
        </div>

    </div>
</div>
<script>
    const data = {
    labels: ['รายวัน', 'รายเดือน', 'รวมทั้งหมด'],
      datasets: [{
        label: 'กราฟแสดงผลเติมเงิน',
        data: [<?php echo $day["total"];?>, <?php echo $month["total"];?>, <?php echo $topup["total"];?>],
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)'

        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)'
        ],
        borderWidth: 1
      }]
    };

    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
</script>