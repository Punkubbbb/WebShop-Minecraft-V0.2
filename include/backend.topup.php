<?php

if(isset($_GET["profile"])){
	
	$ConfigiSite->UpdateConfig("wallet","email",$_POST["email"]);
	$ConfigiSite->UpdateConfig("wallet","password",$_POST["password"]);
	$ConfigiSite->UpdateConfig("wallet","phone",$_POST["phone"]);
	$query = query("UPDATE config SET choice = :choice WHERE id = 1",array(":choice"=>$_POST["tmn"]));
	success("บันทึกแล้วครับ","?page=backend&menu=topup");
}
echo '
<div class="lp-panel" style="margin-top: 10px;border: solid 1px #d8d8d8;"><i class="fa fa-user"></i>&nbsp;ตั้งค่าบัญชี
<hr style="background: white;">

<form method="post" action="?page=backend&menu=topup&profile">

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-envelope-o"></i>&nbsp;อีเมล์&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="email" class="form-control form-control-lg lp-input" value="'.$Config["wallet"]["email"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-lock"></i>&nbsp;รหัสผ่าน&nbsp;:&nbsp;</span>
  </div>
<input type="password" name="password" class="form-control form-control-lg lp-input" value="'.$Config["wallet"]["password"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-phone"></i>&nbsp;เบอร์มือถือ&nbsp;:&nbsp;</span>
  </div>
<input type="pass" name="phone" class="form-control form-control-lg lp-input" value="'.$Config["wallet"]["phone"].'">
</div>

<i class="fa fa-cogs"></i>&nbsp;แรทการเติมเงิน
<hr style="background: white;">

<div class="input-group mb-3">
  <div class="input-group-prepend">
  ';
  $query = query("SELECT * FROM config WHERE config = 'true'");
  $data = $query->fetch();
  echo '
    <span class="input-group-text lp-title-input"><i class="fa fa-credit-card"></i>&nbsp;บัตรเงินสดทรูมันนี่&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="tmn" class="form-control form-control-lg lp-input" value="'.$data["choice"].'">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>


</from>

</div>
';?>
