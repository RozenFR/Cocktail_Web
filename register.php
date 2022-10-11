<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Photos/icon.ico">
    <style>
        @import url('/CSS/main.css');
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap');
    </style>
</head>
<body onload="onThemeSwitch();">
    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/HTML/navbar.html";
        include_once($path);
    ?>
    <main>
        <?php 
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/header.php";
            include_once($path)
        ?>
        <?php 
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/register_form.php";
            include_once($path)
        ?>
    </main>
</body>
</html>