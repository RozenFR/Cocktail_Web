<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/data.php";
include_once($path);

function likesUpdate() : void {
    // Process Cookie
    if (isset($_COOKIE['tempLikes']))
        $cookie_likes = json_decode($_COOKIE['tempLikes']);

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
            if(isset($_SESSION['username'])) {
                foreach ($_SESSION['cocktails'] as $stl) {
                    if (!in_array($stl, $cookie_likes)) {
                        $key = array_search($stl, $_SESSION['cocktails']);
                        unset($_SESSION['cocktails'][$key]);
                    }
                }
            }
        }
        $_COOKIE['tempLikes'] = json_encode($_SESSION['cocktails']);

        if (isset($_SESSION['username'])) {
            // Edit file
            $fp = file_get_contents('users.json');
            $data = json_decode($fp, true);
            $data[$_SESSION['username']]['cocktails'] = $_SESSION['cocktails'];
            file_put_contents('users.json', json_encode($data));
        }


        echo '<h1> Session : '.print_r($_SESSION['cocktails'], true).'</h1>';
        echo '<h1> Cookie : '.print_r(json_decode($_COOKIE['tempLikes']), true).'</h1>';
    }
}
