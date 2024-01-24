<?php
require_once 'a_func.php';


function dd_return($status, $message) {
    if ($status) {
        $json = ['status'=> 'success','message' => $message];
        http_response_code(200);
        die(json_encode($json));
    }else{
        $json = ['status'=> 'fail','message' => $message];
        http_response_code(200);
        die(json_encode($json));
    }
}

// //////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {
        $p = dd_q("SELECT * FROM users WHERE id = ? ", [$_SESSION['id']]);
        $plr = $p->fetch(PDO::FETCH_ASSOC);

        $pdx = dd_q('SELECT * FROM service_prod WHERE id = ?', [$_POST['id']]);
        $pd = $pdx->fetch(PDO::FETCH_ASSOC);

        $price =  $pd["price"];
        if ($plr["point"] >= $price) {
            $json_data = json_encode([
                "username" => $config['name'],
                "tts" => false,
                "embeds" => [
                    [
                        "title" => "มีการสั่ง Order มาใหม่",
                        "type" => "rich",
                        "timestamp" => date("c", strtotime("now")),
                        "color" => hexdec("AAFF00"),
                        "thumbnail" => [
                            "url" => $pd["img"],
                        ],
                        "fields" => [
                            [
                                "name" => "ชื่อผู้ใช้",
                                "value" => $plr['username'],
                                "inline" => false
                            ],
                            [
                                "name" => "ชื่อสินค้า",
                                "value" => $pd['name'],
                                "inline" => false
                            ],
                            [
                                "name" => "ราคา",
                                "value" => $price . " บาท",
                                "inline" => false
                            ]
                            // [
                            //     "name" => "ข้อมูลสินค้า",
                            //     "value" => $stock["username"],
                            //     "inline" => false
                            // ]
                        ]
                    ]
                ]

            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


            $ch = curl_init($config['webhook_dc']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            curl_close($ch);
            $insert = dd_q("INSERT INTO service_order (cosid , prod , user , pass , status , del)
                        VALUES ( ? , ? , ? , ? , ? , ?  ) 
                        ", [
                            $_SESSION['id'],
                            $pd["name"],
                            $_POST["user"],
                            $_POST["pass"],
                            "no",
                            "no"
                        ]);

                        $upt = dd_q("UPDATE users SET point = point  - ? WHERE id = ? ",[$price , $_SESSION['id']]);
                        if ($insert AND $upt) {
                            dd_return(true, "Order ซื้อสินค้าสำเร็จ !");
                        } else {
                            dd_return(false, "[ERROR API BUY] โปรดติดต่อเจ้าของเว็บ!");
                        }
        } else {
            dd_return(false,  "เงินไม่เพียงพอ");
        }
    } else {
        dd_return(false,  "เข้าสู่ระบบก่อนทำรายการ");
    }
} else {
    dd_return(false,  "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}