<?php

try {
$engine = new PDO("mysql:host={$db["host"]};dbname={$db["db"]};charset=utf8", $db["user"], $db["pass"]);
$engine->exec("set names utf8");
}
catch (PDOException $e) {
	 echo '<b>[!] Connect Error -> </b>'.$e->getMessage();
	 exit;
}
function query($sql,$array=array()){
    global $engine;
    $q = $engine->prepare($sql);
    $q->execute($array);
    return $q;
}
?>