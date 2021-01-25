<?php
echo '<div class="lp-panel"><i class="fa fa-square-o"></i>&nbsp;กล่องสุ่มของ
<hr style="background: white;">
<div class="row">
';
$query = query("SELECT * FROM random_box");
while ($data = $query->fetch()) {
    echo ' <div class="col-6">
    <div class="card lp-card">
      <div class="card-body">
      <center><img src="image/'.$data["image"].'" style="width: 40%" /></center>
          <br>
          <i class="fa fa-square-o"></i>&nbsp; '.$data["name"].'<br>
              <a style="font-size: 15px">ข้อมูล » '.$data["info"].'</a><br>
                   <a style="font-size: 15px">ของที่ดรอบ » </a>
                  <div class="card lp-card" style="margin-top: 10px">
      <div class="card-body">
         
          ';
    $item = query("SELECT * FROM random_item WHERE idbox = {$data["id"]}");
            while($data2 = $item->fetch()){
                echo '<li><a style="font-size: 15px">'.$data2["name"].'</a><a style="font-size: 11.5px">  ( Drop : '.$data2["percent"].'% )<a></li>';
            }
            echo '

      </div></div>
      <br>
<button type="button" class="btn btn-success btn-block openbox" id="'.$data["id"].'"><i class="fa fa-square-o"></i>&nbsp;เปิดกล่อง</button>

      </div>
    </div>
  </div>';
}
?>
    <script>
    $(".openbox").click(function(){
        var id = $(this).attr("id");
        $.ajax({
            type: "GET",
            url: "index.php?getbox=" + id,
            dataType: "json",
            success: function (data) {
                
                Swal.fire({
  title: 'คุณแน่ใจมั้ยที่จะเปิดกล่องนี้?',
  html: "<div style='background: rgba(0,0,0,0.2);padding: 10px;border-radius: 10px;font-size: 19px;'>\n\
<div class='row'><div class='col-4'><img src='image/"+data.image+"'  style='width: 100%'/></div>\n\
<div class='col-8' align='left' style='margin-top: 40px;'>\n\
เปิดกล่องสุ่ม : "+data.name+"<br>\n\
ราคา : "+data.price+" พ้อยท์\n\
</div></div>\n\
</div>",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'ยกเลิก',
  confirmButtonColor: '#28a745',
  confirmButtonText: 'ตกลง!'
}).then((result) => {
  if (result.value) {
      $.ajax({
            type: "GET",
            url: "index.php?openbox=" + id,
            dataType: "json",
            success: function (data) {
                if(data.status===0){
                    Swal(
  'ผิดพลาด (Member)!',
  data.txt,
  'error'
)
                }else{
                    Swal({
              title: 'เปิดกล่องสำเร็จ! (Member)',
  type: 'success',
  html: '<hr><center><a style="font-size: 20px;">'+data.txt+'</a><br><img src="image/'+data.image+'" style="width: 30%"/></center><hr>',
  confirmButtonText: 'รับไอเท็ม',
  confirmButtonColor: '#28a745'
            });
              
                }
            }})
  }
})
                
}


})});
</script>
