<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/data.php";
include_once($path);

function likesUpdate() : void {
    // Process Cookie
    $cookie_unprocessed = json_decode($_COOKIE['tempLikes']);
    $cookie_likes = explode(',', $cookie_unprocessed);
    unset($cookie_likes[0]);

    if (isset($_SESSION['likesUpdated'])) {
        if ($_SESSION['likesUpdated'] == "no") {
            /*
             * On boucle sur le Cookie, on regarde s'il y a une update à faire depuis la déconnexion,
             * On ne peut qu'ajouter des éléments (Offline -> Online => Ajout non destructif)
             * - Si un element n'est pas dans la Session, on l'ajoute
             * - Sinon on fait rien
             * */
            foreach ($cookie_likes as $tl) {
                if (!in_array($tl, $_SESSION['cocktails'])) $_SESSION['cocktails'][] = $tl;
            }
            $_SESSION['likesUpdated'] = "yes";
        } else {
            /*
             * On bloucle sur le Cookie, on regarde si il y a une update à faire :
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
                    array_splice($_SESSION['cocktails'], $key, $key);
                }
            }
        }
        // Edit file
        $fp = file_get_contents('users.json');
        $data = json_decode($fp, true);
        $data[$_SESSION['username']]['cocktails'] = $_SESSION['cocktails'];
        file_put_contents('users.json', json_encode($data));
        $_COOKIE['tempLikes'] = json_encode($_SESSION['cocktails']);

        print_r($_SESSION['cocktails']);
    }
}
