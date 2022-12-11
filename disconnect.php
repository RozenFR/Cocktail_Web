<?php

session_start();
session_destroy();
// $_COOKIE["tempLikes"] = json_encode([]);
// header('Location:index.php');
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
echo "<script type='text/javascript'>document.cookie = 'tempLikes=' + JSON.stringify([]);
                                    location.href ='http://". $host . $uri . "/" . $extra ."';
                                    </script>";
exit;

?>
