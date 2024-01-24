<?php
session_start();
error_reporting(0);
require_once("services/a_func.php");
if (isset($_SESSION['id'])) {
    $q1 = dd_q("SELECT * FROM users WHERE id = ? LIMIT 1", [$_SESSION['id']]);
    if ($q1->rowCount() == 1) {
        $user = $q1->fetch(PDO::FETCH_ASSOC);
    } else {
        session_destroy();
        $_GET['page'] = "login";
    }
}

$config = dd_q("SELECT * FROM setting")->fetch(PDO::FETCH_ASSOC);
$howtolink = dd_q("SELECT * FROM howto")->fetch(PDO::FETCH_ASSOC);
$get_static = dd_q("SELECT * FROM static");
$static = $get_static->fetch(PDO::FETCH_ASSOC);


$ic_home = "none";
$ic_shop = "none";
$ic_topup = "none";
$ic_user = "none";
$ic_adduser = "none";

$ic_cat = "";
$ic_inst = "";
$ic_soldout = "";
$ic_tele = "";

$ic_cart = "";
$ic_wheel = "";

$ic_backend = "";
$ic_coin = "";
$ic_edit = "";
$ic_his = "";
$ic_logout = "";
$ic_howto = "";

$ic_service = "";
$ic_contact = "";

$tst = dd_q("SELECT * FROM theme_setting")->fetch(PDO::FETCH_ASSOC);
if ($tst["icon"] == "classic") {
    $ic_home = "assets/icon/house.png";
    $ic_shop = "assets/icon/store.png";
    $ic_topup = "assets/icon/credit.png";
    $ic_user = "assets/icon/profile.png";
    $ic_adduser = "assets/icon/add-user.png";

    $ic_cat = "assets/icon/application.png";
    $ic_inst = "assets/icon/in-stock.png";
    $ic_soldout = "assets/icon/out-of-stock.png";
    $ic_tele = "https://cdn-icons-png.flaticon.com/512/8306/8306906.png";

    $ic_cart = "assets/icon/shopping-cart.png";
    $ic_wheel = "assets/icon/wheel.png";

    $ic_backend = "assets/icon/manager.png";
    $ic_coin = "assets/icon/assets/icon/dollar.png";
    $ic_edit = "assets/icon/user-ed.png";
    $ic_his = "assets/icon/history.png";
    $ic_logout = "assets/icon/enter.png";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969070993418/icons8-question-100_2.png?ex=6561e07c&is=654f6b7c&hm=a1a05f1f67cfed74c71e56b7d3cf2d1c87059882e186bf6c485bf2a7b0ad39ce&";
    $ic_service = "assets/icon/call-center.png";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515761121853440/icons8-phone-100.png?ex=6567e00a&is=65556b0a&hm=de93f33e46e5c9fe5deff0074df4f83005dc4c5cf5a8d0229f3625e1294f6b13&";
}
if ($tst["icon"] == "normal") {
    $ic_home = "https://cdn.discordapp.com/attachments/1172513665367425214/1172517648018452530/icons8-home-48_2.png?ex=65609b27&is=654e2627&hm=2bc260265a8fad58060b6620c0b11722a0d4156057df15c7b939fbd006f794d8&";
    $ic_shop = "https://cdn.discordapp.com/attachments/1172513665367425214/1172528161775423558/icons8-shopping-bag-48_1.png?ex=6560a4f2&is=654e2ff2&hm=44ae31a4b75f9dcda6d5401dcdf9aaaed22325ae311bfb0db1a044194515e578&";
    $ic_topup = "https://cdn.discordapp.com/attachments/1172513665367425214/1172527125912358932/icons8-wallet-48_2.png?ex=6560a3fb&is=654e2efb&hm=f26dda9ccad4b336d34e4d2d1f06bce3ec1f1c03a8c0ccb12a7c9e72d625b2c3&";
    $ic_user = "https://cdn.discordapp.com/attachments/1172513665367425214/1172530612159139910/icons8-user-48_2.png?ex=6560a73a&is=654e323a&hm=cbb8b806ff38501f17933d7dc7852e45f28844921dcc422424bea1ed3c262b83&";
    $ic_adduser = "https://cdn.discordapp.com/attachments/1172513665367425214/1172533185263968276/icons8-add-user-48_2.png?ex=6560a99f&is=654e349f&hm=06d22d3ec00199678c6f9e3e8e0c4b658034e4735a4c23cd8e894d529133ccdb&";
    
    $ic_cat = "https://cdn.discordapp.com/attachments/1172513665367425214/1172535857190817873/icons8-android-app-drawer-48.png?ex=6560ac1d&is=654e371d&hm=b9b1180c68da6aabf6b488a38f40bfe1bb56033995a8a407f01d171e0c9198e3&";
    $ic_inst = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537299762946188/icons8-box-48_2.png?ex=6560ad74&is=654e3874&hm=1b46cfef40351f122e1bdcc78fe890ed107cba543919263e2dcbbb3cde97ea50&";
    $ic_soldout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537269664612392/icons8-out-of-stock-48_2.png?ex=6560ad6d&is=654e386d&hm=748e03c2eefb124824e654a69b9cbb682378f63008d3af030511a14afa657773&";
    $ic_tele = "https://cdn.discordapp.com/attachments/1172513665367425214/1172538841387761734/icons8-megaphone-48_2.png?ex=6560aee4&is=654e39e4&hm=dbdff622ac599e271005d4145ddbf501d401109ce82f0a5c10c37dc31693eef8&";

    $ic_cart = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745892139368528/icons8-shop-100_2.png?ex=65616fb9&is=654efab9&hm=b701e91125e96264012477ae8b79fc478d270c48515e677d0c4b3e234df49024&";
    $ic_wheel = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745378257448981/icons8-lucky-wheel-100_2.png?ex=65616f3e&is=654efa3e&hm=8a2b6941a0536ecb9e7e3710949ab818a96f42a400d401cc02878a12fc8cab8c&";

    $ic_backend = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752890805370920/icons8-store-setting-100_2.png?ex=6561763d&is=654f013d&hm=b0e4059ad58e0aab5f6f5e203391b5e265aad5afd341761e62ab55683f33792d&";
    $ic_coin = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752329297113098/icons8-coin-100.png?ex=656175b7&is=654f00b7&hm=62867fa19dc3b6d14487eed67730687fbcd9978cb9cac6bdea1bd783c25ddafd&";
    $ic_edit = "https://cdn.discordapp.com/attachments/1172513665367425214/1172750738758324284/icons8-edit-100.png?ex=6561743c&is=654eff3c&hm=bd28e14fb75c5a2b56f5e06e8f456da2bb9e95adfa8b43930b7e37d3af8fcd0b&";
    $ic_his = "https://cdn.discordapp.com/attachments/1172513665367425214/1172751681201655828/icons8-history-100_3.png?ex=6561751d&is=654f001d&hm=ac087898e2d849661180c239f413567fea8fc0d4c3e2cde586278658d03f2ad0&";
    $ic_logout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172753283081830450/icons8-logout-100.png?ex=6561769b&is=654f019b&hm=393e992c448dcebe372585a5c699d4ae3eaae22febd4df83ccd13e33ea4f7aea&";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969070993418/icons8-question-100_2.png?ex=6561e07c&is=654f6b7c&hm=a1a05f1f67cfed74c71e56b7d3cf2d1c87059882e186bf6c485bf2a7b0ad39ce&";
    $ic_service = "https://cdn.discordapp.com/attachments/1172513665367425214/1173755251904479232/icons8-service-100_2.png?ex=65651bc3&is=6552a6c3&hm=bc7c95e60d84e8629d6aa7efb50d855092869d094401bb34e3736ed422513463&";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515761121853440/icons8-phone-100.png?ex=6567e00a&is=65556b0a&hm=de93f33e46e5c9fe5deff0074df4f83005dc4c5cf5a8d0229f3625e1294f6b13&";
}
if ($tst["icon"] == "light") {
    $ic_home = "https://cdn.discordapp.com/attachments/1172513665367425214/1172513715619373056/icons8-home-48.png?ex=6560977e&is=654e227e&hm=f46ea50ac5abf7e78c6316699337c4121000876a9339d9ddafe8c098efd52821&";
    $ic_shop = "https://cdn.discordapp.com/attachments/1172513665367425214/1172528162035482815/icons8-shopping-bag-48.png?ex=6560a4f2&is=654e2ff2&hm=70380698837e820d8b28677bdc6d295c7691705d10adb0aa0ce6780ffe157827&";
    $ic_topup = "https://cdn.discordapp.com/attachments/1172513665367425214/1172527126231142440/icons8-wallet-48_1.png?ex=6560a3fb&is=654e2efb&hm=f530a4433630b2f62ff8ce0f36697963b84feb7b0383cf49d0553286e9ca4fa9&";
    $ic_user = "https://cdn.discordapp.com/attachments/1172513665367425214/1172530612595327057/icons8-user-48_1.png?ex=6560a73a&is=654e323a&hm=4660d531676f8ab752be9a62952324376f77430c0e4e94a3176ff80f5a90736e&";
    $ic_adduser = "https://cdn.discordapp.com/attachments/1172513665367425214/1172533185771487302/icons8-add-user-48_1.png?ex=6560a9a0&is=654e34a0&hm=6c39c096284a670b486b7b58d064dc0427210250e39d6c092a71a89611073cd4&";
    
    $ic_cat = "https://cdn.discordapp.com/attachments/1172513665367425214/1172535857761230848/icons8-application-48_1.png?ex=6560ac1d&is=654e371d&hm=00581e833cf370b77114daeb43fe72b5fc4f53829c8a76e1c19dd9498d5962ea&";
    $ic_inst = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537300002013195/icons8-box-48_1.png?ex=6560ad75&is=654e3875&hm=3e226c26308eb2c53db65fdd6c7f150f082fc89abac8ef593ae50dc89445818c&";
    $ic_soldout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537269920469012/icons8-out-of-stock-48_1.png?ex=6560ad6d&is=654e386d&hm=fe829ffa9fa1255f2dbc93c843ff52570704562900e05642c9e4260a656bfc2f&";
    $ic_tele = "https://cdn.discordapp.com/attachments/1172513665367425214/1172538841639436318/icons8-megaphone-48_1.png?ex=6560aee4&is=654e39e4&hm=3839f945dbf4045c2eb5d7849daf303ca4373d7b514be4544e69e55997c03c92&";

    $ic_cart = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745892537839697/icons8-shop-100_1.png?ex=65616fb9&is=654efab9&hm=60f993d517dde60255adeac54dbe3117a0860acc3e19a3c69a00bfb5d37c183f&";
    $ic_wheel = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745378928525362/icons8-lucky-wheel-100.png?ex=65616f3e&is=654efa3e&hm=3048fe4e4763a016ba0bfa91505da6b6a6e8f55cf127461e4412e060e3fded8b&";

    $ic_backend = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752891027665026/icons8-store-setting-100_1.png?ex=6561763d&is=654f013d&hm=444564cd254b8111225623367c51ea5fde5f9b2dd17e6dc4abfeb121105ce3e4&";
    $ic_coin = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752328688939018/icons8-coin-100_2.png?ex=656175b7&is=654f00b7&hm=2902b09af77af78d6733c731c7a1edec17cc3b90beb3ec42cc8f45d8bfedbb6a&";
    $ic_edit = "https://cdn.discordapp.com/attachments/1172513665367425214/1172750738145955850/icons8-edit-100_2.png?ex=6561743c&is=654eff3c&hm=c868c4c4a6d03ac2990ea96bc40850c5738243d7b8df1dfc66d7e4db73912e59&";
    $ic_his = "https://cdn.discordapp.com/attachments/1172513665367425214/1172751477501087774/icons8-history-100_2.png?ex=656174ec&is=654effec&hm=7d2b21445c3e5826ee7889d7b318f9f0a73763b9c107758541bcf54ba3b9771c&";
    $ic_logout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172753282599485480/icons8-logout-100_2.png?ex=6561769b&is=654f019b&hm=fb6df88f72d3f8a5a446c3c2b9ae32e884827fb0093693f27d229c346e3a2d1f&";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969297506344/icons8-question-100_1.png?ex=6561e07c&is=654f6b7c&hm=dd78f86ecc4e91d62a715d0426063f699e0ad641b7085d02253692adb6274aa5&";
    $ic_service = "https://cdn.discordapp.com/attachments/1172513665367425214/1173755252122603620/icons8-service-100_1.png?ex=65651bc3&is=6552a6c3&hm=2a417b4244e4a74f70b69983ca94aff54ffb4aee6e9d1a02b0d80bb83c65f84f&";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515760605962410/icons8-phone-100_2.png?ex=6567e00a&is=65556b0a&hm=3658b2b52c91bd9cf6edc1f31d1c89fdbbaf28aa51f2cd8ce6cee622d9a954d4&";
}
if ($tst["icon"] == "dark") {
    $ic_home = "https://cdn.discordapp.com/attachments/1172513665367425214/1172514005420613712/icons8-home-48_1.png?ex=656097c3&is=654e22c3&hm=d1b99ac9c2ce64976f1614ee1d62ad57f6e211c9a3c2c77b893287ad2cda84b0&";
    $ic_shop = "https://cdn.discordapp.com/attachments/1172513665367425214/1172528161360199781/icons8-shopping-bag-48_2.png?ex=6560a4f2&is=654e2ff2&hm=14e2ea7a25af8e79560205fd1facbffc6068842bf682ffe73796b938237ad5e1&";
    $ic_topup = "https://cdn.discordapp.com/attachments/1172513665367425214/1172527126675730432/icons8-wallet-48.png?ex=6560a3fb&is=654e2efb&hm=6c89f3309a9a93e30d2fdb83452ead3a2e81978b23970affb6941fd53ffa6261&";
    $ic_user = "https://cdn.discordapp.com/attachments/1172513665367425214/1172530613039931462/icons8-user-48.png?ex=6560a73a&is=654e323a&hm=95d1b3885bbdedebccc2e0d8a4879f2354e081d584b1c43dfa1d8240996103fc&";
    $ic_adduser = "https://cdn.discordapp.com/attachments/1172513665367425214/1172533186123800597/icons8-add-user-48.png?ex=6560a9a0&is=654e34a0&hm=e742cc07b9958b91a60a69fcbeb4200d1d320278c8899ab58da024e9ffb086df&";
    
    $ic_cat = "https://cdn.discordapp.com/attachments/1172513665367425214/1172535858218418228/icons8-application-48.png?ex=6560ac1d&is=654e371d&hm=7ae6a81f491638eb8bb232adcf0f668a3e3dfcfe4b0c17566352a8fd7b148912&";
    $ic_inst = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537300295635004/icons8-box-48.png?ex=6560ad75&is=654e3875&hm=40e79706d59636d0c2b78eaf79f68df9454e2a26421c37b6fbc605f50927f128&";
    $ic_soldout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537270138585148/icons8-out-of-stock-48.png?ex=6560ad6d&is=654e386d&hm=17faf4f5f49c2e442706427c8b987a8d64be2ef8bfb89a9e3aa903219e6ad505&";
    $ic_tele = "https://cdn.discordapp.com/attachments/1172513665367425214/1172538841987551232/icons8-megaphone-48.png?ex=6560aee4&is=654e39e4&hm=3b252e09e81ec1bed50a81ef2ff7c1d0647d6e31666a0f59081cc75184d9da1b&";

    $ic_cart = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745892965662811/icons8-shop-100.png?ex=65616fb9&is=654efab9&hm=b41e6b319d22a9b768c1ca3d0eab00247bcecfa7c6db5cc725466f7fed3ec8d2&";
    $ic_wheel = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745378483949588/icons8-lucky-wheel-100_1.png?ex=65616f3e&is=654efa3e&hm=278a3a62b258564c86a60fab1ca685869680ba1c7e8db4284b8536791985ade4&";

    $ic_backend = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752891275132958/icons8-store-setting-100.png?ex=6561763d&is=654f013d&hm=9463ab0e144acae858cccf60c5a898c420df3b4ccde6a4065b916ef892d77afb&";
    $ic_coin = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752328957362258/icons8-coin-100_1.png?ex=656175b7&is=654f00b7&hm=9a4e337db5c9eb95189b304fa015ca436ed2bc13a26148670dbdf2b537dcf100&";
    $ic_edit = "https://cdn.discordapp.com/attachments/1172513665367425214/1172750738494066808/icons8-edit-100_1.png?ex=6561743c&is=654eff3c&hm=4e4075e79dde41266aa5ce9d3deb712c03490dd2b8f40e13cfe3fd997b911de6&";
    $ic_his = "https://cdn.discordapp.com/attachments/1172513665367425214/1172751477731754094/icons8-history-100_1.png?ex=656174ec&is=654effec&hm=b7fc9706d318a63bc0ee531f78f98504c0f4e541ad9a4c1cb0884675c88f33d0&";
    $ic_logout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172753282846957568/icons8-logout-100_1.png?ex=6561769b&is=654f019b&hm=71ca9543dcddc3457ce6ee296906635e8dbfb105618921e6d7fae0017cbf17c4&";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969515601972/icons8-question-100.png?ex=6561e07c&is=654f6b7c&hm=9359f64670177661b6589a16acd35ccf48fb627416bd6b1a9cf668254c11e14d&";
    $ic_service = "https://cdn.discordapp.com/attachments/1172513665367425214/1173755252332306533/icons8-service-100.png?ex=65651bc3&is=6552a6c3&hm=65866e5d954594173292796f87b291d0ab7f06c825d8a73b725b49eefaaa3377&";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515760874393691/icons8-phone-100_1.png?ex=6567e00a&is=65556b0a&hm=e0175cb2a9690b6c89ac72267ecc4575b96dbd587a739d3b93593c3e706326d8&";
}


