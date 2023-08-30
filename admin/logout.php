<?php
session_start();

if(isset($_SESSION['AUID'] ) && $_SESSION['AUID']  == 'admin') {
  unset($_SESSION['AUID']); // 세션 변수 삭제   
}

header("Location:/abcmall/admin/login.php");
die();

?>