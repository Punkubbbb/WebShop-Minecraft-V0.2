<?php
session_start();
error_reporting(0);
include('function/function_main.php');
include('config.php');
$ConfigiSite = new Lolipop_Config();
$Config = $ConfigiSite->Config();
include('function/database.php');
if (isset($_SESSION["username"])):
    $query = $engine->prepare("SELECT * FROM authme WHERE username = :username");
    $query->bindparam(":username", $_SESSION["username"], PDO::PARAM_STR);
    $query->execute();
    $player = $query->fetch();
endif;
if (isset($_GET["buyitem"])) {
    if (empty($_SESSION["username"])) {
        $array = array("status" => 0, "txt" => "กรุณาเข้าสู่ระบบ!");
        echo json_encode($array);
        exit();
    } else {
        if ($Config["bungeecord"]["status"] == "on") {
            $query = $engine->prepare("SELECT * FROM site_server WHERE name = :name");
            $query->bindparam(":name", $_POST["server"], PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch();
            if ($data) {
                $query = $engine->prepare("SELECT * FROM site_shop WHERE id = :id");
                $query->bindparam(":id", $_POST["id"], PDO::PARAM_STR);
                $query->execute();
                $datai = $query->fetch();
                if ($player["point"] < $datai["price"]) {
                    $array = array("status" => 0, "txt" => "พ้อยท์ของคุณไม่เพียงพอ กรุณาเติมเงิน :D");
                    echo json_encode($array);
                    exit();
                } else {
                    $Command = array();
                    foreach (json_decode($datai["cmd"]) as $DataID => $DataValue) {
                        $Command[] = str_replace("<p>", $player['username'], $DataValue);
                    }
                    $query = query("UPDATE authme SET point = point-:point WHERE username = :username", array(":point" => $datai["price"], ":username" => $_SESSION["username"]));
                    if ($query) :
                        $RconSetting = array("ip" => $data["ip_rcon"], "rcon_port" => $data["port_rcon"], "rcon_password" => $data["password_rcon"]);
                        $ServerRCON = ServerRCON($Command, $RconSetting);
                        if ($ServerRCON) {
                            $array = array("status" => 1, "txt" => "ซื้อสินค้าแล้วครับ ขอบคุณที่ใช้บริการ :)");
                            echo json_encode($array);
                            exit();
                        }
                    endif;
                }
            }
        } else {
           
           
            $query = $engine->prepare("SELECT * FROM site_shop WHERE id = :id");
            $query->bindparam(":id", $_POST["id"], PDO::PARAM_STR);
            $query->execute();
            $datai = $query->fetch();
            
             $Command = array();
            foreach (json_decode($datai["cmd"]) as $DataID => $DataValue) {
                $Command[] = str_replace("<p>", $player['username'], $DataValue);
            }

            
            if ($player["point"] < $datai["price"]) {
                $array = array("status" => 0, "txt" => "พ้อยท์ของคุณไม่เพียงพอ กรุณาเติมเงิน :D");
                echo json_encode($array);
                exit();
            } else {
                 $query = query("UPDATE authme SET point = point-:point WHERE username = :username", array(":point" => $datai["price"], ":username" => $_SESSION["username"]));
                if ($query) {
                    $ServerRCON = ServerRCON($Command);
                    if ($ServerRCON) {
                        $array = array("status" => 1, "txt" => "ซื้อสินค้าสำเร็จ! ขอให้สนุกกับเซิร์ฟเวอร์ของเรา");
                        echo json_encode($array);
                        exit();
                    }
                }
            }
        }
    }
}
if (isset($_GET["getinfo"])) {
    $query = $engine->prepare("SELECT * FROM site_shop WHERE id = :id");
    $query->bindparam(":id", $_GET["getinfo"], PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    if (empty($_SESSION["username"])) {
        $array = array("name" => $data["name"], "info" => $data["info"], "price" => $data["price"], "count" => $data["count"], "buycount" => $data["buycount"], "image" => $data["image"], "user_point" => "กรุณาเข้าสู่ระบบ");
    } else {
        $array = array("name" => $data["name"], "info" => $data["info"], "price" => $data["price"], "count" => $data["count"], "buycount" => $data["buycount"], "image" => $data["image"], "user_point" => $player["point"]);
    }
    echo json_encode($array);
    exit();
}
if(isset($_GET["getbox"])){
    include("function/function_box.php");
}
if(isset($_GET["openbox"])){
    include("function/function_box.php");
}
if (isset($_GET["buy"])) {
    include("function/function_shop.php");
}
include('function/function_member.php');

echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>';
echo $Config['site']['tagname'];
echo '</title>
    <link href="dist/bootstrap.css" rel="stylesheet">
    <link href="dist/font-awesome.css" rel="stylesheet">
    <link href="dist/sa.css" rel="stylesheet">
    <link href="dist/lt.css" rel="stylesheet">
    <link rel="icon" type="image/favicon.ico" href="' . $Config['site']['logo'] . '" />
    <link rel="shortcut icon" href="favicon.ico" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.css"/>
 

<script src="dist/jquery-3.4.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
    <script src="dist/bootstrap.js"></script>
    <script src="dist/sa.js"></script>
</head>
<style>
@import url("https://fonts.googleapis.com/css?family=Kanit");
.webshop{
  width:1100px;
  margin:auto;
}
body,td,th {
font-family: "Kanit", sans-serif;
font-size: 15px;
}
body
{
  background: ' . $Config['site']['background'] . ' no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.alertt {
background-color: rgba('.$Config["color"]["alert"].');
}
.btn-lp {
border-radius: 0px;
}
.lp-panel {
color: '.$Config["color"]["panel_font"].';
font-size: 18px;
background: rgba('.$Config["color"]["panel"].');
padding: 20px;
}
.lp-menu {
padding: 11px;
font-size: 17px;
border-bottom: 1px solid white;
text-decoration: none !important;
color: '.$Config["color"]["menu_font"].';
transition-duration: 0.3s;
background: rgba('.$Config["color"]["menu"].')
}
.lp-menu:hover {
border-left: 6.5px solid transparent;
color: '.$Config["color"]["menu_hover_font"].';
background: rgba('.$Config["color"]["menu_hover"].')
}
.lp-title-input {
color: '.$Config["color"]["input_titie_font"].';
background: rgba('.$Config["color"]["input_titie"].');
border: 0px;
border-radius: 0px;
}
.lp-input {
font-size:16px;
background: rgba('.$Config["color"]["input"].');
border-radius: 0px;
color: '.$Config["color"]["input_color"].';
}
.lp-input:disabled {
background: rgba('.$Config["color"]["input_disabled"].');
}
.modal-content
 {
 border-radius: 0px;
 border: solid 1px white;
     padding:9px 15px;
     background-color: rgba('.$Config["color"]["modal"].');
 }
 .lp-card {
color: '.$Config["color"]["panel_font"].';
background: rgba('.$Config["color"]["panel"].');
}

</style>
<body>';
include('include/temp.navbar.php');
include('include/fb.php');
echo '

  <div class="container" align="center" style="margin-top: 25px;color: white">

 <img class="animation" style="width: 40%;" src="' . $Config['site']['logo'] . '">

<p style="font-size: 35px;">' . $Config['site']['tagname'] . '</p>
<p style="font-size: 25px;">HarperCraft WebShop แก้ไข้ได้ที่ไฟล์ index บรรทัดที่ 239</p>
  </div>
<br>



<div class="webshop" style="position: relative;">
<div style="background-color:rgb(255,0,255,0);padding: 18px;color: #3399FF; -webkit-box-shadow: 0px 5px 30px -5px #000000;
  -moz-box-shadow: 0px 5px 30px -5px #000000;
    box-shadow: 0px 5px 30px -5px #000000;">

<div class="input-group md-6" style="padding:3px;border-radius:0px 0px 4px 4px;">
<div class="input-group-prepend">
<span class="slash bg-danger card-header" style="color: white;">ประกาศ </span>
</div>
                            <marquee class="form-control form-control-lg lp-input" onmouseout="this.start()" onmouseover="this.stop()">
                            HarperCraft เซิร์ฟเวอร์ดีที่สุดในจักวาล!                     </marquee>
                        </div>
                        
<div class="row">
<div class="col-4">
';
include('include/temp.left.php');
echo '
</div>
<div class="col-8">
';

if (empty($_GET["page"])) {
	    include('include/temp.right.php');
} else {
    switch ($_GET["page"]) {
        case "": include('include/temp.right.php');
            break;
        case "topup": include('include/page.topup.php');
            break;
        case "shop": include('include/page.shop.php');
            break;
        case "login": include('include/page.login.php');
            break;
        case "register": include('include/page.register.php');
            break;
        case "profile": include('include/page.profile.php');
            break;
        case "logs": include('include/page.logs.php');
            break;
        case "redeem": include('include/page.redeem.php');
            break;
        case "random": include('include/page.random.php');
            break;
        case "backend": include('include/page.backend.php');
            break;

        default : include('include/temp.right');
            break;
    }
}
echo '
</div>

</div>';
echo '</div></div>


';
echo '
<div style="border-top:2px solid #FFFF;background: rgba(0, 0, 0, 0)!important;margin-top: 100px;">
      <div style="padding: 30px 250px;" class="">
        <div class="row">
          <div class="col-6">
            <div style="color:#FFFF; margin-bottom:0px;nax-width:100%;">
                   <p style="text-indent: 30px;">
ยินดีต้อนรับเข้าสู่เซิร์ฟเวอร์ HarperCraft.Net แก้ได้ที่ไฟล์ index บรรทัดที่ 311
                   </p>
            </div>
			
			<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text bg-dark" style="color: white;">IP : </span>
  </div>
  <input type="text" class="form-control form-control-lg" onclick="this.select()" readonly="" style="text-align:center;" value="แก้ได้ที่ไฟล์ index บรรทัดที่ 319">
  <div class="input-group-append">
    <span class="input-group-text bg-dark" style="color: white;">เวอร์ชัน 1.8.x - 1.13 แก้ได้ที่ไฟล์ index บรรทัดที่ 321</span>
  </div>
</div>
			
          </div>
          <div class="col-6">
		  
<iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/'.$fanpage.'&amp;tabs&amp;width=500&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId=" height="215" style="border:none;overflow:hidden;max-width:100%;width:100%" scrolling="yes" frameborder="0" allowtransparency="true"></iframe>
          
		  </div>
        </div>
      </div>

<div style="background-color: #2f3133!important;padding:8px;color: white; text-align:center;margin-top: 40px;">
    <small style="font-size:14px;">Design & System By <a href="https://www.facebook.com/systemminecraft" style="color:#FFF;text-decoration:underline;">Minecraft SyStem</a></small>
</div>  

</div>
</body>';
