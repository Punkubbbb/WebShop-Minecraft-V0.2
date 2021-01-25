<?php

if (empty($_GET['type'])) :
    echo '
<div class="card">
<div class="card-header slash bg-danger" style="color: white;"><i class="fa fa-credit-card"></i>&nbsp;เติมเงิน
</div><div class="card-body">

<div style="padding: 30px;border: solid 1px white;">
<center><div class="d-flex"><img src="image/wallet.png" style="width: 510px;"/></center></div></center><br>
<center><div class="alert alert-danger">หากต้องการเติมวอลเล็ตให้โอนเงินมาที่เบอร์ <br><h4>'.$wallet["phone"].'<h5><strong>'.$wallet["name"].'</strong></h5></h4>แล้วนำหมายเลขอ้างอิงมากรอกแล้วกดเติมเงินด้วยวอลเล็ต</div></center>
<hr style="background: white;">';
    if (empty($_SESSION["username"])) {
        echo '<div class="alert alertt">
 <i class="fa fa-exclamation-circle"></i>&nbsp;กรุณาเข้าสู่ระบบก่อนครับ
</div>';
    } else {
        echo '
<form method="post">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-credit-card"></i>&nbsp;</span>
  </div>
<input type="text" id="cashcard" class="form-control form-control-lg lp-input" placeholder="จำนวนการเติมเงิน">
</div>

<button type="button" id="truemoney" class="btn btn-outline-danger btn-block"><i class="fa fa-credit-card"></i>&nbsp;เติมเงินด้วยบัตรเงินสดทรูมันนี่</button>
<button id="truewallet" class="btn btn-outline-success btn-block"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;เติมเงินด้วยวอลเล็ต</button>
</form>
';

        function topup($price, $revive) {
            echo '
         <tr>
      <td>Truemoney ' . $price . '฿</td>
      <td>' . $revive . ' P.</td>
    </tr>
';
        }

       
echo '

</div>
</div></div>

</div><div class="card-body">
';
  $query = query("SELECT * FROM config WHERE config = 'true'");
  $data = $query->fetch();
        if ($data["choice"]>1) {
            echo '<div class="alert" style="background: #dc3545">ขอบคุณที่อุดหนุนง้าบบ ><</div>';
        }
        echo '




<script>
    $("#truemoney").click(function(){
    $("#truemoney").html("<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;กำลังโหลด...");
    $("#truemoney").attr("disabled","");
    var cashcard = $("#cashcard").val();
   $.ajax({ 
        type: "POST", 
        url: "function/function_topup.php?truemoney", 
        dataType: "json",
        data:{cashcard,cashcard},
        success: function (data) { 
        $("#truemoney").html("<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;กำลังโหลด...");
    $("#truemoney").attr("disabled","");
        if(data.status==0){
        Swal({
         type: "error",
                    title: "เติมเงินไม่สำเร็จ!",
                    html: data.txt,
                    confirmButtonColor: "#e02b2b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                     })
					 $("#truemoney").html("<i class=\"fa fa-check\"></i>&nbsp;ยืนยันการเติมเงิน");
    $("#truemoney").removeAttr("disabled");
}else{
Swal({
         type: "success",
          title: "เติมเงินสำเร็จแล้ว!",
                    html: data.txt,
                    confirmButtonColor: "#218b3b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                     }).then(function(isConfirm) {
   var url = "index.php";   
    if (isConfirm === true) {
    $(location).attr("href",url);
    }else {
    $(location).attr("href",url);
    }
  })
}
        
}});  
});


    $("#truewallet").click(function(){
    $("#truewallet").html("<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;กำลังโหลด...");
    $("#truewallet").attr("disabled","");
    var cashcard = $("#cashcard").val();
   $.ajax({ 
        type: "POST", 
        url: "function/function_topup.php?truewallet", 
        dataType: "json",
        data:{cashcard,cashcard},
        success: function (data) { 
        $("#truewallet").html("<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;กำลังโหลด...");
    $("#truewallet").attr("disabled","");
        if(data.status==0){
        Swal({
         type: "error",
                    title: "เติมเงินไม่สำเร็จ!",
                    html: data.txt,
                    confirmButtonColor: "#e02b2b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                     })
					 $("#truewallet").html("<i class=\"fa fa-check\"></i>&nbsp;ยืนยันการเติมเงิน");
    $("#truewallet").removeAttr("disabled");
}else{
Swal({
         type: "success",
          title: "เติมเงินสำเร็จแล้ว!",
                    html: data.txt,
                    confirmButtonColor: "#218b3b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                     }).then(function(isConfirm) {
   var url = "index.php";   
    if (isConfirm === true) {
    $(location).attr("href",url);
    }else {
    $(location).attr("href",url);
    }
  })
}
        
}});  
});
</script>
';
    }
else :

    echo '
<div class="lp-panel"><i class="fa fa-credit-card"></i>&nbsp;เติมเงินเข้าตัวละคร <a href="?page=topup" class="pull-right btn btn-outline-success">
<i class="fa fa-mouse-pointer"></i>&nbsp;เติมเงินด้วยบัตรเงินสดทรูมันนี่
</a>
<hr style="background: white;">

<div style="padding: 30px;border: solid 1px white;background: rgba(0,0,0,0.5);">
<center><img src="image/wallet.png" style="width: 300px;"/></center><br>
<center><i class="fa fa-exclamation-circle"></i>&nbsp;เติมเงินด้วยทรูมันนี่วอลเล็ต<br><a style="color: yellow;">**พ้อยท์จะได้ตามจำนวนที่โอน</a><br>โอนเงินมาที่เบอร์ : <a class="btn btn-success">'.$Config["wallet"]["phone"].'</a>';
        if ($Config["topupx2"]["status"] == "on") {
            echo '<br><a class="btn btn-success">ขอบคุณที่อุดหนุนง้าบบ ><</a><br>';
        }
        echo '</center>
<hr style="background: white;">

';
    if (empty($_SESSION["username"])) {
        echo '<div class="alert alertt">
 <i class="fa fa-exclamation-circle"></i>&nbsp;กรุณาเข้าสู่ระบบก่อนครับ
</div>';
    } else {
        echo '<form method="post" action="">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-credit-card"></i>&nbsp;</span>
  </div>
<input type="text" id="transaction" class="form-control form-control-lg lp-input" placeholder="เลขอ้างอิง">
</div>

<button type="button" id="topup" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;ยืนยันการเติมเงิน</button>
</form>
<script>
    $("#truemoney").click(function(){
    $("#truemoney").html("<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;กำลังโหลด...");
    $("#truemoney").attr("disabled","");
    var transaction = $("#transaction").val();
   $.ajax({ 
        type: "POST", 
        url: "function/function_topup.php?wallet", 
        dataType: "json",
        data:{transaction,transaction},
        success: function (data) { 
        $("#truemoney").html("<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;กำลังโหลด...");
    $("#truemoney").attr("disabled","");
        if(data.status==0){
        Swal({
         type: "error",
                    title: "เติมเงินไม่สำเร็จ!",
                    html: data.txt,
                    confirmButtonColor: "#e02b2b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                     })
					 $("#truemoney").html("<i class=\"fa fa-check\"></i>&nbsp;ยืนยันการเติมเงิน");
    $("#truemoney").removeAttr("disabled");
}else{
Swal({
         type: "success",
          title: "เติมเงินสำเร็จแล้ว!",
                    html: data.txt,
                    confirmButtonColor: "#218b3b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                     }).then(function(isConfirm) {
   var url = "index.php";   
    if (isConfirm === true) {
    $(location).attr("href",url);
    }else {
    $(location).attr("href",url);
    }
  })
}
        
}});  
});
</script>
';
    }
    echo '
<center>


</div>

</div>
';
endif;
