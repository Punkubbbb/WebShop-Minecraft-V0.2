<?php
if($Config["bungeecord"]["status"]=="on"){
        if(isset($_GET["add"])){
        echo '<div class="lp-panel" style="margin-top: 10px;"><i class="fa fa-plus-square"></i>&nbsp;เพิ่มเซิร์ฟเวอร์
            <hr style="background: white">
    
 <form method="post" action="?page=backend&action">
        <input type="hidden" name="action" value="add_server">
        
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-desktop"></i>&nbsp;ชื่อเซิร์ฟเวอร์&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="name" class="form-control form-control-lg lp-input">
</div>        

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-server"></i>&nbsp;ไอพี Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="ip" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-plug"></i>&nbsp;พอร์ต Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="port" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-lock"></i>&nbsp;รหัสผ่าน Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="pass" class="form-control form-control-lg lp-input">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>
    
        </div>
        ';
        }
        
        if(isset($_GET["edit"])){
            $query=query("SELECT * FROM site_server WHERE id = :id",array(":id"=>$_GET["edit"]));
            $data=$query->fetch();
        echo '<div class="lp-panel" style="margin-top: 10px;"><i class="fa fa-pencil"></i>&nbsp;แก้ไขเซิร์ฟเวอร์
            <hr style="background: white">
    
 <form method="post" action="?page=backend&action">
   <input type="hidden" name="id" value="'.$data["id"].'">
        <input type="hidden" name="action" value="save_serverbungee">
        
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-desktop"></i>&nbsp;ชื่อเซิร์ฟเวอร์&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="name" class="form-control form-control-lg lp-input" value="'.$data["name"].'">
</div>        

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-server"></i>&nbsp;ไอพี Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="ip" class="form-control form-control-lg lp-input" value="'.$data["ip_rcon"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-plug"></i>&nbsp;พอร์ต Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="port" class="form-control form-control-lg lp-input" value="'.$data["port_rcon"].'">

</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-lock"></i>&nbsp;รหัสผ่าน Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="pass" class="form-control form-control-lg lp-input" value="'.$data["password_rcon"].'">
</div>

<button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>
<a class="btn btn-danger btn-block" href="?page=backend&delserver='.$data["id"].'"><i class="fa fa-trash"></i>&nbsp;ลบเซิร์ฟเวอร์</a>
        </div>
        ';
        }
        
}
echo '<div class="lp-panel" style="margin-top: 10px;"><i class="fa fa-server"></i>&nbsp;จัดการเซิร์ฟเวอร์
    <label class="form-switch pull-right">
  <input type="checkbox" id="bungeecord"';if($Config["bungeecord"]["status"]=="on"){    echo 'checked'; } echo'>
  <i></i> เปิด/ปิด  (ระบบแยกเซิร์ฟเวอร์ Bungeecord)</label>
    <hr style="background: white;">
    ';
if($Config["bungeecord"]["status"]=="off"){
    echo '   <form method="post" action="?page=backend&action">
        <input type="hidden" name="action" value="save_server">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-server"></i>&nbsp;ไอพี Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="ip" class="form-control form-control-lg lp-input" value="'.$Config["minecraft"]["ip"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-plug"></i>&nbsp;พอร์ต Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="port" class="form-control form-control-lg lp-input"  value="'.$Config["minecraft"]["port"].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-lock"></i>&nbsp;รหัสผ่าน Rcon&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="pass" class="form-control form-control-lg lp-input"  value="'.$Config["minecraft"]["pass"].'">
</div>

<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>';
}else{
    echo '<a class="btn btn-success pull-right" href="?page=backend&menu=server&add">เพิ่มเซิร์ฟเวอร์&nbsp;<i class="fa fa-plus-square"></i></a><br>';
    $query = query("SELECT * FROM site_server");
    $count = $query->rowCount();
    if($count<1){
        echo 'ยังไม่มีเซิร์ฟเวอร์ในข้อมูล';
    }else{
        echo '<table class="table" style="margin-top: 20px;color: black;">
  <thead>
    <tr>
      <th scope="col"><i class="fa fa-list"></i>&nbsp;เซิร์ฟเวอร์</th>
      <th scope="col" width="25%"><i class="fa fa-server"></i>&nbsp;ไอพี</th>
      <th scope="col" width="15%"><i class="fa fa-plug"></i>&nbsp;พอร์ต</th>
      <th scope="col" width="20%"><i class="fa fa-lock"></i>&nbsp;รหัสผ่าน</th>
      <th scope="col" width="12%"><i class="fa fa-cogs"></i>&nbsp;แก้ไข</th>
    </tr>
  </thead>
  <tbody>
  ';
        while($data=$query->fetch()){
            echo '<tr>
                <td>'.$data["name"].'</td>
                <td>'.$data["ip_rcon"].'</td>
                <td>'.$data["port_rcon"].'</td>
                <td>'.$data["password_rcon"].'</td>
                <td><a class="btn btn-warning btn-block" href="?page=backend&menu=server&edit='.$data["id"].'"><i class="fa fa-pencil"></i>&nbsp;แก้ไข</a></td>
</tr>
';
        }
        echo '
  </tbody>
</table>';
    }
}
echo '
</div>
';
?>
<script>
$("#bungeecord").click( function(){ 
if( $(this).is(":checked") ) 
bungeecord(1);
else
bungeecord(0);
});
function bungeecord(status){
 $.ajax({ 
        type: "POST", 
        url: "function/function_backend.php?act=bungeecord", 
        dataType: "json",
        data: {status:status},
        success: function(data) { 
        if(data.status==1){
            Swal(
  'สำเร็จ (Backend)!',
  'เปิดระบบ Bungeecord แล้ว!',
  'success'
).then(function(isConfirm) {
   var url = "?page=backend&menu=server";   
    if (isConfirm === true) {
    $(location).attr('href',url);
    }else {
    $(location).attr('href',url);
    }
  })

        }else{
             Swal(
  'สำเร็จ (Backend)!',
  'ปิดระบบ Bungeecord แล้ว!',
  'success'
).then(function(isConfirm) {
   var url = "?page=backend&menu=server";   
    if (isConfirm === true) {
    $(location).attr('href',url);
    }else {
    $(location).attr('href',url);
    }
  })

        }
        }
        })
}
</script>


