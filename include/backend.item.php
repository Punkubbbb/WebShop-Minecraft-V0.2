
    
<?php
if(isset($_GET["delete"])){
	$query = query("DELETE FROM site_shop WHERE id = ?",array($_GET["delete"]));
}
if(isset($_GET["add"])){
    echo '

<div class="card">
<div class="card-header slash bg-success" style="color: white;"><i class="fa fa-plus-square"></i>&nbsp;เพิ่มสินค้า
</div><div class="card-body">

            <center><img id="image_pic" style="width: 300px;"/> </center>
<div class="input-group" id="pic_selctor">
  <div class="custom-file">
    <input type="file" class="custom-file-input" name="lolipop" id="upload_server_pic">
    <label class="custom-file-label">คลิ๊กเพื่อเลือกรูปภาพ</label>
  </div>
</div>
<hr style="background: white;">

    
 <form method="post" action="?page=backend&action">
        <input type="hidden" name="action" value="add_item">
        <input type="hidden" id="url" name="url"/>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-shopping-bag"></i>&nbsp;ชื่อสินค้า&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="name" class="form-control form-control-lg lp-input">
</div>        

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-dollar"></i>&nbsp;ราคา&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="price" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-info"></i>&nbsp;ข้อมูล&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="info" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-server"></i>&nbsp;เซิฟเวอร์&nbsp;:&nbsp;</span>
  </div>
<select name="server" class="form-control form-control-lg lp-input"> ';
$query = query("SELECT * from site_server");
 while($row = $query->fetch())
{
  $option .= '<option value = "'.$row['name'].'">'.$row['name'].'</option>';
}
echo $option; 

echo '
</select>
</div>



<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-code"></i>&nbsp;คำสั่ง&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="cmd[]" class="form-control form-control-lg lp-input"><button onclick="addcmd()" type="button" class="btn btn-success delete"><i class="fa fa-plus"></i></button>
</div>
<div class="command_div" id="command">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>
</div>
';
        ?>
		<script>
function addcmd() {
$("#command").append('<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text lp-title-input"><i class="fa fa-code"></i>&nbsp;คำสั่ง&nbsp;:&nbsp;</span></div><input type="text" name="cmd[]" class="form-control form-control-lg lp-input"><button type="button" class="btn btn-danger delete"><i class="fa fa-times"></i></button></div>');
}
$(".command_div").on("click",".delete",function(){
	$(this).parent().remove();
});

</script>
    <script>
$(document).ready(function(){  
$("#upload_server_pic").change(function(){
var lolipop;

    lolipop = new FormData();
    lolipop.append( 'lolipop', $( '#upload_server_pic' )[0].files[0] );
$.ajax({  
                url :"function/function_upload.php",  
                method:"POST",  
                data: lolipop,  
                contentType:false,  
                processData:false,  
                success:function(data){    
                    $("#pic_selctor").css("display", "none");
                    $("#image_pic").attr("src", data);
                    $("#url").val(data);
                    Swal(
  'สำเร็จ! (Backend)',
  'อัพโหลดรูปภาพแล้วคับ!',
  'success'
)
                }  
           })
})
});
</script>
        </div>
        <?php
}

if($Config["bungeecord"]["status"]=="off"){
    echo '
    <div class="card" style="margin-top: 15px;">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-shopping-cart"></i>&nbsp;จัดการสินค้า
</div><div class="card-body">
      <a class="btn btn-success btn-block" href="?page=backend&menu=item&add">เพิ่มสินค้า&nbsp;<i class="fa fa-plus-square"></i></a><hr>
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
<table class="table" style="margin-top: 20px;color: black;">
  <thead>
    <tr>
      <th scope="col" width="15%">รุป</th>
      <th scope="col" width="70%">สินค้า</th>
      <th scope="col" width="15%">ซื้อ</th>
    </tr>
  </thead>
  <tbody>
   ';
     while($data=$query->fetch()){
         echo ' <tr>
      <th scope="row"><img src="'.$data["image"].'" style="width: 75px;"></th>
      <td>'.$data["name"].'</td>
      <td><a class="btn btn-danger btn-block" href="?page=backend&menu=item&delete='.$data["id"].'"><i class="fa fa-trash"></i>&nbsp;ลบ</a></td>
    </tr>';   
     }
    
  echo '

  </tbody>
</table>

</div></div>
';
  ?>

<?php
 
}else{
   echo '
    <div class="card" style="margin-top: 15px;">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-shopping-cart"></i>&nbsp;จัดการสินค้า
</div><div class="card-body">
      <a class="btn btn-success btn-block" href="?page=backend&menu=item&add">เพิ่มสินค้า&nbsp;<i class="fa fa-plus-square"></i></a><hr>
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
<table class="table" style="margin-top: 20px;color: black;">
  <thead>
    <tr>
      <th scope="col" width="15%">รุป</th>
      <th scope="col" width="70%">สินค้า</th>
	  <th scope="col" width="15%">เซิฟเวอร์</th>
      <th scope="col" width="15%">ซื้อ</th>
    </tr>
  </thead>
  <tbody>
   ';
     while($data=$query->fetch()){
         echo ' <tr>
      <th scope="row"><img src="'.$data["image"].'" style="width: 75px;"></th>
      <td>'.$data["name"].'</td>
	  <td>'.$data["server"].'</td>
      <td><a class="btn btn-danger btn-block" href="?page=backend&menu=item&delete='.$data["id"].'"><i class="fa fa-trash"></i>&nbsp;ลบ</a></td>
    </tr>';   
     }
    
  echo '

  </tbody>
</table>

</div></div>  ';
}
?>
