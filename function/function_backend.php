<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include('function_main.php');
$ConfigiSite = new Lolipop_Config();
$Config = $ConfigiSite->Config();
if(isset($_GET["act"])){
    if($_GET["act"]=="discord"){
        if($_POST["status"]==1){
            $ConfigiSite->UpdateConfig("discord","status","on");
                echo json_encode(array("status"=>1));
                exit();
        }else{
            $ConfigiSite->UpdateConfig("discord","status","off");
                echo json_encode(array("status"=>0));
                exit();
        }
    }
    if($_GET["act"]=="bungeecord"){
         if($_POST["status"]==1){
            $ConfigiSite->UpdateConfig("bungeecord","status","on");
                echo json_encode(array("status"=>1));
                exit();
        }else{
            $ConfigiSite->UpdateConfig("bungeecord","status","off");
                echo json_encode(array("status"=>0));
                exit();
        }
    }
    if($_GET["act"]=="x2"){
         if($_POST["status"]==1){
            $ConfigiSite->UpdateConfig("topupx2","status","on");
                echo json_encode(array("status"=>1));
                exit();
        }else{
            $ConfigiSite->UpdateConfig("topupx2","status","off");
                echo json_encode(array("status"=>0));
                exit();
        }
    }
}