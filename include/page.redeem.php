<?php

include("include/alert.member.php");
echo '
<div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-barcode"></i>&nbsp;ระบบเติมโค๊ต
</div><div class="card-body">

<form method="post" action="?page=redeem&redeem">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-barcode"></i>&nbsp;โค๊ต&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="code" class="form-control form-control-lg lp-input">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;ยืนยันและเติมโค๊ต</button>

</form>
</div></div>
';

function UpdateRedeem($code, $username) {
    $query = query("UPDATE site_redeem SET claim = :username WHERE code = :code", array(":username" => $username, ":code" => $code));
    return true;
}

function UpdatePoint($point, $username) {
    $query = query("UPDATE authme SET point = point+:point WHERE username = :username", array(":point" => $point, ":username" => $username));
    return true;
}

if (isset($_GET["redeem"])) {
    if (empty($_POST["code"])) {
        error("กรุณากรอก Redeem Code", "?page=redeem");
        exit();
    }
    $query = $engine->prepare("SELECT * FROM site_redeem WHERE code = :code");
    $query->bindparam(":code", $_POST["code"], PDO::PARAM_STR);
    $query->execute();
    $data = $query->fetch();
    if ($data["claim"] != NULL) {
        error("Code นี้ถูกใช้ไปแล้วโดย : {$data["claim"]}", "?page=redeem");
        exit();
    } else {
        if ($data["type"] == "command") {

            $Command = array();
            foreach (json_decode($data["cmd"]) as $DataID => $DataValue) {
                $Command[] = str_replace("<p>", $player['username'], $DataValue);
            }
            if ($Config["bungeecord"]["status"] == "on") {
                $ServerData = $engine->prepare("SELECT * FROM site_server WHERE name = :name");
                $ServerData->bindparam(":name", $data["server"], PDO::PARAM_STR);
                $ServerData->execute();
                $ServerDatas = $ServerData->fetch();
                $RconSetting = array("ip" => $ServerDatas["ip_rcon"], "rcon_port" => $ServerDatas["port_rcon"], "rcon_password" => $ServerDatas["password_rcon"]);
                $ServerRCON = ServerRCON($Command, $RconSetting);
                if ($ServerRCON) {
                    if (UpdateRedeem($_POST["code"], $_SESSION["username"])) {
                        success("ใช้ Code เรียบร้อยแล้วคับ", "?page=redeem");
                        exit();
                    } else {
                        error("มีบางอย่างผิดปกติ", "?page=redeem");
                        exit();
                    }
                }
            } else {
                $ServerRCON = ServerRCON($Command);
                if ($ServerRCON) {
                    if (UpdateRedeem($_POST["code"], $_SESSION["username"])) {
                        success("ใช้ Code เรียบร้อยแล้วคับ", "?page=redeem");
                        exit();
                    } else {
                        error("มีบางอย่างผิดปกติ", "?page=redeem");
                        exit();
                    }
                }
            }
        } elseif ($data["type"] == "point") {
            if (UpdateRedeem($_POST["code"], $_SESSION["username"])) {
            if (UpdatePoint($data["point"], $_SESSION["username"])) {
                success("ใช้ Code เรียบร้อยแล้วคับ", "?page=redeem");
                exit();
            } else {
                error("มีบางอย่างผิดปกติ", "?page=redeem");
                exit();
            }
            }
        } else {
            error("ไม่พบ Redeem Code นี้ในระบบ", "?page=redeem");
            exit();
        }
    }
}

/*
$NewDataValue = array();
foreach ($_POST["code"] as $DataID =>$DataValue) {
if ($DataValue != "") {
$NewDataValue[] = $DataValue;
}
}
var_dump($NewDataValue);
$query = query("INSERT INTO site_redeem (code,type,cmd) VALUES ('test','command','".json_encode($NewDataValue,JSON_UNESCAPED_UNICODE)."')");
if($query){
    echo 'YESS';
}*/