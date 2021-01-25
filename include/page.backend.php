<?php
include("include/alert.backend.php");
if ($player["rank"] != "admin") {
    error("คุณไม่มีสิทธิ์ดูหน้านี้ :(","index.php");
} else {
    if (isset($_GET["delserver"])) {
        $query = query("DELETE FROM site_server WHERE id = {$_GET["delserver"]}");
        if ($query) {
            success("ลบเซิร์ฟเวอร์แล้วคับ", "?page=backend&menu=server");
            exit();
        }
        exit();
    }
    if (isset($_GET["action"])) {
        if ($_POST["action"] == "save_server") {
            if (empty($_POST["ip"])) {
                error("กรุณากรอก 'IP' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["port"])) {
                error("กรุณากรอก 'PORT' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["pass"])) {
                error("กรุณากรอก 'PASSWORD' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            $ConfigiSite->UpdateConfig("minecraft","ip",$_POST["ip"]);
            $ConfigiSite->UpdateConfig("minecraft","port",$_POST["port"]);
            $ConfigiSite->UpdateConfig("minecraft","pass",$_POST["pass"]);
            success("บันทึกข้อมูลแล้วครับ","?page=backend&menu=server");
            exit();
        }
        if ($_POST["action"] == "add_server") {
            if (empty($_POST["name"])) {
                error("กรุณากรอก 'ชื่อเซิร์ฟเวอร์' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["ip"])) {
                error("กรุณากรอก 'IP' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["port"])) {
                error("กรุณากรอก 'PORT' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["pass"])) {
                error("กรุณากรอก 'PASSWORD' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            $query = query("INSERT INTO site_server (name,ip_rcon,port_rcon,password_rcon,info) VALUES (:name,:ip,:port,:pass,:info)",array(":name" => $_POST["name"],":ip" => $_POST["ip"],":port" => $_POST["port"],":pass" => $_POST["pass"],":info" => "SERVER BUNGEE"));
            if ($query) {
                success("เพิ่มเซิร์ฟเวอร์แล้วครับ :D", "?page=backend&menu=server");
                exit();
            }
            exit();
        }

        if ($_POST["action"] == "save_serverbungee") {
            if (empty($_POST["name"])) {
                error("กรุณากรอก 'ชื่อเซิร์ฟเวอร์' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["ip"])) {
                error("กรุณากรอก 'IP' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["port"])) {
                error("กรุณากรอก 'PORT' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            if (empty($_POST["pass"])) {
                error("กรุณากรอก 'PASSWORD' ด้วยครับ","?page=backend&menu=server");
                exit();
            }
            $query = query("UPDATE site_server SET name = :name, ip_rcon = :ip, port_rcon = :port, password_rcon = :pass WHERE id = :id",array(":name" => $_POST["name"],":ip" => $_POST["ip"],":port" => $_POST["port"],":pass" => $_POST["pass"],":id" => $_POST["id"]));
            if ($query) {
                success("แก้ไขเซิร์ฟเวอร์แล้วครับ :D", "?page=backend&menu=server");
                exit();
            }
            exit();
        }

        if ($_POST["action"] == "add_item") {
            $cmd = array();
            foreach ($_POST["cmd"] as $id => $datacmd) {
                if ($datacmd != "") {
                    $cmd[] = $datacmd;
                }
            }
            if (count($cmd) == 0) {
                error("กรุณากรอกคำสั่งอย่างน้อย 1 คำสั่ง","?page=backend&menu=item");
                exit();
            }
            if (empty($_POST["name"])) {
                error("กรุณากรอกชื่อสินค้า","?page=backend&menu=item");
                exit();
            }

            $query = query("INSERT INTO site_shop (server,name,cmd,price,image,info) VALUES (:server,:name,:cmd,:price,:image,:info)",array(":server"=> $_POST["server"],":name" => $_POST["name"],":cmd" => json_encode($cmd,JSON_UNESCAPED_UNICODE),":price" => $_POST["price"],":image" => $_POST["url"],":info" => $_POST["info"]));
            success("เพิ่มสินค้าแล้ว","?page=backend&menu=item");
            exit();
        }

        if ($_POST["action"] == "save_discord") {
            if (empty($_POST["url"])) {
                error("กรุณากรอก URL","?page=backend&menu=dashboard");
                exit();
            }
            $ConfigiSite->UpdateConfig("discord","url",$_POST["url"]);
            success("บันทึก URL แล้วครับ","?page=backend&menu=dashboard");
            exit();
        }


        // END OF SYSTEM

    }
    if (empty($_GET["menu"])) {
        include('include/backend.dashboard.php');
    } else {
        switch ($_GET["menu"]) {
            case "": include('include/backend.dashboard.php');
                break;
            case "player": include('include/backend.player.php');
                break;
            case "server": include('include/backend.server.php');
                break;
            case "item": include('include/backend.item.php');
                break;
            case "topup": include('include/backend.topup.php');
                break;
            case "random": include('include/backend.random.php');
                break;
            case "news": include('include/backend.news.php');
                break;
            case "ui": include('include/backend.ui.php');
                break;
            default : include('include/backend.dashboard.php');
                break;
        }
    }
}