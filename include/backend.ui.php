<?php
if (isset($_GET["save"])) {
    if ($_POST["action"] == "save_navbar") {
        $ConfigiSite->UpdateConfig("navbar", "background", $_POST["nav"]);
		$ConfigiSite->UpdateConfig("site", "tagname", $_POST["tag"]);
		$ConfigiSite->UpdateConfig("site", "logo", $_POST["logo"]);
		$ConfigiSite->UpdateConfig("site", "background", $_POST["bg"]);
		$ConfigiSite->UpdateConfig("navbar", "font-color", $_POST["nav-font"]);
		$ConfigiSite->UpdateConfig("navbar", "font-active-color", $_POST["nav-font-active"]);
		$ConfigiSite->UpdateConfig("navbar", "font-active-bg", $_POST["nav-font-active-bg"]);
        success("แก้ไข ( พื้นฐาน ) แล้วครับ", "?page=backend&menu=ui");
        exit();
    }
    if ($_POST["action"] == "save_panel") {
        $ConfigiSite->UpdateConfig("color", "panel", $_POST["panel"]);
        $ConfigiSite->UpdateConfig("color", "panel_font", $_POST["panel-font"]);
        $ConfigiSite->UpdateConfig("color", "modal", $_POST["modal"]);
        success("แก้ไข ( สีหน้าต่าง ) แล้วครับ", "?page=backend&menu=ui");
        exit();
    }
    if ($_POST["action"] == "save_menu") {
        $ConfigiSite->UpdateConfig("color", "menu", $_POST["menu"]);
        $ConfigiSite->UpdateConfig("color", "menu_hover", $_POST["menu-hover"]);
        $ConfigiSite->UpdateConfig("color", "menu_font", $_POST["menu-font"]);
        $ConfigiSite->UpdateConfig("color", "menu_hover_font", $_POST["menu-hover-font"]);
        success("แก้ไข ( สีเมนู ) แล้วครับ", "?page=backend&menu=ui");
        exit();
    }
    if ($_POST["action"] == "save_input") {
        $ConfigiSite->UpdateConfig("color", "input_titie", $_POST["title-input"]);
        $ConfigiSite->UpdateConfig("color", "input_titie_font", $_POST["title-input-font"]);
        $ConfigiSite->UpdateConfig("color", "input", $_POST["input"]);
        $ConfigiSite->UpdateConfig("color", "input_color", $_POST["input-font"]);
        $ConfigiSite->UpdateConfig("color", "input_disabled", $_POST["input-disabled"]);
        success("แก้ไข ( สีช่องกรอกข้อความ ) แล้วครับ", "?page=backend&menu=ui");
        exit();
    }
}
echo '
    <!-------[  SETTING MENU   ]-------->
<div class="lp-panel" style="margin-top: 10px;border: solid 1px #d8d8d8;"><i class="fa fa-desktop"></i>&nbsp;ตั้งค่า UI

<button type="button" class="btn btn-success pull-right" id="picker">เลือกสีที่นี่</button>

<hr>

