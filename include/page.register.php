<?php
include("include/alert.member.php");
if(isset($_SESSION["username"])){
    error("คุณได้เข้าสู่ระบบแล้ว","?page=profile");
}else{
echo '
<div class="lp-panel"><i class="fa fa-users"></i>&nbsp;สมัครสมาชิก
<hr style="background: white;">
<form method="post" action="?page=register&act=register">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-envelope-o"></i>&nbsp;อีเมล&nbsp;:&nbsp;</span>
  </div>
<input type="email" name="email" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-user"></i>&nbsp;ชื่อผู้ใช้งาน&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="username" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-lock"></i>&nbsp;รหัสผ่าน&nbsp;:&nbsp;</span>
  </div>
<input type="password" name="password" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-lock"></i>&nbsp;ยืนยันรหัสผ่าน&nbsp;:&nbsp;</span>
  </div>
<input type="password" name="password2" class="form-control form-control-lg lp-input">
</div>
<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;สมัครสมาชิก</button>
</form>
</div>
';
if(isset($_GET["act"])) :
    if($_GET["act"]=="register") :
        if(empty($_POST["username"])){
            error("กรุณากรอกชื่อผู้ใช้งาน","?page=register");
            exit();
        }
        if(empty($_POST["email"])){
            error("กรุณากรอกอีเมล","?page=register");
            exit();
        }
        if(empty($_POST["password"])){
            error("กรุณากรอกรหัสผ่าน","?page=register");
            exit();
        }
        if(empty($_POST["password2"])){
            error("กรุณากรอกรหัสผ่าน","?page=register");
            exit();
        }
        if($_POST["password"]!=$_POST["password2"]){
            error("รหัสผ่านไม่ตรงกัน","?page=register");
            exit();
        }
		$query = query("SELECT * FROM authme WHERE username = ?",array($_POST["username"]));
		$data = $query->fetch();
		if($data!=null){
			error("มีผู้ใช้งานนี้แล้วครับ", "index.php");
			exit();
		}else{
		
        $password = AuthMeSha256($_POST["password"]);
        $query = $engine->prepare("INSERT INTO authme (username,password) VALUES (:username,:password)");
        $query->bindparam(":username",$_POST["username"],PDO::PARAM_STR);
        $query->bindparam(":password",$password,PDO::PARAM_STR);
if($query->execute()){
    success("สมัครสมาชิกแล้วครับ", "index.php");
    $_SESSION["username"] = $_POST["username"];
    exit();
}
		}
        
        
    endif;
endif;

}

