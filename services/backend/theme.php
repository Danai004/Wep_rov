<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once '../a_func.php';

    function dd_return($status, $message) {
        $json = ['message' => $message];
        if ($status) {
            http_response_code(200);
            die(json_encode($json));
        }else{
            http_response_code(400);
            die(json_encode($json));
        }
    }

    //////////////////////////////////////////////////////////////////////////

    header('Content-Type: application/json; charset=utf-8;');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {

        if ($_POST['icon'] != "" AND $_POST['ui'] != "" AND $_POST['uic'] != "" AND $_POST['anim'] != "" AND $_POST['bg'] != "" AND $_POST['logo'] != "") {
            $q_1 = dd_q('SELECT * FROM users WHERE id = ? AND rank = 1 ', [$_SESSION['id']]);
            if ($q_1->rowCount() >= 1) {
                $insert = dd_q("UPDATE theme_setting SET 
                    icon = ?,
                    ui = ?,
                    uic = ?,
                    anim = ?
                ", [
                    $_POST['icon'],
                    $_POST['ui'],
                    $_POST['uic'],
                    $_POST['anim']
                ]);
                $insert2 = dd_q("UPDATE setting SET 
                    main_color = ?,
                    sec_color = ?,
                    font_color = ?,
                    bg2 = ?,
                    logo = ?
                ", [
                    $_POST['main_color'],
                    $_POST['sec_color'],
                    $_POST['font_color'],
                    $_POST['bg'],
                    $_POST['logo']
                ]);
                if($insert AND $insert2){
                    dd_return(true, "บันทึกสำเร็จ");
                }else{
                    dd_return(false, "SQL ผิดพลาด");
                }
            }else{
                dd_return(false, "เซสชั่นผิดพลาด โปรดล็อกอินใหม่");
                session_destroy();
            }
        }else{
            dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
        }
        }else{
        dd_return(false, "เข้าสู่ระบบก่อน");
        }
    }else{
        dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
    }
?>
