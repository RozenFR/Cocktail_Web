<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/data.php";
include_once($path);

function likesUpdate() : void {
    // Process Cookie
    if (isset($_COOKIE['tempLikes']))
        $cookie_likes = array_values(json_decode($_COOKIE['tempLikes']));

    if (isset($_SESSION['username'])) {

        $fp = file_get_contents('users.json');
        $data = json_decode($fp, true);

        if ($_SESSION['likesUpdated'] == "no") {
            /*
             * On boucle sur le Cookie, on regarde s'il y a une update à faire depuis la déconnexion,
             * On ne peut qu'ajouter des éléments (Offline -> Online => Ajout non destructif)
             * - Si un element n'est pas dans la Session, on l'ajoute
             * - Sinon on fait rien
             * */
            foreach ($cookie_likes as $tl) {
                if (!in_array($tl, $_SESSION['cocktails']))
                    echo '<h1 style="position: absolute; z-index: 100; background-color: black;"> TL : '.print_r($tl, true).'</h1>';
                    $_SESSION['cocktails'][] = $tl;
            }

            foreach ($_SESSION['cocktails'] as $stl) {
                if (!in_array($stl, $cookie_likes)) {
                    $cookie_likes[] = $stl;
                }
            }

//            echo '<h1 style="position: absolute; z-index: 100; background-color: black;"> cookielikes : '.print_r($cookie_likes, true).'</h1>';
            $_SESSION['likesUpdated'] = "yes";
            $_COOKIE['tempLikes'] = json_encode($cookie_likes);
            header("Set-Cookie: tempLikes=".json_encode($cookie_likes).";");

        } else {
            /*
             * On boucle sur le Cookie, on regarde si il y a une update à faire :
             * - Si element pas dans la Session, on l'ajoute
             * - Si element est dans la Session, on fait rien
             * */
            foreach ($cookie_likes as $tl) {
                if (!in_array($tl, $_SESSION['cocktails'])) {
                    $_SESSION['cocktails'][] = $tl;
                }
            }

            /*
             * On boucle sur la Session, on regarde si on a des elements à supprimer
             * - Si un element n'est pas dans le Cookie, on supprime de la Session
             * - Si un element est dans le Cookie, on fait rien
             * */
            foreach ($_SESSION['cocktails'] as $stl) {
                if (!in_array($stl, $cookie_likes)) {
                    $key = array_search($stl, $_SESSION['cocktails']);
                    unset($_SESSION['cocktails'][$key]);
                }
            }
            $_COOKIE['tempLikes'] = json_encode(array_values($_SESSION['cocktails']));
            header("Set-Cookie: tempLikes=".json_encode(array_values($cookie_likes)).";");
        }
        // Edit file
        $data[$_SESSION['username']]['cocktails'] = array_values($_SESSION['cocktails']);
        file_put_contents('users.json', json_encode($data));
    }

//    echo '<h1 style="position: absolute; margin-top: 25px; z-index: 100; background-color: black;"> Session : '.print_r(array_values($_SESSION['cocktails']), true).'</h1>';
//    echo '<h1 style="position: absolute; margin-top: 50px; z-index: 100; background-color: black;"> Cookie : '.print_r(json_decode($_COOKIE['tempLikes']), true).'</h1>';
}
