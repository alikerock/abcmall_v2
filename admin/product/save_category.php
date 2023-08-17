<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/dbcon.php';

  $name = $_POST['name'];
  $code = $_POST['code'];
  if(isset($_POST['pcode'])){
    $pcode = $_POST['pcode'];  
  } else{
    $pcode = '';  
  }
  $step = $_POST['step'];
  
  
  // 코드와 분류명을 사용하고 있는지 확인
  $query = "select cid from category where step=".$step." and (name='".$name."' or code='".$code."')";
  $result = $mysqli->query($query);

  $rs = $result->fetch_object();
  
  
  if(isset($rs->cid)){
    $return_data = array("result"=>"-1"); //cid 있다면, 중복
    echo json_encode($return_data);
    exit;
  }
  
  
  $sql="INSERT INTO category 
  (code, pcode, name, step) VALUES('".$code."', '".$pcode."', '".$name."', ".$step.")";
  $result=$mysqli->query($sql);

  if($result){
      $retun_data = array("result"=>1);
      echo json_encode($retun_data);
  }else{
      $retun_data = array("result"=>0);
      echo json_encode($retun_data);
  }
  

?>