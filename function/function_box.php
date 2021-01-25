<?php

if (isset($_GET["getbox"])) {
    $query = query("SELECT * FROM random_box WHERE id = {$_GET["getbox"]}");
    $data = $query->fetch();
    $array = array("name" => $data["name"], "info" => $data["info"], "image" => $data["image"], "price" => $data["price"]);
    echo json_encode($array);
    exit();
} elseif (isset($_GET["openbox"])) {

    function w_rand($item, $percent) {
        if (count($item) != count($percent)) {
            return null;
        }
        $sum = array_sum($percent) * 100;
        $rand = mt_rand(1, $sum);

        foreach ($percent as $i => $w) {
            $percent[$i] = $w * 100 + ( $i > 0 ? $percent[$i - 1] : 0 );
            if ($rand <= $percent[$i]) {
                return $i;
            }
        }
    }
 
   
    $query = query("SELECT * FROM random_box WHERE id = {$_GET["openbox"]}");
    $data = $query->fetch();
    if ($player["point"] < $data["price"]) {
        $array = array("status" => 0, "txt" => "พ้อยท์ของคุณไม่เพียงพอ");
        echo json_encode($array);
        exit();
    } else {
     $rmpoint = query("UPDATE authme SET point = point-{$data["price"]} WHERE username = '{$_SESSION["username"]}'");
     $sql = query("SELECT * FROM random_item WHERE idbox = {$_GET["openbox"]}");
    $percent = array();
    $items = array();
    $image = array();
    while($row = $sql->fetch()){
    $percent[] = $row["percent"];
    $items[] = $row["name"];
    $image[] = $row["image"];
    }
        if(array_sum($percent)!=100){
$array = array("status" => 0, "txt" => "จำนวนการดรอปของไม่ถึง 100%");
        echo json_encode($array);
        exit();
}else{
$result = w_rand($items, $percent) ;
$array = array("status" => 1, "txt" => "คุณได้รับ : {$items[$result]}","image"=>$image[$result]);
        echo json_encode($array);
        exit();
}
        
    }
} else {
    echo 'NO';
    exit();
}