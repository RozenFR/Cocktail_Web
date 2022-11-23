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
<html lang="en">
<head>
    <title>Favourites</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Photos/icon.ico">
    <style>
        @import url('/CSS/main.css');
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap');
    </style>
  </head>
  <body onload="active();onThemeSwitch();onAccentSwitch();">
    <main>
      <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/PHP/header.php";
        include_once($path)
      ?>
      <?php
      //$fav_array = range(0, count($Recettes));
      //shuffle($fav_array );
      //$fav_array = array_slice($fav_array ,0,5);
?>
      <?php for ($i=0; $i < count($Recettes); $i++) {
        if (in_array($i,$fav_array)){ ?>
          <div <?php
          $title = multiexplode(array(",", ":", "(", ")"), $Recettes[$i]['titre']);
          $title2 = rtrim(slug($title[0]), "-");
          echo "style='background-image:url(".'"'."/Photos/".strtolower($title2).".jpg".'"'.");'";  ?>>

              <div class="List_content">
                  <legend>
                  <?php
                      $title = multiexplode(array(",", ":", "("), $Recettes[$i]['titre']);
                      print_r($title[0]);
                  ?></legend>
                  <!-- <img src="/Photos/Black_velvet.jpg" alt=""> -->
                  <ul title="Ingredient_Field">
                  <?php $ingredients = explode('|', $Recettes[$i]['ingredients']);
                      for($j = 0; $j < count($ingredients); $j++) { ?>
                          <li><?php print_r($ingredients[$j]); ?></li>
                      <?php }
                  ?>
                  </ul>
                  <!-- <p><?php print_r($i); ?></p> -->
              </div>

          </div>
          <?php
        }
      }
      ?>
    </main>
  </body>
</html>
