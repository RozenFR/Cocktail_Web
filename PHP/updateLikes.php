<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/data.php";
include_once($path);

function likesUpdate() : void {
    // Process Cookie
    $cookie_unprocessed = $_COOKIE['tempLikes'];
    $cookie_likes = explode(',', $cookie_unprocessed);
    unset($cookie_likes[0]);
    print_r($cookie_likes);

    echo "<h1>".$_SESSION['likesUpdated']."</h1>";

    if (isset($_SESSION['likesUpdated'])) {
        if ($_SESSION['likesUpdated'] == "no") {
            // Verify (Non destructive) if likes in cookie is same as likes in session
            foreach ($cookie_likes as $tl) {
                echo "<br>".$tl;
                if (!in_array($tl, $_SESSION['cocktails'])) $_SESSION['cocktails'].array_push($tl);
            }
            $_SESSION['likesUpdated'] = "yes";
        } else {
            foreach ($_SESSION['cocktails'] as $stl) {
                if (!in_array($stl, $cookie_likes)) {
                    $key = array_search($stl, $_SESSION['cocktails']);
                    unset($key);
                }
            }
        }
        // Edit file
        $fp = file_get_contents('users.json');
        $data = json_decode($fp, true);
        $data[$_SESSION['username']]['cocktails'] = $_SESSION['cocktails'];
        file_put_contents('users.json', json_encode($data));

    }
}
