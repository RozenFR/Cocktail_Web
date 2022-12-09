<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/PHP/isAuth.php";
include_once($path);
isAuthenticated('index.php');
?>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/PHP/profile_post.php";
include($path);
?>

<head>
    <style>
        @import url('/CSS/register.css');
    </style>
</head>
<body>
    <form title="Register" method="post" action="register.php">
        <legend title="Create">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path data-v-20f285ec="" d="M19 12H5m7 7-7-7 7-7"/>
            </svg>
            <h2>Profil</h2>
        </legend>

<!--    Email    -->
        <span class="inputBox unrequired">
            <input name="mail" class="<?= $validation_mail ?>" type="text" placeholder=" " pattern="[a-z0-9._%+-]+@[a-z0-9._-]+\.[a-z]{2,4}$"/>
            <span>
                <legend>Email</legend>
            </span>
        </span>

<!--    Password    -->
        <span class="inputBox">
            <input name="password" class="<?= $validation_password ?>" type="text" required="required"/>
            <span title="required_span">
                <legend>Nouveau Mot de passe</legend>
                <legend class="required">Obligatoire</legend>
            </span>
        </span>

        <span class="inputBox">
            <input name="confirm_password" class="<?= $validation_password ?>" type="text" required="required"/>
            <span title="required_span">
                <legend>Confirmer Mot de passe</legend>
                <legend class="required">Obligatoire</legend>
            </span>
        </span>

<!--    Name    -->
        <span class="inputBox unrequired">
            <input name="name" class="<?= $validation_name ?>" type="text" placeholder=" "/>
            <span>
                <legend>Nom</legend>
            </span>
        </span>

<!--    First Name    -->
        <span class="inputBox unrequired">
            <input name="first_name" class="<?= $validation_first_name ?>" type="text" placeholder=" "/>
            <span>
                <legend>Prénom</legend>
            </span>
        </span>

<!--    Birth Date    -->
        <input name="date" class="<?= $validation_date ?>" type="date"/>

<!--    Gender    -->
        <span title="Gender_Field" class="<?= $validation_gender ?>">
            <div>
                <input value="h" type="radio" name="gender" <?= $checked_m ?>/>
                <svg class="Radio_Checked" viewBox="0 0 24 24" fill="none">
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="m9 11 3 3L22 4" stroke="#FF6740" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="Radio" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" fill="transparent" rx="2" ry="2"/>
                </svg>
                <label>Homme</label>
            </div>
            <div>
                <input value="f" type="radio" name="gender" <?= $checked_f ?>/>
                <svg class="Radio_Checked" viewBox="0 0 24 24" fill="none">
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="m9 11 3 3L22 4" stroke="#FF6740" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="Radio" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" fill="transparent" rx="2" ry="2"/>
                </svg>
                <label>Femme</label>
            </div>
        </span>
        <input title="Submit" type="submit" name="submit" value="Sauvegarder"/>
        <a href="/index.php">Annuler</a>
    </form>
    <?php 
        if(isset($_POST['submit'])) {
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/error.php";
            include($path);
        }
    ?>
</body>
