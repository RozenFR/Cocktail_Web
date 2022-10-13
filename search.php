<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion de Cocktails</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Photos/icon.ico">
    <!-- CSS -->
    <style>
        @import url('/CSS/main.css');
        @import url('/CSS/search.css');
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap');
    </style>
    <script defer src="/JS/theme.js"></script>
</head>
<body onload="active();onThemeSwitch();onAccentSwitch();">
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
    <div class="flex-content">
        <div class="flex-item">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur consectetur ex mollitia odio quaerat quod rem repellat reprehenderit unde ut. Accusamus debitis doloribus fugit illo nemo nostrum, numquam quod unde.</p>
        </div>
        <div class="flex-item">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem culpa doloribus eius fugiat, hic in ipsam itaque laboriosam magnam, maiores nam natus pariatur, quas repudiandae sed soluta suscipit voluptatem?</p>
        </div>
        <div class="flex-item">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet delectus eius officia quidem, repudiandae tempore. Ea eos hic, id illo laudantium modi molestiae sapiente similique sit unde velit voluptatibus?</p>
        </div>
    </div>
</main>
</body>
</html>