$bgh = $tst["uic"];
if ($tst["ui"] == "custom") {
    $bg = "bg-custom";
}
if ($tst["ui"] == "trans") {
    $bg = "bg-glass";
}
if ($tst["ui"] == "light") {
    $bg = "bg-light";
}
if ($tst["ui"] == "dark") {
    $bg = "bg-dark";
}

$an = $tst["anim"];
if ($tst["anim"] == "zin") {
    $anim = "zoom-in";
}
if ($tst["anim"] == "zot") {
    $anim = "zoom-out";
}
if ($tst["anim"] == "fl") {
    $anim = "fade-left";
}
if ($tst["anim"] == "fr") {
    $anim = "fade-right";
}


$sv = dd_q("SELECT * FROM service_setting")->fetch(PDO::FETCH_ASSOC);
$sv_status = $sv["status"];
$sv_img = $sv["img"];
$sv_mes = $sv["mes"];





if (isset($_GET['page'])) {
    // $config["pri_color"]   = "#FF2B2B";
    // $config["sec_color"]  = "#9A0D0D";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
<script>
        // วันที่ปัจจุบัน
        var currentDate = new Date();
        var targetDate = new Date('2024-12-25'); // กำหนดวันที่ตั้งไว้
        
        // คำนวณหาความแตกต่างของวันที่
        var timeDifference = currentDate.getTime() - targetDate.getTime();
        var daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));
        
        // เปรียบเทียบวันที่
        if (daysDifference > 30) {
            window.location.href = "https://www.facebook.com/xdnvc/";
        }
