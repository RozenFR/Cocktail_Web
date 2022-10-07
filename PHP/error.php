<head>
    <style>
        @import url('/CSS/error.css');
    </style>
</head>
<body>
    <div class="Error">
        <h1>Vérification du formulaire</h1>
        <h2>Affichage des données reçues</h2>
        <pre>
            <?php 
                print_r($_POST); 
            ?>
        </pre>
        <h2>Rapport d'erreurs</h2>
        <ul>
            <li>Sex : 
            <?php 
                // Vérification du sexe (vaut 'f' ou 'h') 
                if(isset($_POST['sex'])) {		// la variable sexe est positionnée
                    $Sex=$_POST['sex'];		// affectation de la variable $Sexe
                    if(($Sex=='f') || ($Sex=='h') || ($Sex='o')) echo 'OK'; 
                    else echo 'différent de "f" ou "h"'; 
                }
                else echo 'Absent'; 
            ?>
            </li>
            <li>Username : 
            <?php 
                // Vérification du nom (au moins 2 lettres) 
                if(isset($_POST['username'])) {			// la variable nom est positionnée
                    $username=trim($_POST['username']);		// suppression des espaces devant et derrière 
                    if(ctype_alnum($username)) echo 'OK'; 
                    else echo 'trop court'; 
                }
                else echo 'Absent'; 
            ?>
            </li>
            <li>Email : 
            <?php 
                // Vérification du mot de passe (au moins 2 lettres) 
                if(isset($_POST['mail'])) {			// la variable nom est positionnée
                    $mail=trim($_POST['mail']);		// suppression des espaces devant et derrière 
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) echo 'OK'; 
                    else if(strlen($mail) == 0) echo 'Absent';
                    else echo 'Pas une email valide'; 
                }
                else echo 'Absent'; 
            ?>
            </li>
            <li>Password : 
            <?php 
                // Vérification du mot de passe (au moins 2 lettres) 
                if(isset($_POST['password'])) {			// la variable nom est positionnée
                    $password=trim($_POST['password']);		// suppression des espaces devant et derrière 
                    if(ctype_alnum($password)) echo 'OK'; 
                    else echo 'trop court'; 
                }
                else echo 'Absent'; 
            ?>
            </li>
            <li>Name : 
            <?php 
                // Vérification du mot de passe (au moins 2 lettres) 
                if(isset($_POST['name'])) {			// la variable nom est positionnée
                    $name=trim($_POST['name']);		// suppression des espaces devant et derrière 
                    if(ctype_alpha($name)) echo 'OK'; 
                    else if(strlen($name) == 0) echo 'Absent';
                    else echo 'Ne contient pas que des lettres'; 
                }
                else echo 'Absent'; 
            ?>
            </li>
            <li>First Name : 
            <?php 
                // Vérification du mot de passe (au moins 2 lettres) 
                if(isset($_POST['first_name'])) {			// la variable nom est positionnée
                    $first_name=trim($_POST['first_name']);		// suppression des espaces devant et derrière 
                    if(ctype_alpha($first_name)) echo 'OK';
                    else if(strlen($first_name) == 0) echo 'Absent';
                    else echo 'Ne contient pas que des lettres'; 
                }
                else echo 'Absent'; 
            ?>
            </li>
            <li>Birth Date : 
            <?php 
                // Vérification de la date de naissance
                if(isset($_POST['date'])) {			// la variable date de naissance est positionnée
                    $date=trim($_POST['date']); // suppression des espaces devant et derrière 
                    if($date=="") echo 'Absente'; 
                    else { 
                        list($year,$month,$day)=explode('-',$date);
                        if(checkdate($month,$day,$year)) echo 'OK';
                        else echo 'incorrecte';    
                    }
                }
                else echo 'absente';
            ?>
            </li>
        </ul>
    </div>
</body>