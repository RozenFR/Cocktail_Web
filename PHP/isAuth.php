<?php

/**
 * @param $url target url
 * @return void
 * Redirect user if not connected
 */
function isAuthenticated($url): void {
    if (isset($_SESSION['username'])) {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        echo "<script type='text/javascript'>window.top.location='http://". $host . $uri . "/" . $url ."';</script>";
        exit;
    }
}


?>
