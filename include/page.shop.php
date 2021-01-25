<?php
if($Config["bungeecord"]["status"]=="on") :
if(empty($_GET["sv"])){
    $query=query("SELECT * FROM site_server LIMIT 1");
    $data=$query->fetch();
echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=?page=shop&sv='.$data["name"].'">';
}else{
echo '
<div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-shopping-cart"></i>&nbsp;ร้านค้าเซิร์ฟเวอร์ : '.$_GET["sv"].'
</div><div class="card-body">


<div class="input-group mb-3 pull-right" style="width: 250px;">
  <div class="input-group-prepend">
    <label class="input-group-text lp-title-input">เซิร์ฟเวอร์ : </label>
  </div>
  <select class="custom-select" style="border-radius: 0px;" id="select_server">
   ';
$query = query("SELECT * FROM site_server");
$count = $query->rowCount();

if($count==0){
    echo '<option value="">ยังไม่มีเซิร์ฟเวอร์</option>';
}else{
while($data=$query->fetch()) {
    if($data['name']==$_GET["sv"]){
        echo '<option selected>'.$data['name'].'</option>';
    }else{
    echo '<option value="'.$data['name'].'">'.$data['name'].'</option>';
    }
}

}
            echo '
  </select>
</div>
';
$query = query("SELECT * FROM site_shop WHERE server = :sv",array(":sv"=>$_GET["sv"]));
$count = $query->rowCount();
if($count<1) {
    echo '<br><br><div class="alert alertt">ขณะนี้ยังไม่มีสินค้าเลยยย :(</div>';
    echo '<script>
$("#select_server").change(function() {
  $(location).attr("href","?page=shop&sv="+$("#select_server").val());
});
</script>';
    exit();
}

echo'
<div class="container" style="margin-top: 50px;">
<div class="row" style="width: 100%">
   ';
   $st = query("SELECT * FROM site_shop WHERE server = :sv",array(":sv"=>$_GET["sv"]));
     while($data=$st->fetch()){
         echo ' 
		 
		 <div class="col-md-4">
<div class="item" style="margin-bottom: 20px;">
  <div class="item-image">
  <a class="item-image-price">'.$data["price"].' บาท</a>
  <center><img src="'.$data["image"].'"></center>
  <a class="item-image-bottom">'.$data["name"].'</a>
</div>
  <div class="item-info">
    <div class="item-text">
      <a style="font-size: 18px;">'.$data["name"].'</a><br>ราคา : '.$data["price"].' พ้อยท์<br><br>
      <button class="btn btn-success btn-sm btn-block buy" id="'.$data["id"].'"><i class="fa fa-shopping-cart"></i>&nbsp;ซื้อสินค้า</button>
    </div>
  </div>
</div></div>
  ';   
     }
	 
  echo '
  </div></div>
<script>
$("#select_server").change(function() {
  $(location).attr("href","?page=shop&sv="+$("#select_server").val());
});
</script>
</div>
</div>
';
}
include("include/modal.bungeecord.php");
else :
    
    echo '<div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-shopping-cart"></i>&nbsp;ร้านค้าเซิร์ฟเวอร์
</div><div class="card-body">


';
$query = query("SELECT * FROM site_shop");
$count = $query->rowCount();
if($count<1) {
    echo '<div class="alert alert-danger">ขณะนี้ยังไม่มีสินค้าเลยยย :(</div>';
    echo '<script>
$("#select_server").change(function() {
  $(location).attr("href","?page=shop&sv="+$("#select_server").val());
});
</script>';
    exit();
}
echo'
<div class="row">
   ';
     while($data=$query->fetch()){
         echo ' 
		 
		 <div class="col-md-4">
<div class="item" style="margin-bottom: 20px;">
  <div class="item-image">
  <a class="item-image-price">'.$data["price"].' บาท</a>
  <center><img src="'.$data["image"].'"></center>
  <a class="item-image-bottom">'.$data["name"].'</a>
</div>
  <div class="item-info">
    <div class="item-text">
      <a style="font-size: 18px;">'.$data["name"].'</a><br>ราคา : '.$data["price"].' พ้อยท์<br><br>
      <button class="btn btn-success btn-sm btn-block buy" id="'.$data["id"].'"><i class="fa fa-shopping-cart"></i>&nbsp;ซื้อสินค้า</button>
    </div>
  </div>
</div>
  </div>';   
     }
    
  echo '

</div>

</div></div>';
  echo '<script>
$("#select_server").change(function() {
  $(location).attr("href","?page=shop&sv="+$("#select_server").val());
});
</script>';
include("include/modal.php");
endif;