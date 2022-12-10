<?php

/**
 * User Register :
 * - username*
 * - mail
 * - password*
 * - name
 * - first_name
 * - date
 * - gender
 */

$valid_post = true;
$validation_username = "";
$validation_mail = "";
$validation_name = "";
$validation_password = "";
$validation_first_name = "";
$validation_date = "";
$validation_gender = "";

$checked_f = "";
$checked_m = "";

if (isset($_POST['submit'])) {

    $fp = file_get_contents('./users.json');
    $data = json_decode($fp, true);

    $user['username'] = $_SESSION['username'];
    $user['cocktails'] = $_SESSION['cocktails'];

    /**
     * mail is defined and is a mail
     */
    if(isset($_POST['mail']) && !empty($_POST['mail'])) {
        if (filter_var(trim($_POST['mail']), FILTER_VALIDATE_EMAIL)) {
            $user['mail'] = $_POST['mail'];
            $validation_mail = "valid";
        } else {
            $user['mail'] = $_SESSION['mail'];
            $validation_mail = "invalid";
        }
    } else {
        $user['mail'] = $_SESSION['mail'];
    }

    /**
     * [Required]
     * password is undefined
     */
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        if ($_POST['password'] == $_POST['confirm_password']) {
            $user['password'] = sha1($_POST['password']);
            $validation_password = 'valid';
        } else {
            $user['password'] = $data[$_SESSION['username']]['password'];
            $validation_password = 'invalid';
        }
    } else {
        $user['password'] = $data[$_SESSION['username']]['password'];
    }

    /**
     * name is defined and is not only min/maj letters and space
     */
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        if (ctype_alpha(trim($_POST['name']))) {
            $user['name'] = $_POST['name'];
            $validation_name = 'valid';
        } else {
            $user['name'] = $_SESSION['name'];
            $validation_first_name = 'invalid';
        }
    } else {
        $user['name'] = $_SESSION['name'];
    }

    /**
     * first_name is defined and not only min/maj letters and space
     */
    if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
        if (ctype_alpha(trim($_POST['first_name']))) {
            $user['first_name'] = $_POST['first_name'];
            $validation_first_name = 'valid';
        } else {
            $user['first_name'] = $_SESSION['first_name'];
            $validation_first_name = 'invalid';
        }
    } else {
        $user['first_name'] = $_SESSION['first_name'];
    }
    /**
     * date is defined and date different than ""
     * - date is not a date
     * - user is more than 18
     */
    if (isset($_POST['date']) && !empty($_POST['date'])) {
        list($year, $month, $day) = explode('-', $_POST['date']);
        if (checkdate((int) $month,(int) $day,(int) $year)) {
            $actual_date = date('Y-m-d');
            $new_year = $year + 18;
            $limit_date = $new_year . "-" . $month . "-" . $day;
            if ($limit_date < $actual_date) {
                $user['date'] =$_POST['date'];
                $validation_date = 'valid';
            } else {
                $user['date'] = $_SESSION['date'];
                $validation_date = 'invalid';
            }
        } else {
            $user['date'] = $_SESSION['date'];
            $validation_date = 'invalid';
        }
    } else {
        $user['date'] = $_SESSION['date'];
    }

    /**
     * Gender is defined
     * - gender different than h and f and o
     */
    if (isset($_POST['gender'])) {
        if ($_POST['gender'] == 'h' xor $_POST['gender'] == 'f') {
            $user['gender'] = $_POST['gender'];
            $validation_gender = "valid";
        } else {
            $user['gender'] = $_SESSION['gender'];
            $validation_gender = "invalid";
        }
    } else {
        $user['gender'] = $_SESSION['gender'];
    }

    /**
     * Checking box of gender
     */
    if ($validation_gender == "valid") {
        switch ($_POST['gender']) {
            case 'h': $checked_m = "checked"; break;
            case 'f': $checked_f = "checked"; break;
            default: break;
        }
    }

    if (isset($data[trim($_SESSION['username'])])) {
        $data[$_SESSION['username']] = $user;
        file_put_contents('users.json', json_encode($data));
    }

    $username = $_SESSION['username'];
    $_SESSION['username'] = $data[$username]['username'];
    $_SESSION['mail'] = $data[$username]['mail'];
    $_SESSION['name'] = $data[$username]['name'];
    $_SESSION['first_name'] = $data[$username]['first_name'];
    $_SESSION['first_name'] = $data[$username]['first_name'];
    $_SESSION['date'] = $data[$username]['date'];
    $_SESSION['cocktails'] = $data[$username]['cocktails'];

}

?>
