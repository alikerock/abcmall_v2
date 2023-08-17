<?php
  session_start(); 
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/dbcon.php';

  $userid = $_POST['userid'];
  $userpw = $_POST['passwd'];
  $passwd = hash('sha512',$userpw); //암호를 sha512 알고리즘이용 암호화
  
//  $query = "select * from admins where userid='".$userid."' and passwd='".$userpw."'"; 
  $query = "select * from admins where userid='{$userid}' and passwd='{$passwd}'"; 
  $result = $mysqli->query($query);
  $rs = $result->fetch_object();

  if($rs){
    // $sql = "update admins set 컬럼명=값 where 조건"
    $sql = "update admins set last_login=now() where idx = {$rs->idx}";
    $result = $mysqli->query($sql);
    $_SESSION['AUID'] = $rs->userid;
    $_SESSION['AUNAME'] = $rs->username;
    $_SESSION['AULEVEL'] = $rs->level;

    echo "<script>
      alert('관리자님 반갑습니다');
      location.href = '/abcmall/admin/product/product_list.php';
    </script>";
  } else{
    echo "<script>
      alert('아이디, 비번을 다시 확인하세요');
      history.back();
    </script>";
  }

  

?>