<?php


if (isset($_POST["conection"]) and !empty($_POST["conection"])){
    if (!empty($_POST["telephone"]) and isset($_POST["password_user"])){
        $telephone = htmlspecialchars($_POST["telephone"]);
        $passwor_usre = htmlspecialchars($_POST["password_user"]);
    }else{
        $erreur = 'Veuillez saisir vos informations de connexion.';
    }
}


//Inporte le doc dans model pour tout les recquet de la basse de done
$model = "../models/".$controleur."Manager.php";
if(file_exists($model)){
    echo 'ok';
    if (!empty( $telephone ) and isset($passwor_usre )){
        require_once ($model);
        $connection =  connection ($telephone, $passwor_usre);
        
    }
}








$model_user = "../views/".$controleur."Page.php";
if(file_exists($model_user)){
    require_once ($model_user);
}else{
    echo 'Page inrouvable';
}
    ?>
