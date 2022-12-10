<?php session_start(); ?>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/data.php";
    include_once($path);
?>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/PHP/slug.php";
    include_once($path);

    function multiexplode ($delimiters,$string) {
        $replace = str_replace($delimiters, $delimiters[0], $string);
        $result = explode($delimiters[0], $replace);
        return $result;
    }
?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/PHP/updateLikes.php";
include_once($path);

// Run function each time page is refresh
likesUpdate();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php
    $title = multiexplode(array(",", ":", "(", ")"), $Recettes[$_GET['index']]['titre']);
    $title2 = rtrim(slug($title[0]), "-");
                 echo $title[0];?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Photos/icon.ico">
    <style>
        @import url('/CSS/main.css');
        @import url('/CSS/product.css');
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap');
    </style>
    <script src="/JS/jquery-3.6.1.min.js"></script>
    <script defer src="/JS/like.js"></script>
</head>
<body onload="active();onThemeSwitch();onAccentSwitch();">
    <main>
        <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/header.php";
            include_once($path);
        ?>
        <div id="Main">
        <article id="List">
            <div id="Left">
                <div id="Image" <?php 
                $title = multiexplode(array(",", ":", "(", ")"), $Recettes[$_GET['index']]['titre']);
                $title2 = rtrim(slug($title[0]), "-");
                echo "style='background-image:url(".'"'."/Photos/".strtolower($title2).".jpg".'"'.");'"; 
                ?>>
                    <div>
                        <div id="Top">
                            <span class="index"><?php print_r($_GET['index']); ?></span>
                        </div>
                        <div id="Bottom">
                            <button class="like" onclick="return false;">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                            </button>
                            <button class="dislike" onclick="return false;">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Right">
                <h1><?php echo $title[0]; ?></h1>
                <h2>Ingrédients</h2>
                <ul title="Ingredient_Field">
                    <?php $ingredients = explode('|', $Recettes[$_GET['index']]['ingredients']);
                        for($j = 0; $j < count($ingredients); $j++) { ?>
                            <li><?php print_r($ingredients[$j]); ?></li>
                        <?php }
                    ?>
                </ul>
                <h2>Préparation</h2>
                <?php print_r($Recettes[$_GET['index']]['preparation']) ?>
            </div>
        </article>
    </div>
</body>
</html>
