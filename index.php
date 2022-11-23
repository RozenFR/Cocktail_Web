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
    $leafs = array();
    
    function getLeaf($array, $current, &$leafs) {
        if(isset($array[$current]['sous-categorie'])) {
            foreach($array[$current]['sous-categorie'] as $i => $item) {
                getLeaf($array, $item, $leafs);
            }
        }
        else if(!in_array($current, $leafs)) {
            $leafs[] = $current;
        }
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
                <div id="Current">
                    <legend>Aliment courant</legend>
                    <span>
                        <?php
                            if(isset($_GET['current'])) {
                                $current = $_GET['current'];
                            }
                            else {
                                $current = 'Aliment';
                            }
                            print_r($current);
                            getLeaf($Hierarchie, $current, $leafs);
                        ?>
                    </span>
                </div>
                <?php 
                    if(isset($Hierarchie[$current]['sous-categorie'])) {?>
                        <span>Sous-categorie</span>
                        <?php foreach($Hierarchie[$current]['sous-categorie'] as $i => $item) { ?>
                            <a href="/index.php?current=<?php print_r($item);?>"><?php print_r($item); ?></a>
                        <?php }
                    }
                    if(isset($Hierarchie[$current]['super-categorie'])) { ?>
                        <span>Super-Categorie</span>
                        <?php foreach($Hierarchie[$current]['super-categorie'] as $i => $item) { ?>
                            <a href="/index.php?current=<?php print_r($item);?>"><?php print_r($item); ?></a>
                        <?php }
                    }
                ?>
            </article>
            <article id="List">
                <?php
                    for($i = 0; $i < count($Recettes); $i++) {
                        $ingredients = $Recettes[$i]['index'];
                        for($k = 0; $k < count($ingredients); $k++) {
                            if(in_array($ingredients[$k], $leafs)) {
                                $status = true;
                                break;
                            }
                            else {
                                $status = false;
                            }
                        }
                        if($status) { ?>
                        <a <?php
                        $title = multiexplode(array(",", ":", "(", ")"), $Recettes[$i]['titre']);
                        $title2 = rtrim(slug($title[0]), "-");
                        echo "style='background-image:url(".'"'."/Photos/".strtolower($title2).".jpg".'"'.");'"; 
                        echo 'href="/product.php?index='.$i.'"'; 
                        ?>>
                            <div class="List_content">
                                <legend>
                                <?php 
                                    $title = multiexplode(array(",", ":", "("), $Recettes[$i]['titre']);
                                    print_r($title[0]); 
                                ?></legend>
                                <!-- <img src="/Photos/Black_velvet.jpg" alt=""> -->
                                <ul title="Ingredient_Field">
                                <?php 
                                    // print_r($ingredients);
                                    for($j = 0; $j < count($ingredients); $j++) { ?>
                                        <li><?php print_r($ingredients[$j]); ?></li>
                                    <?php }
                                ?>
                                </ul>
                                <!-- <p><?php print_r($i); ?></p> -->
                            </div>
                        </a>
                        <?php }
                    }
                ?>
            </article>
        </div>
    </main>
</body>
</html>