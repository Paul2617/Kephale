<?php
//$_SESSION = array();
//session_destroy();

//voir la session est id_user est declare
if(isset($_SESSION["id_user"] )){
    //Inporte le doc dans model pour tout les recquet de la basse de done
    $model_user = "../models/".$controleur."Manager.php";
    if(file_exists($model_user)){
        require_once ($model_user);
        $infoUser = infoUser();
    }


    
    function ControleurUser ( $controleur){
    }

    
 $viewsUser = ControleurUser($controleur);
















}else{
    $_SESSION["id_user"] = '1';
    header ('Location: /Kephale/accueil'  );
}
   

    ?>