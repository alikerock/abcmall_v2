<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';

$pid = $_POST['pid'];
  
$sql = "SELECT * FROM products where pid={$pid}";
$result = $mysqli -> query($sql);
$rs = $result -> fetch_object();

$data = array(
  'name' => $rc->name,
  'price' => $rc->price,
  'thumbnail' => $rc->thumbnail,
  'content' => $rc->content
);

echo json_encode($data);

//name, price, thumbnail, content

?>