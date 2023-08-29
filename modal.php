<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/dbcon.php';

$pid = $_POST['pid'];
  
$sql = "SELECT * FROM products where pid={$pid}";
$result = $mysqli -> query($sql);
$rs = $result -> fetch_object();

 $content=$rs->content;
 if(iconv_strlen($content)>100)
 {
   $content=str_replace($rs->content,iconv_substr($rs->content,0,100,"utf-8")."...",$rs->content);
 }

$data = array(
  'name' => $rs->name,
  'price' => $rs->price,
  'thumbnail' => $rs->thumbnail,
  'content' => $content
);

echo json_encode($data);

//name, price, thumbnail, content

?>