<?php
    function generateRandomString($length = 7) {
return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
if(isset($_FILES["lolipop"]))
{
	$gen = generateRandomString();
	$target_dir = "../image/lpk-";
$target_file = $target_dir .$gen.".png";

		$file_name = $_FILES['lolipop']['name'];
		$file_size =$_FILES['lolipop']['size'];
		$file_tmp =$_FILES['lolipop']['tmp_name'];
		$file_type=$_FILES['lolipop']['type'];
		move_uploaded_file($_FILES['lolipop']['tmp_name'], $target_file);
	echo "image/lpk-".$gen.".png";
        exit();
}