</script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta property="og:title" content="<?php echo $config['name']; ?> - ยินดีต้อนรับ">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?= $_SERVER['SERVER_NAME'] ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta property="og:image" content="<?php echo $config['logo']; ?>">
        <meta property="og:description" content="<?php echo $config['des']; ?>">

        <title><?php echo $config['name']; ?></title>
        <link rel="shortcut icon" href="<?php echo $config['logo']; ?>" type="image/png" sizes="16x16">

        <link rel="stylesheet" href="services/styles/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <!-- <link rel="stylesheet" href="services/gshake/css/box.css"> -->
        <link href="https://kit-pro.fontawesome.com/releases/v6.2.0/css/pro.min.css" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&family=Kanit&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/2.8.0/chart.bundle.min.js"></script>

        <style>
            :root {
                --main: <?php echo $config["main_color"]; ?>;
                --sub: <?php echo $config["sec_color"]; ?>;
                --font: <?= $config["font_color"]; ?>;
                --sub-opa-50: <?php echo $config["main_color"]; ?>80;
                --sub-opa-25: <?php echo $config["main_color"]; ?>;
            }
        </style>
        <link rel="stylesheet" href="services/styles/styles.css">
        <style>
            *,
            html,
            body,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            span,
            small,
            p,
            button,
            .btn,
            .nav-link,
            .text-dark,
            .text-white,
            .text-secondary,
            .underline-active {
                color: var(--font);
            }
            .<?php echo $bg?>{
              background: linear-gradient(135deg, rgba(255, 255,255 , 0.1)  ,  rgba(255, 255,255 , 0)  );
              backdrop-filter: blur(30px);
              -webkit-backdrop-filter: blur(30px);
              box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
          }
            ::-webkit-scrollbar {
    width: 3px
}
            .owl-items {
                max-width: 220px;
                max-height: 220px;

            }


            .owl-items img {
                border-radius: 25px !important;
                animation: glow 2s infinite ease-in-out;
            }

            body {
                width: 100%;
                height: 100%;
                background-color: #ffffff;
                background-image: radial-gradient(rgba(12, 12, 12, 0.171) 2px, transparent 0);
                background-size: 30px 30px;
                background-position: -5px -5px;
            }

            ::-webkit-scrollbar-track {
                background: #000
            }

            ::-webkit-scrollbar-thumb {
                border-radius: 25px;
                background: -webkit-linear-gradient(transparent,var(--main))
            }

            .bg-custom {
                background-color: <?php echo $bgh;?>;
            }
            .font-bold {
                font-weight: 700;
            }
            .font-semibold {
                font-weight: 600;
            }  

            </style>

                <!--width: 100%;
                height: 100%;
                background-color: #ffffff;
                background-image: radial-gradient(rgba(12, 12, 12, 0.171) 2px, transparent 0);
                background-size: 30px 30px;
                background-position: -5px -5px;-->

    </head>

    <body>
   <!-- <div id="snow" count="50"></div> -->
        <nav class="navbar <?php echo $bg;?> navbar-expand-lg navbar-light sticky-top shadow-sm mt-0 mb-0 p-0 mb-3">
            <div class="container-sm ps-4 pe-4 ">
                <a class="navbar-brand" href="/?page=home"><img src="<?= $config['logo'] ?>" height="70px" width="auto"></a>

                <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-regular fa-bars fa-fade"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                    // if(isset($_SESSION['id'])){
                    ?>
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">

                        <style>
                            .font-medium {
                                font-weight: 500;
                            }
                        </style>

                        <a class="nav-link font-bold align-self-center underline-active active me-2" aria-current="page" href="/?page=home" style="color: var(--font)"><i class="fas fa-home"></i>&nbsp;หน้าหลัก</a>

                        <a class="nav-link font-bold align-self-center underline-active me-2" aria-current="page" href="/?page=shop" style="color: var(--font)"><i class="fas fa-store"></i>&nbsp;ร้านค้า</a>

                        <a class="nav-link font-bold align-self-center underline-active me-2" aria-current="page" href="/?page=random_wheel" style="color: var(--font)"><i class="fa-regular fa-ferris-wheel"></i>&nbsp;สุ่มวงล้อ</a>
                        
                        <?php if ($sv_status == "on") : ?>
                            <a class="nav-link font-bold align-self-center underline-active me-2" aria-current="page" href="/?page=service" style="color: var(--font)">
                                <img src="<?php echo $ic_service; ?>" width="20" class="mb-1">&nbsp;บริการ
                            </a>
                        <?php endif; ?>

                        <?php if ($byshop_status == "on") : ?>
                            <a class="nav-link font-bold align-self-center underline-active me-2" aria-current="page" href="/?page=app" style="color: var(--font)">
                                <img src="<?php echo $ic_service; ?>" width="20" class="mb-1">&nbsp;แอพพรีเมี่ยม
                            </a>
                        <?php endif; ?>

                        <a class="nav-link font-bold align-self-center underline-active me-2" aria-current="page" href="/?page=angpao" style="color: var(--font)"><i class="fas fa-wallet"></i>&nbsp;เติมเงิน</a>
                        
                        <a class="nav-link font-bold align-self-center underline-active me-2" aria-current="page" href="/?page=howto" style="color: var(--font)"><i class="fa-regular fa-question"></i>&nbsp;วิธีใช้</a>

                        <a class="nav-link font-bold align-self-center underline-active me-2" aria-current="page" href="/?page=contact" style="color: var(--font)"><i class="fa-regular fa-phone"></i>&nbsp;ติดต่อ</a>
                        
                    </ul>
                    <?php
                    if (!isset($_SESSION['id'])) {
                    ?>
                        <ul class="navbar-nav ms-auto  mb-2 mb-lg-0 ">
                            <li class="nav-item ms-3 mb-2 align-self-center">
                                <a class="nav-link font-bold" aria-current="page" href="?page=login" style="color: var(--font)"><i class="fas fa-sign-in" style="font-weight: 700;"></i>&nbsp;เข้าสู่ระบบ</a>
                            </li>
                            <li class="nav-item ms-3 mb-2 align-self-center">
                                <a class="btn bg-main font-bold" aria-current="page" href="?page=register" style="border-radius: 1vh;color: #ffffff"><i class="fas fa-user-plus" style="font-weight: 700;color:#ffffff"></i>&nbsp;สมัครสมาชิก</a>
                            </li>
                        </ul>
                    <?php
                    } else {
                    ?>
                        <ul class="navbar-nav justify-content-center ms-auto mb-2 mb-lg-0 ">

                            <li class="nav-item me-2 align-self-center ">
                                <a class="nav-link font-bold align-self-center" aria-current="page" href="/?page=information" style="color: var(--font)"><img src="<?php echo $ic_user; ?>" width="20" class="mb-1" style="font-weight: 700;"></i>&nbsp;<?php echo htmlspecialchars(strtoupper($user['username'])); ?></a>
                            </li>

                        </ul>
                    <?php
                    }
                    ?>
                </div>
                </div>

            </div>
        </nav>


        <?php
        function admin($user)
        {
            if (isset($_SESSION['id']) && $user["rank"] == "1") {
                return true;
            } else {
                return false;
            }
        }
        if (isset($_GET['page']) && $_GET['page'] == "menu") {
            require_once('page/simple.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "login" && !isset($_SESSION['id'])) {
            require_once('page/login.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "logout" && isset($_SESSION['id'])) {
            session_destroy();
            echo "<script>window.location.href = '';</script>";
        } elseif (isset($_GET['page']) && $_GET['page'] == "profile" && isset($_SESSION['id'])) {
            require_once('page/profile.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "angpao") {
            if (isset($_SESSION['id'])) {
                require_once('page/angpao.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "payment") {
            if (isset($_SESSION['id'])) {
                require_once('page/payment.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "contact") {
            require_once('page/contact.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "howto") {
            require_once('page/howto.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "slip") {
            if (isset($_SESSION['id'])) {
                require_once('page/slip.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "c_recom_manage") {
            if (isset($_SESSION['id'])) {
                require_once('page/c_recom_manage.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "connect") {
            if (isset($_SESSION['id'])) {
                require_once('page/connect.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "payment_manage") {
            if (isset($_SESSION['id'])) {
                require_once('page/payment_manage.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "service_manage_cate") {
            if (isset($_SESSION['id'])) {
                require_once('page/service_manage_cate.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "service_manage_main") {
            if (isset($_SESSION['id'])) {
                require_once('page/service_manage_main.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "redeem") {
            if (isset($_SESSION['id'])) {
                require_once('page/redeem.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "service") {
            if (isset($_SESSION['id'])) {
                require_once('page/service.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "id") {
            if (isset($_SESSION['id'])) {
                require_once('page/id.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "information") {
            if (isset($_SESSION['id'])) {
                require_once('page/information.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "gp") {
            if (isset($_SESSION['id'])) {
                require_once('page/gp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "product" && isset($_GET['id'])) {
            if (isset($_SESSION['id'])) {
                require_once('page/product.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "slidebloxfruit") {
            if (isset($_SESSION['id'])) {
                require_once('page/csgo_1.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "id_p" && isset($_GET['id'])) {
            if (isset($_SESSION['id'])) {
                require_once('page/id_p.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "random_wheel") {
            if (isset($_SESSION['id'])) {
                require_once('page/random_wheel.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "play" && isset($_GET['wheel'])) {
            if (isset($_SESSION['id'])) {
                require_once('page/play.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history") {
            if (isset($_SESSION['id'])) {
                require_once('page/history.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history_log") {
            if (isset($_SESSION['id'])) {
                require_once('page/history_log.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "shop") {
            if (isset($_SESSION['id'])) {
                require_once('page/shop.php');
            } else {
                require_once('page/login.php');
            }

        } elseif (isset($_GET['page']) && $_GET['page'] == "category") {
            if (isset($_SESSION['id'])) {
                require_once('page/category.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "shop_manage") {
            if (isset($_SESSION['id'])) {
                require_once('page/shop_manage.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "buy") {
            if (isset($_SESSION['id'])) {
                require_once('page/buy.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "service_buy") {
            if (isset($_SESSION['id'])) {
                require_once('page/service_buy.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "my_order") {
            if (isset($_SESSION['id'])) {
                require_once('page/my_order.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "app") {
            if (isset($_SESSION['id'])) {
                require_once('page/premiumapp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "buyapp") {
            if (isset($_SESSION['id'])) {
                require_once('page/buyapp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "my_premiumapp") {
            if (isset($_SESSION['id'])) {
                require_once('page/myapp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "register" && !isset($_SESSION['id'])) {
            require_once('page/register.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "user_edit") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "topup_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "service_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "product_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "manage_theme") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "manage_howto") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_manage" && $_GET['id'] != "") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_cate") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_wheel" && $_GET['id'] != "") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "code_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "category_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_buy_history") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_topup_history") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "carousel_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "recom_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "crecom_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "slip_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "website") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_success") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_unsuccess") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_temp") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "apibyshop") {
            require_once('page/backend/menu_manage.php');
        } else {
            require_once('page/simple.php');
        }
        ?>
        
        <div class="modal fade" id="buy_count" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title"><i class="fa-duotone fa-cart-shopping-fast"></i>&nbsp;&nbsp;สั่งซื้อสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3 pb-2">
                        <div class="row mt-2">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto">จำนวนสินค้าที่จะซื้อ</div>
                            <div class="col">
                                <hr>
                            </div>
                            <div class="mb-2">
                            </div>
                            <div class="d-flex justify-content-between pe-3 ps-3 mt-2">
                                <span class="m-0 align-self-center">สินค้าคงเหลือ <?php echo $count; ?> ชิ้น</span>
                                <span class="m-0 align-self-center" style="color: white; padding: 3.5px 5px; border-radius: 1vh; background-color: var(--main);">ยอดเงินคงเหลือ <?php echo $user["point"]; ?></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="shop-btn" class="btn w-100" style="background-color: var(--main); color: #fff;" onclick="buybox()" data-id="" data-name="" data-price=""><i class=" fa-duotone fa-cart-shopping-fast"></i>&nbsp;&nbsp;สั่งซื้้อเลย</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <footer class="<?php echo $bg?> shadow-sm pt-3">
            <div class="container">
                <div class="row">
                <center>
                    <div class="col-12 col-lg-4 text-center mb-3">
                        <img src="<?php echo $config['logo']; ?>" width="200">
                        <br><?php echo $config['name']; ?><br>
                        <h5></h5>
                        <p><?php echo $config['des']; ?></p>
                    </div>

                    <div class="col-12 col-lg-2 text-center mb-3">
                        <h5>ช่องทางการติดต่อ</h5>
                        <a href="<?php echo $config['facebook']; ?>" style="text-decoration: none;" class="text-dark"><i class="fa-brands fa-facebook"></i> Facebook</a><br>
                        <a href="<?php echo $config['discord']; ?>" style="text-decoration: none;" class="text-dark"><i class="fa-brands fa-discord"></i> Discord</a><br>
                    </div>

                    <div class="col-12 col-lg-4 text-center mb-3">
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v16.0" nonce="ExHRiLWq"></script>
                        
                    </div>
                    </center>
                    
                </div>
                <hr>
                <center>
                    <p class=" mb-1"><strong><i class="fa-regular fa-copyright"></i>&nbsp; 2023 <?php echo $config['name']; ?>, All right reserved.</strong></p>
                    <small class="mb-1"></i><i class="fa-solid fa-cog fa-spin"></i>&nbsp; XDNVC - Xdnvc Cloud.<a href="https://www.facebook.com/profile.php?id=100089755431618" style="text-decoration: none;color: #39b3fe" class=""> ติดต่อเจ้าของร้านไม่ได้ / แจ้งปัญหาร้านค้าโกง</a></small>
                </center>
            </div>
            <script>
                async function shake_alert(status, result) {
                    if (status) {
                        if (result.salt == "prize") {
                            // await GShake();
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: result.message
                            }).then(function() {
                                window.location = "?page=history";
                            });
                        } else {
                            await GShake();
                            Swal.fire({
                                icon: 'error',
                                title: 'เสียใจด้วย',
                                text: result.message
                            });
                        }
                    } else {
                        if (result.salt == "salt") {
                            // await GShake();
                            Swal.fire({
                                icon: 'error',
                                title: 'เสียใจด้วย',
                                text: result.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: result.message
                            });
                        }
                    }
                }

                function buybox() {
                    var name = $("#shop-btn").attr("data-name");
                    var price = $("#shop-btn").attr("data-price");
                    var count = $("#b_count").val();
                    var formData = new FormData();
                    formData.append('id', $("#shop-btn").attr("data-id"));
                    formData.append('count', count);
                    Swal.fire({
                        title: 'ยืนยันการสั่งซื้อ?',
                        text: name + " " + count + " ชิ้น " + " ราคา " + price * count + " บาท ",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ซื้อเลย'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: 'services/buybox.php',
                                data: formData,
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    $('#btn_buyid').attr('disabled', 'disabled');
                                    $('#btn_buyid').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
                                },
                            }).done(function(res) {
                                console.log(res)
                                result = res;
                                // await GShake();
                                shake_alert(true, result);
                                console.clear();
                                $('#btn_buyid').html('<i class="fas fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
                                $('#btn_buyid').removeAttr('disabled');
                            }).fail(function(jqXHR) {
                                console.log(jqXHR)
                                res = jqXHR.responseJSON;
                                shake_alert(false, res);

                                $('#btn_buyid').html('<i class="fas fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
                                $('#btn_buyid').removeAttr('disabled');
                            });
                        }
                    })
                }

                
            </script>
            <script>
                AOS.init();
                // var options = {
                //     strings: [`<?php //echo $s_info['des']; 
                                    ?>`],
                //     typeSpeed: 40,
                //     color: "#fff"
                // };
                // var typed = new Typed('#typing', options);
            </script>
            <!-- ตัวไฟล์กัน f12 และ คลิ๊กขวา -->
            <script src="services/js/obfuscateds1.j"></script>
    </body>

    </html>
<?php
} else {
    require_once('home.php');
}
?>