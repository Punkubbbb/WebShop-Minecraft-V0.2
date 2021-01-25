<?php
if($player["rank"]=="admin"){
    if($_GET["page"]=="backend"){
        echo '
    <div class="card" style="margin-bottom: 15px;">
<div class="card-header slash bg-success" style="color: white;"><i class="fa fa-list"></i>&nbsp;เมนูจัดการ
</div><div class="card-body">
<div class="d-flex flex-column" style="width: 100%">
<a class="lp-menu" href="?page=backend&menu=dashboard"><i class="fa fa-dashboard"></i>&nbsp;แดชบอร์ด</a>
<a class="lp-menu" href="?page=backend&menu=ui"><i class="fa fa-desktop"></i>&nbsp;จัดการ UI</a>
<a class="lp-menu" href="?page=backend&menu=player"><i class="fa fa-user"></i>&nbsp;จัดการผู้เล่น</a>
<a class="lp-menu" href="?page=backend&menu=news"><i class="fa fa-newspaper-o"></i>&nbsp;จัดการข่าวสาร</a>
<a class="lp-menu" href="?page=backend&menu=server"><i class="fa fa-server"></i>&nbsp;จัดการเซิร์ฟเวอร์</a>
<a class="lp-menu" href="?page=backend&menu=item"><i class="fa fa-shopping-cart"></i>&nbsp;จัดการสินค้า</a>
<a class="lp-menu" href="?page=backend&menu=topup"><i class="fa fa-credit-card"></i>&nbsp;จัดการระบบเติมเงิน</a>
<a class="lp-menu" href="?logout"><i class="fa fa-sign-out"></i>&nbsp;ออกจากระบบ</a>
</div>

</div>
</div>

';
    }
}/*
echo '
 <div class="card" style="margin-top: 15px">
<div class="card-header slash bg-success" style="color: white;"><i class="fa fa-server"></i>&nbsp;สถานะเซิฟเวอร์
</div>
<div class="card-body">
';
$ip = "MC-NANI.NET";
$json = getstatus($ip);
$status = json_decode($json);
if($status[5]=="online"){
	$sto = "ออนไลน์";
	$stc = "green";
}else{
	$sto = "ออฟไลน์";
	$stc = "red";
}
echo '
<center><h5 style="color: '.$stc.'">สถานะ : '.$sto.'</h5><p>ผู้เล่น : ';if($status[3]==null){echo 0;}else{echo $status[3];}echo '/'; if($status[4]==null){echo 0;}else{echo $status[4];} echo' คน<br>ไอพี : '.$ip.'</center>

</div></div>';*/

 echo '  <div class="card" style="margin-top: 15px">
<div class="card-header slash bg-dark" style="color: white;"><i class="fa fa-list"></i>&nbsp;ระบบสมาชิก
</div><div class="card-body">
<label for="username"><b>ชื่อผู้ใช้งาน (ใส่ชื่อในเกมส์)</label></b>
';
if(empty($_SESSION["username"])){
    echo '<form action="?login" method="post">
    
    <div class="input-group mb-3" style="width: 100%">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
  </div>
  <input type="text" class="form-control lp-input" name="username" placeholder="Username">
</div>
<label for="password"><b>รหัสผ่าน (ใส่รหัสในเกมส์)</label></b>
<div class="input-group mb-3" style="width: 100%">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
  </div>
  <input type="password" class="form-control lp-input" name="password" placeholder="Password">
</div>

<center>
<button type="submit" class="btn btn-success" name="type" value="login"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</button>
</center>


	</form>';
	
}else{
    echo '<center><img src="https://minotar.net/armor/bust/'.$player["username"].'/75"><br>'; if(empty($player['realname'])){ echo $player['username']; }else{ echo $player['realname']; } echo'</center><hr style="background: white;">';
    echo'
    <text style="font-size: 16px;"> 
         <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-warning btn-line-b text-white"><i class="fa fa-dollar"></i>&nbsp;จำนวนพ้อยท์</span>
  </div>
<input class="form-control form-control-lg lp-input mypointlive" value="'.$player["point"].' พ้อยท์" disabled/>
</div>
       
            <div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-warning btn-line-b text-white"><i class="fa fa-credit-card"></i>&nbsp;ยอดการเติม</span>
  </div>
<input class="form-control form-control-lg lp-input" value="'.$player["topup"].' พ้อยท์" disabled/>
</div>

            </text>
            
<div class="d-flex flex-column" style="width: 100%">
<a class="lp-menu" href="?page=profile"><i class="fa fa-user"></i>&nbsp;ข้อมูลส่วนตัว</a>
<a class="lp-menu" href="?page=logs"><i class="fa fa-credit-card"></i>&nbsp;ประวัติการเติมเงิน</a>
<a class="lp-menu" href="?page=redeem"><i class="fa fa-barcode"></i>&nbsp;เติม Redeem Code</a>
<a class="lp-menu" href="?logout"><i class="fa fa-sign-out"></i>&nbsp;ออกจากระบบ</a>
</div>
';
}
echo
'</div>
</div>

   <div class="card" style="margin-top: 15px">
