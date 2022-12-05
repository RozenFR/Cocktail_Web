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
        /* Setup URL params in PHP */
        /* Setup "something in it" */
        $raw_content = $_GET['content'];
        $a_content = explode('"', $raw_content);
        $ingredient = $a_content[1];

        /* Setup Filter '+' et '-' */
        $posfilter = [];
        $negfilter = [];
        if (count($a_content) > 1) {
            $raw_filter_content = substr($a_content[2], 1);
            $filter_content = explode(" ", $raw_filter_content);
            for ($j = 0; $j < count($filter_content); $j++) {
                if ($filter_content[$j][0] == '+')
                    $posfilter[] = $filter_content[$j];
                if ($filter_content[$j][0] == '-')
                    $negfilter[] = $filter_content[$j];
            }
        }

        for($i = 0; $i < count($Recettes); $i++) {
            $title = multiexplode(array(",", ":", "("), $Recettes[$i]['titre']);
            $ingredients = explode('|', $Recettes[$i]['ingredients']);

            $status = true;

            if (strpos(strtolower($Recettes[$i]['ingredients']), strtolower($ingredient)) === false)
                $status = false;

            if ($status && count($posfilter) > 0) {
                for ($j = 0; $j < count($posfilter); $j++) {
                    $subf = substr($posfilter[$j], 1);
                    if (strpos(strtolower($Recettes[$i]['ingredients']), strtolower($subf)) === false)
                        $status = false;
                }
            }

            if ($status && count($negfilter) > 0) {
                for ($j = 0; $j < count($negfilter); $j++) {
                    $subf = substr($negfilter[$j], 1);
                    if (strpos(strtolower($Recettes[$i]['ingredients']), strtolower($subf)) !== false)
                        $status = false;
                }
            }


            if ($status) { ?>
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
                        </div>
                    </a>
            <?php } ?>
        <?php }
        ?>
        </article>
    </div>

</main>
</body>
</html>
