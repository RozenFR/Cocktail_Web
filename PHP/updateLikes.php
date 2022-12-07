<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/data.php";
include_once($path);

function likesUpdate() : void {
    // Process Cookie
    $cookie_unprocessed = $_COOKIE['tempLikes'];
    $cookie_likes = Array();
    // Change Cocktails array id by their title
    foreach ($cookie_unprocessed as $tl) {
        $cookie_likes.array_push($Recettes[$tl]['titre']);
    }

    if (!isset($_SESSION['username'])) {
        // Verify (Non destructive) if likes in cookie is same as likes in session
        foreach ($cookie_likes as $tl) {
            if (!$tl . in_array($_SESSION['cocktails'])) $_SESSION['cocktails'] . array_push($tl);
        }
    } else {
        foreach ($_SESSION['cocktails'] as $stl) {
            if (!$stl.in_array($cookie_likes)) {
                $key = array_search($stl, $_SESSION['cocktails']);
                unset($key);
            }
        }
    }

    // Overwirte cookie
    $_COOKIE['tempLikes'] = $_SESSION['cocktails'];
}
