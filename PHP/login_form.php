<head>
    <style>
        @import url('/CSS/register.css');
    </style>
</head>
<body>
    <form title="Register" method="post" action="#">
        <legend title="Create">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path data-v-20f285ec="" d="M19 12H5m7 7-7-7 7-7"/>
            </svg>
            <h2>Create Account</h2>
        </legend>
        <span class="inputBox">
            <input name="username" type="text" required="required"
            <?php
                if(isset($_POST['username'])) {
                    $username = trim($_POST['username']);
                    if(!ctype_alnum($username)) {
                        echo "class='invalid'";
                    }
                    echo 'value="'.$username.'"'." class='valid'"; 
                }
                else if(isset($_POST['submit'])) {
                    echo "class='invalid'";
                }
            ?>
            />
            <span title="required_span">
                <legend>Identifiant</legend>
                <legend class="required">Obligatoire</legend>
            </span>
        </span>
        <span class="inputBox">
            <input name="password" type="text" required="required"
            <?php
                if(isset($_POST['password'])) {
                    $password = trim($_POST['password']);
                    if(!ctype_alnum($password)) {
                        echo "class='invalid'";
                    }
                    echo 'value="'.$password.'"'." class='valid'"; 
                }
                else if(isset($_POST['submit'])) {
                    echo "class='invalid'";
                }
            ?>
            />
            <span title="required_span">
                <legend>Mot de Passe</legend>
                <legend class="required">Obligatoire</legend>
            </span>
        </span>
        <input title="Submit" type="submit" name="submit" value="Se Connecter"/>
        <a href="/register.php">Créer un compte</a>
    </form>
    <?php 
        if(isset($_POST['submit'])) {
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/error.php";
            include_once($path);
        }
    ?>
</body>