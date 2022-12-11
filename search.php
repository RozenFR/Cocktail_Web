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
<html lang="fr">
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
    <script defer src="/JS/like.js"></script>
</head>
<body onload="active();onThemeSwitch();onAccentSwitch();">
<!-- Main Content -->
<main>
    <!-- Header -->
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/PHP/header.php";
    include_once($path)
    ?>
    <div id="Main" title="Search">
        <article id="List">
        <?php

        /* Setup Regex et get */
        $reg_ingredient = '/[\"]?[a-zA-Z\s]+[\"]?/';
        $reg_plus = '/[\+][\"]?[a-zA-Z\s]+[\"]?/';
        $reg_minus = '/[\-][\"]?[a-zA-Z\s]+[\"]?/';
        $get_content = $_GET['content'];

        /* Use of regex and input in var */
        preg_match_all($reg_ingredient, $get_content, $ingredient);
        preg_match_all($reg_plus, $get_content, $plus);
        preg_match_all($reg_minus, $get_content, $minus);

        $reg_pm = '/[a-zA-Z\s]+/';
        /* Setup search var */
        $splus = []; $sminus = [];
        foreach ($plus[0] as $item) {
            preg_match_all($reg_pm, $item, $temp);
            $splus[] = $temp[0][0];
        }

        foreach ($minus[0] as $item) {
            preg_match_all($reg_pm, $item, $temp);
            $sminus[] = $temp[0][0];
        }

        $singredient = $ingredient[0][0];

        $counter = 0;

        for($i = 0; $i < count($Recettes); $i++) {
            $nbplus = sizeof($splus) + 1;
            $nbmoins = sizeof($sminus);
            $ttscore = sizeof($splus) + sizeof($minus);

            $title = multiexplode(array(",", ":", "("), $Recettes[$i]['titre']);

            $r_wquotes = '/('.strtolower($singredient).')/';
            $r_quotes = str_replace('"', '', $r_wquotes);

            if (!preg_match($r_quotes, strtolower($Recettes[$i]['ingredients'])))
                $nbplus--;

            foreach ($splus as $item) {
                $r_pwquotes = '/('.strtolower($item).')/';
                $r_pquotes = str_replace('"', '', $r_pwquotes);
                if (!preg_match($r_pquotes, strtolower($Recettes[$i]['ingredients'])))
                    $nbplus--;
            }

            foreach ($sminus as $item) {
                $r_mwquotes = '/('.strtolower($item).')/';
                $r_mquotes = str_replace('"', '', $r_mwquotes);
                if (preg_match($r_mquotes, strtolower($Recettes[$i]['ingredients'])))
                    $nbmoins--;
            }

            if ($nbplus + $nbmoins != 0) {
                $counter++;?>
                <a class="List_Item"<?php
                    // ? Remove all punctuation
                    $title = multiexplode(array(",", ":", "(", ")"), $Recettes[$i]['titre']);
                    // ? Slugify the first part of the title before any punctuation
                    $title2 = rtrim(slug($title[0]), "-");
                    // ? Add the image to the background with css styling
                    echo "style='background-image:url(".'"'."/Photos/".strtolower($title2).".jpg".'"'.");'"; 
                    echo 'href="/product.php?index='.$i.'"'; 
                    ?>>
                        <div class="List_content">
                            <div class="Top">
                                <span class="index"><?php print_r($i); ?></span>
                                <legend>
                                <?php 
                                    $title = multiexplode(array(",", ":", "("), $Recettes[$i]['titre']);
                                    print_r($title[0]); 
                                ?></legend>
                            </div>
                            <div class="Bottom">
                                <ul title="Ingredient_Field">
                                <?php 
                                    for($j = 0; $j < count($Recettes[$i]['index']); $j++) { ?>
                                        <li><?php print_r($Recettes[$i]['index'][$j]); ?></li>
                                    <?php }
                                ?>
                                </ul>
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
                            <div style="margin-left: auto; margin-right: 10px;"><h2>Score : <?= (($nbplus + $nbmoins)/$ttscore)*100 ?> %</h2></div>
                        </div>
                    </a>
            <?php } ?>
        <?php }
        if ($counter == 0) {
            echo "<h1>Problème dans votre requête : Recherche Impossible</h1>";
        }
        ?>
        </article>
    </div>

</main>
</body>
</html>
