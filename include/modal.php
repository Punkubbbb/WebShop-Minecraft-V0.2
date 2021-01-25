<?php
echo '<div class="modal fade lp-modal" id="shop">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ยืนยันสินค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="d-flex">
              <div>
                  <img id="shop_img" style="width: 100px;"/>
                  <br><br>
                  <center style="font-size: 12px;">สินค้า : <a id="shop_count">0</a>x</center>
                   <center style="font-size: 12px;">ซื้อไปแล้ว : <a id="shop_buycount">0</a> ชื้น</center>
              </div>
              <div style="margin-left: 20px;">
                  <text style="font-size: 17px;">ชื่อสินค้า : <a id="shop_name"></a></text><br><br>
                  <text style="font-size: 15px;">รายละเอียด : <a id="shop_info"></a></text><br><br>
                  <text style="font-size: 15px;">ราคา : <a id="shop_price"></a>&nbsp;พ้อยท์&nbsp;<img src="image/coin.png" style="width: 30px;"/></text>
              </div>
          </div>
      </div>
      
        <div class="modal-footer">
            <div class="mr-auto">ยอดเงินของคุณ : <a id="user_point">0</a>&nbsp;<img src="image/coin.png" style="width: 30px;"/></div>
            <button type="button" class="btn btn-outline-success confirm" id="" style="width: 150px;"><i class="fa fa-shopping-cart"></i>&nbsp;ซื้อสินค้านี้</button>
</div>
        
    </div>
  </div>
</div>
<script>
$(".buy").click(function(){
    var id = $(this).attr("id")
     $.ajax({ 
        type: "GET", 
        url: "index.php?getinfo="+id, 
        dataType: "json",
        success: function (data) { 
            $("#shop_img").attr("src",data.image);
            $("#shop_name").html(data.name);
            $("#shop_info").html(data.info);
            $("#shop_price").html(data.price);
            $("#shop_count").html(data.count);
            $("#shop_buycount").html(data.buycount);
            $("#user_point").html(data.user_point);
            $(".confirm").attr("id",id);
            $("#shop").modal("show");
        }
    })
});

$(".confirm").click(function () {
        var id = $(this).attr("id")
        var price = $("#shop_price").html();
        var mypointlive = $("#user_point").html() - price;
        Swal({
        title: "แน่ใจมั้ย? (Member)",
                html: "คุณแน่ใจมั้ยที่จะซื้อสินค้านี้ในราคา : " + price + " พ้อยท์<br><a style=\"color: red;font-size: 16px;\">**กรุณาออนไลร์อยู่ในเซิร์ฟเวอร์ด้วย ถ้าไม่ได้ของแอดมินไม่รับผิดชอบ<a>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "ยืนยัน!",
                cancelButtonText: "ยกเลิก"
        }).then((result) => {
        if (result.value) {
        $.ajax({
            type: "POST",
            url: "index.php?buyitem=" + id,
            dataType: "json",
            data: {id:id},
            success: function (data) {
                if (data.status === 0) {
                    Swal(
                            "ผิดพลาด! (Shop)",
                            data.txt,
                            "error"
                            )
                } else {
                    $("#shop").modal("hide");
                    $(".mypointlive").val(mypointlive + " พ้อยท์");
                    Swal(
                            "สำเร็จ! (Shop)",
                            "ซื้อสินค้าแล้วคับ!",
                            "success"
                            )
                }

            }
        })
        }
    })
    });
</script>
';