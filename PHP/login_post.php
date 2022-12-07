<?php

session_start();

if (isset($_SESSION['username'])) {
    header("Location : index.php");
}

/**
 * User Connexion :
 * - username
 * - password
 */

if (isset($_POST['submit'])) {

}
