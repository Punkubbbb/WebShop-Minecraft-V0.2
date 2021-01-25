<?php
echo '

<div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-dashboard"></i>&nbsp;แดชบอร์ด
</div><div class="card-body">


<div class="row">
  <div class="col-4">
    <div class="card lp-card">
      <div class="card-body">
        <p class="card-title" style="font-size: 15px;"><i class="fa fa-shopping-cart"></i>&nbsp;จำนวนสินค้า</p>
        <p class="card-text">0 ชิ้น</p>
      </div>
    </div>
  </div>

<div class="col-4">
    <div class="card lp-card">
      <div class="card-body">
        <p class="card-title" style="font-size: 15px;"><i class="fa fa-users"></i>&nbsp;จำนวนสมาชิก</p>
        <p class="card-text">0 คน</p>
      </div>
    </div>
  </div>
  
<div class="col-4">
    <div class="card lp-card">
      <div class="card-body">
        <p class="card-title" style="font-size: 15px;"><i class="fa fa-money"></i>&nbsp;รายรับ</p>
        <p class="card-text">0 บาท</p>
      </div>
    </div>
  </div>

</div>

<div class="lp-panel" style="margin-top: 10px;border: solid 1px #d8d8d8;"><img src="image/discord.png" style="width: 30px;"/>&nbsp;ห้องพูดคุย Discord

<label class="form-switch pull-right">
  <input type="checkbox" id="discord"';if($Config["discord"]["status"]=="on"){    echo 'checked'; } echo'>
  <i></i> เปิด/ปิด </label>
  
<hr style="background: white;">
<form method="post" action="?page=backend&action">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-link"></i>&nbsp;URL&nbsp;:&nbsp;</span>
  </div>
<input type="hidden" name="action" value="save_discord"/>
<textarea class="form-control lp-input" name="url" placeholder="URL Discord" ';if($Config["discord"]["status"]=="off"){    echo 'disabled'; } echo'>'.$Config["discord"]["url"].'</textarea>
</div>

<button type="submit" class="btn btn-outline-success btn-block" ';if($Config["discord"]["status"]=="off"){    echo 'disabled'; } echo'><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>
';
if($Config["discord"]["status"]=="on"){
    echo('<center>
	<iframe src="'.$Config["discord"]["url"].'" height="400" allowtransparency="true" frameborder="0" style="width: 50%"></iframe> 
</center>');
}
echo '
</div>

</div></div> ';?>
<script>
$("#discord").click( function(){ 
if( $(this).is(":checked") ) 
discord(1);
else
discord(0);
});
function discord(status){
 $.ajax({ 
        type: "POST", 
        url: "function/function_backend.php?act=discord", 
        dataType: "json",
        data: {status:status},
        success: function(data) { 
        if(data.status==1){
            Swal(
  'สำเร็จ (Backend)!',
  'เปิดระบบ Discord แล้ว!',
  'success'
)
$(location).attr('href',"?page=backend");
$(".lp-input").removeAttr("disabled");
$(".btn-block").removeAttr("disabled");
        }else{
             Swal(
  'สำเร็จ (Backend)!',
  'ปิดระบบ Discord แล้ว!',
  'success'
)
$(location).attr('href',"?page=backend");
$(".lp-input").attr("disabled","");
$(".btn-block").attr("disabled","");
        }
        }
        })
}
</script>
