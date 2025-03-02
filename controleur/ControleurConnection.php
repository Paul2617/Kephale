<?php

// methode poste connections
if (isset($_POST["conection"]) and !empty($_POST["conection"])){
    if (isset($_POST["telephone"]) and !empty($_POST["telephone"])){
        if (isset($_POST["password_user"]) and !empty($_POST["password_user"])){
            $telephone = htmlspecialchars($_POST["telephone"]);
            $passwor_usre = htmlspecialchars($_POST["password_user"]);
        }
    }else{
        $erreur = 'Veuillez saisir vos informations de connexion.';
    }
}


//Inporte le doc dans model pour tout les recquet de la basse de done

    if (isset( $telephone ) and !empty($passwor_usre )){
        if (isset( $telephone ) and !empty($passwor_usre )){
        $connection =  connection ($bd,$telephone, $passwor_usre);
        
        if($connection === 'numero_inconu'){
            $erreur = 'Numéro introuvable.';
        }elseif($connection === 'code_inconu'){
            $erreur = 'Mot de passe incorrect !';
        }elseif($connection === 'valide'){
            header ('Location: /Kephale/user'  );
        }
    }
    }

    ?>
