<?php
  session_start(); 
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/dbcon.php';

  $userid = $_POST['userid'];
  $userpw = $_POST['passwd'];
  $passwd = hash('sha512',$userpw); //암호를 sha512 알고리즘이용 암호화
  
  $query = "select * from members where userid='{$userid}' and userpw='{$passwd}'"; 
  $result = $mysqli->query($query);
  $rs = $result->fetch_object();

  if($rs){

    $_SESSION['UID'] = $rs->userid;
    $_SESSION['UNAME'] = $rs->username;

    $sql = "UPDATE cart SET userid='{$userid}' where ssid='".session_id()."'";    
    $result = $mysqli->query($sql);
    echo "<script>
      alert('$rs->username 님 반갑습니다');
      location.href = '/abcmall/index.php';
    </script>";
  } else{
    echo "<script>
      alert('아이디, 비번을 다시 확인하세요');
     history.back();
    </script>";
  }

  

?>