<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestion de Cocktails</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Photos/icon.ico">
    <!-- CSS -->
    <style>
        @import url('/CSS/main.css');
        @import url('/CSS/index.css');
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap');
    </style>
</head>
<body onload="active();">
    <!-- Aside -->
    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/HTML/navbar.html";
        include_once($path);
    ?>
    <!-- Main Content -->
    <main>
        <!-- Header -->
        <?php 
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/header.php";
            include_once($path)
        ?>
        <div role="alert">The site is still in early access - Bugs are to be expected</div>
    </main>
</body>
</html>