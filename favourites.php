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
    <title>Favourites</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Photos/icon.ico">
    <style>
        @import url('/CSS/main.css');
        @import url('/CSS/index.css');
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap');
    </style>
    <script src="/JS/jquery-3.6.1.min.js"></script>
    <script defer src="/JS/like.js"></script>
  </head>
  <body onload="active();onThemeSwitch();onAccentSwitch();">
  <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/PHP/header.php";
    include_once($path);
    ?>   
  <main>
    <div id="Main" title="Favourites">  
    <?php
    if(isset($_SESSION['username'])) {
        $fav_array = $_SESSION['cocktails'];
    }
    else {
        if(isset($_COOKIE['tempLikes'])) {
            $fav_array = json_decode($_COOKIE['tempLikes']);
        }
        else {
            $fav_array = [];
        }
    }
    ?>
    <article id="List">
    <?php 
    if(isset($fav_array)) {
        foreach($fav_array as $i) {
        $ingredients = $Recettes[$i]['index'];
        if(in_array($i, $fav_array)) { ?>
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
                        for($j = 0; $j < count($ingredients); $j++) { ?>
                            <li><?php print_r($ingredients[$j]); ?></li>
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
        <?php }}
    }
    ?>
    </article>
    </div>
    </main>
  </body>
</html>
