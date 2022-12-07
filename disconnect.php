<?php

session_start();
session_destroy();
header('Location:index.php');
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
echo "<script type='text/javascript'>window.top.location='http://". $host . $uri . "/" . $extra ."';</script>";
exit;

?>
