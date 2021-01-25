<?php
$rate_true = "2";
$rate_wallet = "2";

session_start();
require_once("class.wallet.php");
error_reporting();
include('function_main.php');
$ConfigiSite = new Lolipop_Config();
$Config = $ConfigiSite->Config();
include("../config.php");
include("database.php");



    if (isset($_GET["truewallet"])) {

$have = query("SELECT * FROM wallet_logs WHERE tran = ?",array($_POST["cashcard"]));	
$have_data = $have->fetch();
if($have_data){
	$request = array('status' => '0', 'txt' => 'หมายเลขอ้างอิงนี้ถูกใช้ไปแล้ว');
	$json = json_encode($request);
    echo $json;
    exit();
}

$token = new TrueWallet($wallet['email'], $wallet['pass'], $wallet['token']);
$access_token = $token->access_token;
$token->Login();

$transactions = $token->getTransaction(3); // ดึงมา 10 รายการจาก 30 วัน



foreach ($transactions["data"]["activities"] as $report) {
	
if ($full_last_report = $token->GetTransactionReport($report['report_id'])) {
 

$code = $full_last_report["data"]["service_code"];

 if ($code == 'creditor') {
$f_amount = $full_last_report["data"]['section3']['column1']['cell1']['value'];
$f_time = $full_last_report["data"]['section4']['column1']['cell1']['value'];
$f_tran = $full_last_report["data"]['section4']['column2']['cell1']['value'];

 

 if ($f_tran == $_POST['cashcard']) {
                            $i_tran = $f_tran;
                            $i_amount = $f_amount;
                            break;
}
}
}

}

if (empty($i_tran)) {
	$request = array('status' => '0', 'txt' => 'ไม่พบหมายเลขอ้างอิงนี้');
	$json = json_encode($request);
    echo $json;
	exit();
                } else {
                    if ($i_tran == $_POST['cashcard']) {
						$am =  str_replace(",","",$i_amount);
						$plus = intval($am)*$rate_wallet;
                        $acc = query("UPDATE authme SET point = point+?, topup = topup+? WHERE username = ?",array($plus,$am,$_SESSION["username"]));
                       $logs_insert = query('INSERT INTO wallet_logs (tran,price,user,time) VALUES (?,?,?,?)',array($_POST['cashcard'],$am,$_SESSION["username"],time()));

                        if ($logs_insert) {
							$request = array('status' => '1', 'txt' => "เติมเงินสำเร็จ จำนวน : ".$i_amount." บาท!");
	$json = json_encode($request);
    echo $json;
                            exit();
                        }
                    } else {
                        $request = array('status' => '0', 'txt' => 'ไม่พบหมายเลขอ้างอิงนี้');
	$json = json_encode($request);
    echo $json;
	exit();
                    }
                }

									
    }elseif(isset($_GET["truemoney"])) {
            if (!empty($_POST['cashcard'])) {


$token = new TrueWallet($wallet['email'], $wallet['pass'], $wallet['token']);
$access_token = $token->access_token;
$token->Login();

    if ($token !== NULL) {
        $tm = $token->TopupCashcard($_POST['cashcard']);
        @$tx = $tm['transactionId'];
        if ($tx !== false && $tx !== null) {
            // $tm['amount'] <-- จำนวนเงิน
           $getnumber = intval($tm['amount']);
            if($rate_wallet<=1){
                switch($getnumber){
                    case "50": $money = $Config["topup"]["50"]; break;
                    case "90": $money = $Config["topup"]["90"]; break;
                    case "150": $money = $Config["topup"]["150"]; break;
                    case "300": $money = $Config["topup"]["300"]; break;
                    case "500": $money = $Config["topup"]["500"]; break;
                    case "1000": $money = $Config["topup"]["1000"]; break;
                   default: $money = $tm['amount'];
                }
            }else{
                switch($getnumber){
                    case "50": $money = $Config["topup"]["50"]*$rate_wallet; break;
                    case "90": $money = $Config["topup"]["90"]*$rate_wallet; break;
                    case "150": $money = $Config["topup"]["150"]*$rate_wallet; break;
                    case "300": $money = $Config["topup"]["300"]*$rate_wallet; break;
                    case "500": $money = $Config["topup"]["500"]*$rate_wallet; break;
                    case "1000": $money = $Config["topup"]["1000"]*$rate_wallet; break;
                   default: $money = $tm['amount'];
                }
            }
			$acc = query("UPDATE authme SET point = point+?, topup = topup+? WHERE username = ?",array($money,$getnumber,$_SESSION["username"]));
                       $query_insert_logs = query('INSERT INTO site_logs (tran,username,price,type,date,time) VALUES ("' . $_POST['cashcard'] . '","' . $_SESSION["username"] . '","' . $getnumber . '","Truemoney","' . date('d-m-Y') . '","' . date('H:i:s') . '")');
            if($query_insert_logs){
			$request = array('status' => '1', 'txt' => 'เติมเงินสำเร็จ (จำนวนเงิน '.$money.' บาท)');
        $json = json_encode($request);
        echo $json;
			}
        }else{
        $request = array('status' => '0', 'txt' => 'รหัสบัตรเงินสดไม่ถูกต้อง');
        $json = json_encode($request);
        echo $json;
        }
        $token->Logout();
    }
}else{
    $request = array('status' => '0', 'txt' => 'โปรดกรอกข้อมูลให้ถูกต้องและครบถ้วน');
        $json = json_encode($request);
        echo $json;
		
    }
        
    }else{

        echo 'KUAY';
        exit();
    }