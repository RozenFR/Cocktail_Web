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
                 echo $title2;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Photos/icon.ico">
    <style>
        @import url('/CSS/main.css');
        @import url('/CSS/product.css');
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap');
    </style>
</head>
<body onload="active();onThemeSwitch();onAccentSwitch();">
    <main>
        <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/header.php";
            include_once($path);
        ?>
        <div id="Main">
        <h1><?php echo $title2 ?></h1>
        <h2> Ingrédients </h2>
        <ul title="Ingredient_Field">
        <?php $ingredients = explode('|', $Recettes[$_GET['index']]['ingredients']);
            for($j = 0; $j < count($ingredients); $j++) { ?>
                <li><?php print_r($ingredients[$j]); ?></li>
            <?php }
        ?>
        <h2> Préparation </h2>
        <?php print_r($Recettes[$_GET['index']]['preparation']) ?>
        <img <?php echo "src = ".'"'."/Photos/".strtolower($title2).".jpg".'"'.");'";  ?> />
    </div>
</body>
</html>
