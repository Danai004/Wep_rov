<?php
error_reporting(1);

require_once './a_func.php';

function slip_check($qrcode , $token)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://slip.xenc.xyz/services/api',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Token: ' . $token,
            'Qrcode: ' . $qrcode
        ),
   ));

    $response = curl_exec($curl);

    if ($response === false) {
        die('Curl error: ' . curl_error($curl));
    }

    curl_close($curl);

    $decoded_response = json_decode($response);

    

    return $decoded_response;
}

function dd_return($status, $message)
{
    $response = [
        'status' => $status ? 'success' : 'fail',
        'message' => $message,
    ];

    http_response_code($status ? 200 : 500);
    die(json_encode($response));
}

function processTopup($codeqr, $plr)
{
    $config_bank = dd_q("SELECT * FROM bank")->fetch(PDO::FETCH_ASSOC);
    $sc = slip_check($codeqr , 'vVFNG7OkKvnsS7Hl6368CLKJM6KyWSmUVOkoEQHZ7ZpoH5gd19');
    
    if ($sc->status == 200) {
        $info = $sc->data;
        $amount = $info->amount;
        
        $first = $config_bank['fname'];
        $last = $config_bank['lname'];
        $full_name = "$first $last";
        $recv_name = $info->receiver_data->receiverName;
        $recv_num = $info->receiver_data->accountNumber;
        
        //die($recv_name);
        if (strpos($full_name, $recv_name) !== false) {
            $ref =  $info->transRef;
            $q1 = dd_q("SELECT * FROM kbank_trans WHERE ref = ?", [$ref]);
            
            if ($q1->rowCount() < 1) {
                $senderName = $info->sender_data->senderName;
                
                $ha = dd_q(
                    "INSERT INTO `topup_his` (`id`, `link`, `amount`, `date`, `uid`, `uname`) VALUES (NULL, ? ,  ? , NOW() , ? , ? )",
                    [
                        "สลิปบัญชีชื่อ : " . $senderName,
                        $amount,
                        $_SESSION['id'],
                        $plr['username']
                    ]
                );
                
                $insert_ref = dd_q("INSERT INTO `kbank_trans`(`id`,`ref`, `sender`,`date`) VALUES(0,?,?,0)", [$ref, $senderName]);
                
                $update_user = dd_q("UPDATE users SET point = ? WHERE id = ?", [$plr['point'] + $amount, $_SESSION['id']]);
                
                if ($ha && $update_user) {
                    dd_return(true, "คุณเติมเงินสำเร็จจำนวน " . $amount . " บาท");
                } else {
                    dd_return(false, "SQL ผิดพลาด");
                }
            } else {
                dd_return(false, "สลิปนี้ใช้แล้ว");
            }
        } else {
            dd_return(false, "บัญชีไม่ตรงกลับทางร้าน $full_name // $recv_name");
        }
    } else {
        $message = $sc->message;
        $description = $sc->description;
        dd_return(false, $description);
    }
}



header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {
        $plr = dd_q("SELECT * FROM users WHERE id = ?", [$_SESSION['id']])->fetch(PDO::FETCH_ASSOC);
        if ($_POST['qrcode'] != '') {
            $codeqr = $_POST['qrcode'];

            processTopup($codeqr, $plr);
        } else {
            dd_return(false, "กรุณาส่งข้อมูลให้ครบ");
        }
    } else {
        dd_return(false, "เข้าสู่ระบบก่อนดำเนินการ");
    }
} else {
    dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}
?>