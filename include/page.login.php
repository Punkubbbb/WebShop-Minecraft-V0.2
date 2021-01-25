<?php
if(isset($_SESSION["username"])){
    include("include/alert.member.php");
    error("คุณได้เข้าสู่ระบบแล้ว","?page=profile");
}else{
echo '
<div class="lp-panel"><i class="fa fa-user"></i>&nbsp;เข้าสู่ระบบ
<hr style="background: white;">
<form action="?login" method="post">
		
		<div class="input-group mb-3" style="width: 100%">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
  </div>
  <input type="text" class="form-control lp-input" name="username" placeholder="ชื่อตัวละคร">
</div>

<div class="input-group mb-3" style="width: 100%">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
  </div>
  <input type="password" class="form-control lp-input" name="password" placeholder="รหัสผ่าน">
</div>

<button type="submit" class="btn btn-success btn-block btn-lp" name="type" value="login"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</button>


	</form>
</div>

';
}