<?php
include("include/alert.member.php");  
echo '

<div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-envelope"></i>&nbsp;แก้ไขอีเมล
</div><div class="card-body">

	 <form method="post" action="?page=profile&act=save" id="form_save_email">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-envelope-o"></i>&nbsp;</span>
  </div>
<input type="email" name="email" class="form-control form-control-lg lp-input" value="';
if ($player["email"] == null) {
    echo 'กรุณาตั้งอีเมลก่อนคัฟ';
} else {
    echo $player["email"];
}echo '">
</div>
<button type="button" class="btn btn-outline-success" id="save_email"><i class="fa fa-check"></i>&nbsp;ยันยันและบันทึกอีเมล</button>
</form>
</div></div>
';
echo '

<div class="card" style="margin-top: 15px;">
<div class="card-header slash bg-info" style="color: white;"><i class="fa fa-lock"></i>&nbsp;เปลี่ยนรหัสผ่าน
</div><div class="card-body">

<form method="post" action="?page=profile&act=changepass" id="form_change_pass">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">รหัสผ่านปัจจุบัน&nbsp;:&nbsp;</span>
  </div>
<input type="password" name="oldpass" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">รหัสผ่านใหม่&nbsp;:&nbsp;</span>
  </div>
<input type="password" name="newpass" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">ยืนยันรหัสผ่านใหม่&nbsp;:&nbsp;</span>
  </div>
<input type="password" name="newpass2" class="form-control form-control-lg lp-input">
</div>

<button type="button" class="btn btn-outline-success" id="change_pass"><i class="fa fa-check"></i>&nbsp;ยันยันและเปลี่ยนรหัสผ่าน</button>
</form>
</div></div></div>';


if (isset($_GET['act'])) :
    if ($_GET['act'] == "save") :
        if($_POST["email"] == "กรุณาตั้งอีเมลก่อนคัฟ"){
            error("กรุณาเปลี่ยนอีเมลให้ถูกต้องครับ \'กรุณาตั้งอีเมลก่อนคัฟ\' ","?page=profile");
            exit();
        }
$query = $engine->prepare("UPDATE authme SET email = :email WHERE username = :username");
$query->bindparam(":email",$_POST["email"],PDO::PARAM_STR);
$query->bindparam(":username",$_SESSION["username"],PDO::PARAM_STR);
if($query->execute()){
    success("เปลี่ยนอีเมลแล้วครับ \'".$_POST["email"]."\'","?page=profile");
}
    endif;
    
    if ($_GET['act'] == "changepass") :
       if(empty($_POST["oldpass"])){
            error("กรุณากรอกรหัสผ่านปัจจุบัน","?page=profile");
            exit();
       }
       if(empty($_POST["newpass"])){
            error("กรุณากรอกรหัสผ่านใหม่","?page=profile");
            exit();
       }
       if(empty($_POST["newpass2"])){
            error("กรุณากรอกรหัสผ่านใหม่","?page=profile");
            exit();
       }
       if($_POST["newpass"] != $_POST["newpass2"]){
            error("กรุณากรอกรหัสผ่านให้ตรงกัน","?page=profile");
            exit();
       }
        
       $CheckOldPassword = PasswordHash($_POST["oldpass"], $player['password']);
       if($CheckOldPassword==true){
           $newpass = AuthMeSha256($_POST["newpass"]);
           $query = $engine->prepare("UPDATE authme SET password = :password WHERE username = :username");
           $query->bindparam(":password",$newpass,PDO::PARAM_STR);
           $query->bindparam(":username",$_SESSION["username"],PDO::PARAM_STR);
           if($query->execute()){
               success("เปลี่ยนรหัสผ่านแล้วครับ \'".$_POST["newpass"]."\'","?page=profile");
               exit();
           }
       }else{
           error("รหัสผ่านผิด","?page=profile");
            exit();
       }
       
    endif;
    
endif;
echo '<script>
$("#save_email").click(function(){
    Swal({
  title: "ยืนยัน ?,
  text: "คุณแน่ใจม้ัยที่จะเปลี่ยนอีเมล ?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#28a745",
  cancelButtonColor: "#d33",
  confirmButtonText: "ยืนยัน!",
  cancelButtonText: "ยกเลิก"
}).then((result) => {
  if(result.value) {
 $("#form_save_email").submit();
  }
})
    
});
</script>
<script>
$("#change_pass").click(function(){
    Swal({
  title: "ยืนยัน ?",
  text: "คุณแน่ใจม้ัยที่จะเปลี่ยนรหัสผ่าน ?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#28a745",
  cancelButtonColor: "#d33",
  confirmButtonText: "ยืนยัน!",
  cancelButtonText: "ยกเลิก"
}).then((result) => {
  if(result.value) {
 $("#form_change_pass").submit();
  }
})
    
});
</script>';