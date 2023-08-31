<?php
  session_start();
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/dbcon.php';

  $cartid = $_POST['cartid'];
 

  $sql = "DELETE from cart where cartid={$cartid}";

  $result = $mysqli -> query($sql);
  if($result){
    $data = array('result' => 'ok');
  } else{
    $data = array('result' => 'fail');
  }

  echo json_encode($data);

?>