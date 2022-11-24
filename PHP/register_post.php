<?php

if (isset($_SESSION['username'])) {
    header("Location : index.php");
}


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
$validation_first_name = "";
$validation_date = "";
$validation_gender = "";

$checked_f = "";
$checked_m = "";

if (isset($_POST['submit'])) {

    /**
     * [Required]
     * username is undefined or is not only letters and numbers
     */
    if (!isset($_POST['username']) || !ctype_alnum(trim($_POST['username']))) {
        $valid_post = false;
        $validation_username = "invalid";
    } else $validation_username = "valid";

    /**
     * mail is defined and is a mail
     */
    if( (isset($_POST['mail']) && $_POST['mail'] != "") && !filter_var(trim($_POST['mail']), FILTER_VALIDATE_EMAIL)) {
        $valid_post = false;
        $validation_mail = "invalid";
    } else $validation_mail = "valid";

    /**
     * [Required]
     * password is undefined
     */
    if (!isset($_POST['password'])) {
        $valid_post = false;
        $validation_password = "invalid";
    } else $validation_password = "valid";

    /**
     * name is defined and is not only min/maj letters and space
     */
    if ( (isset($_POST['name']) && $_POST['name'] != "") && !preg_match("/^([a-zA-Z\s])*$" ,$_POST['name'])) {
        $valid_post = false;
        $validation_name = "invalid";
    } else $validation_name = "valid";

    /**
     * first_name is defined and not only min/maj letters and space
     */
    if ( (isset($_POST['first_name']) && $_POST['first_name'] != "") && !preg_match("/^([a-zA-Z\s])*$" ,$_POST['first_name'])) {
        $valid_post = false;
        $validation_first_name = "invalid";
    } else $validation_first_name = "valid";

    /**
     * date is defined and date different than ""
     * - date is not a date
     * - user is more than 18
     */
    if (isset($_POST['date']) && $_POST['date'] != "") {
        list($year, $month, $day) = explode('-', $_POST['date']);
        if (!checkdate($year, $month, $day)) {
            $actual_date = date('Y-m-d');
            $new_year = $year + 18;
            $limit_date = $new_year . "-" . $month . "-" . $day;
            if ($limit_date > $actual_date) {
                $valid_post = false;
                $validation_date = "invalid";
            } $validation_date = "valid";
        } else $validation_date = "valid";
    } else $validation_date = "valid";

    /**
     * Gender is defined
     * - gender different than h and f and o
     */
    if (isset($_POST['gender'])) {
        if ($_POST['gender'] != 'h' && $_POST['gender'] != 'f') {
            $valid_post = false;
            $validation_gender = "invalid";
        } else $validation_gender = "valid";
    } else $validation_gender = "valid";

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

    echo "<h1>" . $valid_post . "</h1>";

    if ($valid_post) {

        session_start();

        $_SESSION['username'] = trim($_POST['username']);
        $_SESSION['mail'] = trim($_POST['mail']);
        $_SESSION['password'] = sha1($_POST['password']);
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['date'] = $_POST['date'];
        $_SESSION['gender'] = $_POST['gender'];

        $user = [
            "username" => $_POST['username'],
            "mail" => $_POST['mail'],
            "password" => sha1($_POST['password']),
            "name" => $_POST['name'],
            "first_name" => $_POST['first_name'],
            "date" => $_POST['date'],
            "gender" => $_POST['gender'],
            "cocktails" => []
        ];

        $fp = file_get_contents('users.json');
        $data = json_decode($fp);
        if (!isset($data[$_POST['username']])) {
            $data[$_POST['username']] = $user;
            $data_encoded = json_encode($data);
            file_put_contents('users.json', $data_encoded);
        }
    }

}

?>
