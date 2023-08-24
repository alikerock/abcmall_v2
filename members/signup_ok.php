<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/dbcon.php';

$username = $_POST['username'];
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userpw = hash('sha512', $userpw);
$useremail = $_POST['useremail'];

$sql = "INSERT INTO members
  (username,userid,userpw,useremail)
  VALUES('{$username}','{$userid}','{$userpw}','{$useremail}')";
$result = $mysqli -> query($sql) or die($mysql->error);

if($result){
  //회원테이블에 회원정보가 저장되면
  //쿠폰 발행
  $csql = "SELECT * from coupons where cid=1";
  $cresult = $mysqli -> query($csql) or die($mysql->error);
  $crs = $cresult->fetch_object();

  $cname = $crs -> coupon_name;
  $cprice = $crs -> coupon_price;
  $duedate = date("Y-m-d 23:59:59", strtotime("+30 days"));

  $ucsql = "INSERT INTO user_coupons 
    (couponid,userid,status,use_max_date,regdate,reason)
    VALUES({$crs -> cid}, '{$userid}', 1, '{$duedate}',now(),'회원가입')
  ";
  $ucresult = $mysqli -> query($ucsql) or die($mysql->error);

  echo "<script>
    alert('회원가입 완료');
    location.href= '/abcmall/index.php';
  </script>";
}else{
  echo "<script>
  alert('회원가입 실패');
  history.back();
  </script>";
}

?>