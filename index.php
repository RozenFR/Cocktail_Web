<?php 
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/data.php";
    include_once($path);
?>
<?php 
    function multiexplode ($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
?>
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
        <div id="Main">
            <article id="Aliment">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </article>
            <article id="List">
                <?php
                    for($i = 0; $i < count($Recettes); $i++) { ?>
                        <div>
                            <legend>
                            <?php 
                                $title = multiexplode(array(",", ":", "("), $Recettes[$i]['titre']);
                                print_r($title[0]); 
                            ?></legend>
                            <img src="/Photos/Black_velvet.jpg" alt="">
                            <ul title="Ingredient_Field">
                            <?php $ingredients = explode('|', $Recettes[$i]['ingredients']);
                                for($j = 0; $j < count($ingredients); $j++) { ?>
                                    <li><?php print_r($ingredients[$j]); ?></li>
                                <?php }
                            ?>
                            </ul>
                            <!-- <p><?php print_r($i); ?></p> -->
                        </div>
                    <?php } 
                ?>
            </article>
        </div>
    </main>
</body>
</html>