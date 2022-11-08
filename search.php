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
                <div class="flex-item">
                    <legend>
                        <?php
                        print_r($title[0]);
                        ?></legend>
                    <img src="/Photos/black-velvet.jpg" alt="">
                    <ul title="Ingredient_Field">
                        <?php for($j = 0; $j < count($ingredients); $j++) { ?>
                            <li><?php print_r($ingredients[$j]); ?></li>
                        <?php }
                        ?>
                    </ul>
                    <!-- <p><?php print_r($i); ?></p> -->
                </div>
            <?php } ?>
        <?php }
        ?>
    </div>

</main>
</body>
</html>
