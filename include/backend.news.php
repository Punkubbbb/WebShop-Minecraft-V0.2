<?php
if(isset($_GET["save"])){
    date_default_timezone_set("Asia/Bangkok");
    $date = date("d/m/Y H:i");
    $query = query("INSERT INTO site_news (bg,text,date) VALUES ('{$_POST["bg"]}','{$_POST["news"]}','{$date}')");
    if($query){
    succes("เพิ่มข่าวสารแล้ว","?page=backend&menu=news");
        exit();
    }
    exit();
}
if(isset($_GET["del"])){
    $query = query("DELETE FROM site_news WHERE id = '{$_GET["del"]}'");
success("ลบข่าวสารแล้ว","?page=backend&menu=news");
    exit();
    }

if(isset($_GET["edit_save"])){
    $query = query("UPDATE site_news SET text =' {$_POST["news"]}', bg = '{$_POST["bg"]}' WHERE id = '{$_GET["edit_save"]}'");
success("แก้ไขข่าวสารแล้ว","?page=backend&menu=news");
    exit();
    }
if(isset($_GET["add"])){
    echo '   

    <div class="card">
<div class="card-header slash bg-success" style="color: white;"><i class="fa fa-newspaper-o"></i>&nbsp;เพิ่มข่าวสาร
</div><div class="card-body">

 <form method="post" action="?page=backend&menu=news&save">
 
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-newspaper-o"></i>&nbsp;ข่าวสาร&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="news" class="form-control form-control-lg lp-input" placeholder="ข่าวสาร">
</div>

<div class="input-group mb-3  style="width: 250px;">
  <div class="input-group-prepend">
    <label class="input-group-text lp-title-input"><i class="fa fa-circle"></i>&nbsp;สี : </label>
  </div>
  <select class="custom-select" style="border-radius: 0px;" id="select_server" name="bg">
   <option value="success">เขียว</option>
   <option value="danger">แดง</option>
   <option value="warning">เหลือง</option>
   <option value="info">ฟ้า</option>
   <option value="primary">น้ำเงิน</option>
   <option value="light">ขาว</option>
   <option value="dark">ดำ</option>
   
  </select>
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;เพิ่มข่าวสาร</button>


</from>

</div></div>
';
}elseif(isset($_GET["edit"])){
$query = query("SELECT * FROM site_news WHERE id = {$_GET["edit"]}");
$data = $query->fetch();
    echo '

 <div class="card">
<div class="card-header slash bg-warning" style="color: white;"><i class="fa fa-newspaper-o"></i>&nbsp;แก้ไขข่าวสาร
</div><div class="card-body">        

 <form method="post" action="?page=backend&menu=news&edit_save='.$_GET["edit"].'">
 
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-newspaper-o"></i>&nbsp;ข่าวสาร&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="news" class="form-control form-control-lg lp-input" placeholder="ข่าวสาร" value="'.$data["text"].'">
</div>

<div class="input-group mb-3  style="width: 250px;">
  <div class="input-group-prepend">
    <label class="input-group-text lp-title-input"><i class="fa fa-circle"></i>&nbsp;สี : </label>
  </div>
  <select class="custom-select" style="border-radius: 0px;" id="select_server" name="bg">
   <option value="success">เขียว</option>
   <option value="danger">แดง</option>
   <option value="warning">เหลือง</option>
   <option value="info">ฟ้า</option>
   <option value="primary">น้ำเงิน</option>
   <option value="light">ขาว</option>
   <option value="dark">ดำ</option>
   
  </select>
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข่าวสาร</button>
<a class="btn btn-outline-danger btn-block" href="?page=backend&menu=news&del='.$_GET["edit"].'"><i class="fa fa-trash"></i>&nbsp;ลบข่าวสาร</a>

</from>

</div></div>
';

    
}else{

echo '
 <div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-newspaper-o"></i>&nbsp;จัดการข่าวสาร
</div><div class="card-body">     

	<a class="btn btn-success" href="?page=backend&menu=news&add">เพิ่มข่าวสาร&nbsp;<i class="fa fa-plus-square"></i></a>
        
<table class="table" style="margin-top: 20px;color: black;">
  <tbody>
	 ';

$news = query("SELECT * FROM site_news");
while($n=$news->fetch()){
    echo '<tr><td width="50%"><span style="font-size: 14px;" class="badge badge-'.$n["bg"].'">ข่าวสาร</span> :&nbsp;<a style="font-size: 16px;">'.$n["text"].' </td><td>( วันที่ : '.$n["date"].' )<a></td>'
            . '<td><a class="btn btn-info" href="?page=backend&menu=news&edit='.$n["id"].'"><i class="fa fa-pencil"></i>&nbsp;แก้ไข</a></td>'
            . '<tr>';
}
echo '
      </tbody> </table>

</div>';

}