<div class="card-header slash bg-success" style="color: white;"><i class="fa fa-trophy"></i>&nbsp;5 อันดับเติมเงินสูงสุด
</div>
<div class="card-body" style="margin: 0px !important;padding: 0px;">

<table class="table" style="color: black;">
  <thead>
    <tr>
      <th scope="col" width="5%">รุป</th>
      <th scope="col" width="20%">ชื่อ</th>
      <th scope="col">พ้อยท์</th>
  </thead>
  <tbody>
   ';
   $topf = query("SELECT * FROM authme ORDER BY topup DESC limit 0, 5");
   while($data=$topf->fetch()){
   echo '<tr>
      <th scope="row"><img src="https://minotar.net/avatar/'.$data["username"].'/32"></th>
      <td>'.$data["username"].'</td>
      <td>'.$data["topup"].' P.</td>
  <tbody>
    </tr>';
   }
   echo
  '</tbody>
</table>
</div></div>
      <div class="card" style="margin-top: 15px">
   <div class="card-header slash bg-warning" style="color: white;"><i class="🔥"></i>🔥 ทีมงานของเซิร์ฟเวอร์ 🔥
   </div>
   <div class="card-body" style="margin: 0px !important;padding: 0px;">
   
   <table class="table" style="color: black;">
     <thead>
       <tr>
         <th scope="col" width="5%">รูป</th>
         <th scope="col" width="20%">ชื่อ</th>
         <th scope="col">ตำแห่นง</th>
       </tr>
     </thead>
   <tbody>
<tr>
      <th scope="row"><img src="https://minotar.net/avatar/steve/32"> </th>
      <td>แก้ได้ที่ include/temp.left/บรรทัดที่ 150</td>
      <td>เจ้าของเซิร์ฟเวอร์</td>
      <tbody>
      <th scope="row"><img src="https://minotar.net/avatar/steve/32"> </th>
      <td>แก้ได้ที่ include/temp.left/บรรทัดที่ 154</td>
      <td>รองเจ้าของเซิร์ฟเวอร์</td>
      </table>
    </tr>';
         

echo '
  </tbody>
</table>
</div></div>
';
if($Config["discord"]["status"]=="on"){
    echo '

  <div class="card" style="margin-top: 15px">
<div class="card-header slash bg-info" style="color: white;"><img src="image/discord.png" style="width: 30px;"/>&nbsp;ห้องพูดคุย Discord
</div>
<div class="card-body">

	<iframe id="discord" src="'.$Config["discord"]["url"].'" height="400" allowtransparency="true" frameborder="0" style="width: 100%"></iframe> 
</div></div>';
    ?>

<?php
}
         echo'

';