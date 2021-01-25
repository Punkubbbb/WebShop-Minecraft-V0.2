<?php
if(isset($_GET["save"])){
    $query = query("UPDATE authme SET username = :username, email = :email, point = :point, topup = :topup, rank = :rank WHERE username = :username",array(":username"=>$_POST["name"],":email"=>$_POST["email"],":point"=>$_POST["point"],":topup"=>$_POST["topup"],":rank"=>$_POST["rank"]));
success("แก้ไขข้อมูลผู้เล่นแล้วครับ","?page=backend&menu=player");
    exit();
}
if(isset($_GET["edit"])){
    $member = query("SELECT * FROM authme WHERE username = '{$_POST["user"]}'");
    $datap = $member->fetch();
    if($datap!=true){
        echo '<center>ไม่พบผู้ใช้นี้ครับ<hr style="background: white;"><a class="btn btn-success" href="?page=backend&menu=player"><i class="fa fa-home"></i>&nbsp;กลับไปยังหน้าแรก</a></center>';
    }else{
    echo '
    <div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-user"></i>&nbsp;จัดการสมาชิก
</div><div class="card-body">
    
 <form method="post" action="?page=backend&menu=player&save">
 
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-user"></i>&nbsp;ชื่อตัวละคร&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="name" class="form-control form-control-lg lp-input" value="'.$datap["username"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-envelope-o"></i>&nbsp;อีเมล&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="email" class="form-control form-control-lg lp-input" value="'.$datap["email"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-money"></i>&nbsp;พ้อยท์&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="point" class="form-control form-control-lg lp-input" value="'.$datap["point"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-credit-card"></i>&nbsp;ยอดการเติม&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="topup" class="form-control form-control-lg lp-input" value="'.$datap["topup"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-trophy"></i>&nbsp;แรงค์&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="rank" class="form-control form-control-lg lp-input" value="'.$datap["rank"].'">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;บันทึกข้อมูล</button>

</form>

</div></div>';
    }
}else{
echo '
    <div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-user"></i>&nbsp;จัดการสมาชิก
</div><div class="card-body">

    <form method="post" action="?page=backend&menu=player&edit">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-user"></i>&nbsp;ชื่อตัวละคร&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="user" class="form-control form-control-lg lp-input">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;แก้ไขข้อมูลผู้เล่น</button>

</form>


</div></div>


';
}
