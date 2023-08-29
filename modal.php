<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/dbcon.php';

$pid = $_POST['pid'];
  
$sql = "SELECT * FROM products where pid={$pid}";
$result = $mysqli -> query($sql);
$rs = $result -> fetch_object();

$data = array(
  'name' => $rs->name,
  'price' => $rs->price,
  'thumbnail' => $rs->thumbnail,
  'content' => $rs->content
);

echo json_encode($data);

//name, price, thumbnail, content

?>