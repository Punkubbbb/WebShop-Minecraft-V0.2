<?php
echo '
<style>
.navbar a{
    color: '.$Config["navbar"]["font-color"].' !important;
    }
.navbar-dark .navbar-nav>.active>a,
.navbar-dark .navbar-nav>.active>a:hover,
.navbar-dark .navbar-nav>.active>a:focus {
    color: '.$Config["navbar"]["font-active-color"].' !important;
    background-color: '.$Config["navbar"]["font-active-bg"].' !important;
    display:block;
}
   
</style>
<nav class="navbar sticky-top navbar-expand-lg bg-light" style="background: rgba('.$Config["navbar"]["background"].');border-radius: 0px;">
  <a class="navbar-brand" href="index.php"><i class="fa fa-cube"></i>&nbsp;'.$Config['site']['tagname'].'</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ';if($_GET[page]==""){ echo 'active'; }echo '">
        <a class="nav-link" href="index.php"><img src="menu/main.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Home</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;หน้าหลัก</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
      <li class="nav-item ';if($_GET[page]=="topup"){ echo 'active'; }echo '">
        <a class="nav-link" href="?page=topup"><img src="menu/topup.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Topup</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;เติมเงิน</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
      <li class="nav-item ';if($_GET[page]=="shop"){ echo 'active'; }echo '">
        <a class="nav-link" href="?page=shop"><img src="menu/shop.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Shop</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;ร้านค้า</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
	  <li class="nav-item ';if($_GET[page]=="redeem"){ echo 'active'; }echo '">
        <a class="nav-link" href="?page=redeem"><img src="menu/download.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>RedeemCode</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;ระบบเติมโค๊ต</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
	  
	  
	  
      ';
	  if(empty($_SESSION["username"])){
		  echo '<li class="nav-item ';if($_GET[page]=="login"){ echo 'active'; }echo '">
        <a class="nav-link" href="?page=login"><img src="menu/login.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>LOGIN</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;เข้าสู่ระบบ</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
      <li class="nav-item ';if($_GET[page]=="register"){ echo 'active'; }echo '">
        <a class="nav-link" href="?page=register"><img src="menu/register.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>REGISTER</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;สมัครสมาชิก</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;';
	  }
      
	if($player["rank"]=="admin"){
            echo ' <li class="nav-item ';if($_GET[page]=="backend"){ echo 'active'; }echo '">
        <a class="nav-link" href="?page=backend"><img src="menu/setting.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>BACKEND</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;จัดการระบบ</span>
              </span><span class="sr-only">(current)</span></a>
      </li>';
        }	
   echo '
    </ul>
   
  </div>
</nav>';