<!-------[  SETTING NAVBAR   ]-------->
พื้นฐาน ( Site )<hr style="background: white;">
<form method="post" action="?page=backend&menu=ui&save">
<input type="hidden" value="save_navbar" name="action">

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-cube"></i>&nbsp;Navbar ( พื้นหลัง )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="nav" class="form-control form-control-lg lp-input" value="' . $Config["navbar"]["background"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-font"></i>&nbsp;Font ( สีตัวหนังสือ )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="nav-font" class="form-control form-control-lg lp-input" value="' . $Config["navbar"]["font-color"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-font"></i>&nbsp;Font:active ( สีตอนอยู่หน้านั้น )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="nav-font-active" class="form-control form-control-lg lp-input" value="' . $Config["navbar"]["font-active-color"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-desktop"></i>&nbsp;bg:active ( สีพื้นหลัง )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="nav-font-active-bg" class="form-control form-control-lg lp-input" value="' . $Config["navbar"]["font-active-bg"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-desktop"></i>&nbsp;Tagname ( ชื่อเว็บ )&nbsp;:&nbsp;</span>
  </div>
  <input type="text" name="tag" class="form-control form-control-lg lp-input" value="' . $Config["site"]["tagname"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-desktop"></i>&nbsp;Logo ( รูปโลโก้ )&nbsp;:&nbsp;</span>
  </div>
  <input type="text" name="logo" class="form-control form-control-lg lp-input" value="' . $Config['site']['logo'] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-desktop"></i>&nbsp;Background ( พื้นหลัง )&nbsp;:&nbsp;</span>
  </div>
  <input type="text" name="bg" class="form-control form-control-lg lp-input" value="' . $Config['site']['background'] . '">
</div>



<button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>

<!-------[  END SETTING NAVBAR   ]-------->

<div class="row">

<div class="col-6">สีเมนู<hr style="background: white;">
<form method="post" action="?page=backend&menu=ui&save">
<input type="hidden" value="save_menu" name="action">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-list"></i>&nbsp;เมนู&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="menu" class="form-control form-control-lg lp-input" value="' . $Config["color"]["menu"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-font"></i>&nbsp;เมนู ( สีฟอนต์ )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="menu-font" class="form-control form-control-lg lp-input" value="' . $Config["color"]["menu_font"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-list"></i>&nbsp;เมนู ( Hover )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="menu-hover" class="form-control form-control-lg lp-input" value="' . $Config["color"]["menu_hover"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-font"></i>&nbsp;เมนู ( Hover:สีฟอนต์ )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="menu-hover-font" class="form-control form-control-lg lp-input" value="' . $Config["color"]["menu_hover_font"] . '">
</div>

<button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>
<!-------[  END SETTING MENU   ]-------->


</div>

<div class="col-6">สีหน้าต่าง<hr style="background: white;">
<form method="post" action="?page=backend&menu=ui&save">
<input type="hidden" value="save_panel" name="action">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-list"></i>&nbsp;แทบ Panel&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="panel" class="form-control form-control-lg lp-input" value="' . $Config["color"]["panel"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-font"></i>&nbsp;แทบ ( สีฟอนต์ )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="panel-font" class="form-control form-control-lg lp-input" value="' . $Config["color"]["panel_font"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-list"></i>&nbsp;หน้าซื้อของ ( Modal )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="modal" class="form-control form-control-lg lp-input" value="' . $Config["color"]["modal"] . '">
</div>

<button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>

</div>
</div>


<!-------[  SETTING INPUT   ]-------->
<br>

สีช่องกรอกข้อความ<hr style="background: white;">
<form method="post" action="?page=backend&menu=ui&save">
<input type="hidden" value="save_input" name="action">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-list"></i>&nbsp;สีฝั่งซ้าย&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="title-input" class="form-control form-control-lg lp-input" value="' . $Config["color"]["input_titie"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-font"></i>&nbsp;ฝั่งซ้าย ( สีฟอนต์ )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="title-input-font" class="form-control form-control-lg lp-input" value="' . $Config["color"]["input_titie_font"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-list"></i>&nbsp;สีฝั่งขวา&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="input" class="form-control form-control-lg lp-input" value="' . $Config["color"]["input"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-font"></i>&nbsp;ฝั่งขวา ( สีฟอนต์ )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="input-font" class="form-control form-control-lg lp-input" value="' . $Config["color"]["input_color"] . '">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input"><i class="fa fa-list"></i>&nbsp;สีฝั่งขวา ( Disabled )&nbsp;:&nbsp;</span>
  </div>
<input type="text" name="input-disabled" class="form-control form-control-lg lp-input" value="' . $Config["color"]["input_disabled"] . '">
</div>


<button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>

</form>
<!-------[  END SETTING INPUT   ]-------->


</div>
';
?>
<script>
    $("#picker").click(function(){
Swal.fire({
  html: '<center>เลือกสีแล้ว Copy ตรง RGB ไปครับ<hr></center><iframe src="function/color" allowtransparency="true"  frameborder="0" style="width:100%;height:180px;"></iframe>',
  confirmButtonColor: '#dc3545',
  confirmButtonText: 'ปิดหน้าต่าง'
})
    });
</script>
