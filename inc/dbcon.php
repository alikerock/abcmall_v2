<?php

$hostname = 'localhost';
$dbuserid = 'abcmall';
$dbpasswd = '12345';
$dbname = 'abcmall';

$mysqli = new mysqli($hostname, $dbuserid, $dbpasswd, $dbname);

if ($mysqli->connect_errno) {
  die('mysqli connection error: ' . $mysqli->connect_error);
} 

?>