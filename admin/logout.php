<?php
session_start();
session_unset();
session_destroy();
header("Location:/abcmall/admin/login.php");
die();

?>