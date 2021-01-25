<?php
echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="image/slide1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide3.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


  <div class="card" style="margin-top: 15px;">
<div class="card-header slash bg-dark" style="color: white;"><i class="fa fa-newspaper-o"></i>&nbsp;ข่าวสารจากทางเซิร์ฟเวอร์
</div><div class="card-body" style="margin: 0px !important;padding: 0px;">
<table class="table" style="color: black;">
  <tbody>
	 ';
	 

$news = query("SELECT * FROM site_news");
while($n=$news->fetch()){
    echo '<tr><td width="65%"><span style="font-size: 14px;" class="badge badge-'.$n["bg"].'">News</span> :&nbsp;<a style="font-size: 16px;">'.$n["text"].' </td><td>( วันที่ : '.$n["date"].' )<a></td><tr>';
}
echo '
</tbody> </table>
</div>

</div>';