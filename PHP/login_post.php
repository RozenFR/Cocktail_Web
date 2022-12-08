<?php

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['username'])) {
    header("Location : index.php");
}

/**
 * User Connexion :
 * - username
 * - password
 */

$username_validation = "";
$password_validation = "";

if (isset($_POST['submit'])) {
    $status = true;

    if(isset($_POST['username']) && ctype_alnum(trim($_POST['username']))) {
        $username_validation = "valid";
    } else {
        $username_validation = "invalid";
        $status = false;
    }

    if(isset($_POST['password'])) {
        $password_validation = "valid";
    } else {
        $password_validation = "invalid";
        $status = false;
    }

    if ($status) {
        $username = trim($_POST['username']);
        $password = sha1($_POST['password']);

        $fp = file_get_contents('./users.json');
        $data = json_decode($fp, true);

        if (isset($data[$username]) && $data[$username]['password'] == $password) {
            $_SESSION['username'] = $data[$username]['username'];
            $_SESSION['mail'] = $data[$username]['mail'];
            $_SESSION['name'] = $data[$username]['name'];
            $_SESSION['first_name'] = $data[$username]['first_name'];
            $_SESSION['first_name'] = $data[$username]['first_name'];
            $_SESSION['date'] = $data[$username]['date'];
            $_SESSION['cocktails'] = $data[$username]['cocktails'];
            $_SESSION['likesUpdated'] = "no";

            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            echo "<script type='text/javascript'>window.top.location='http://". $host . $uri . "/" . $extra ."';</script>";
            exit;
        }
    }
}

?>