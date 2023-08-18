<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/dbcon.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/admin_check.php';

  $pid = $_REQUEST['pid'];
  $ismain=$_REQUEST["ismain"];
  $isnew=$_REQUEST["isnew"];
  $isbest=$_REQUEST["isbest"];
  $isrecom=$_REQUEST["isrecom"];
  $stat=$_REQUEST["stat"];

  var_dump($pid);
  echo '<hr>';
  var_dump($ismain);
  echo '<hr>';
  var_dump($isnew);
  echo '<hr>';
  var_dump($isbest);
  echo '<hr>';
  var_dump($isrecom);
  echo '<hr>';
  var_dump($stat);

  foreach($pid as $p){
    $ismain[$p] = $ismain[$p] ?? 0;
    $isnew[$p] = $isnew[$p] ?? 0;
    $isbest[$p] = $isbest[$p] ?? 0;
    $isrecom[$p] = $isrecom[$p] ?? 0;
    $stat[$p] = $stat[$p]  ?? 0;
  }

  ?>