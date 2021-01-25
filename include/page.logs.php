<?php
echo '<div class="lp-panel"><i class="fa fa-file-code-o"></i>&nbsp;ประวัติการเติมเงิน

<div class="input-group mb-3 pull-right" style="width: 300px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-search"></i></span>
  </div>
  <input id="search" type="text" class="form-control lp-input" placeholder="ช่องค้นหา">
</div>

<table class="table" style="margin-top: 20px;color: white;">
  <thead>
    <tr>
      <th scope="col"><i class="fa fa-credit-card"></i>&nbsp;Transaction</th>
      <th scope="col" width="13%"><i class="fa fa-money"></i>&nbsp;ราคา</th>
      <th scope="col" width="20%"><i class="fa fa-sign-in"></i>&nbsp;ช่องทาง</th>
      <th scope="col" width="25%"><i class="fa fa-clock-o"></i>&nbsp;เวลา</th>
    </tr>
  </thead>
  <tbody id="logs">
   
      <tr>
      <th scope="row">555555555555</th>
      <td>50฿</td>
      <td>Truemoney</td>
      <td>00/00/00 00:00</td>
    </tr>
  

  </tbody>
</table>



</div>

<script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#logs tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
';