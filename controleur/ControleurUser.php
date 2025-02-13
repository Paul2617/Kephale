<?php
//$_SESSION = array();
//session_destroy();
if(isset($_SESSION["id_user"] )){
    function ControleurUser ( $controleur){
        $model_user = "../models/".$controleur."Manager.php";
        if(file_exists($model_user)){
            require_once ($model_user);
            return $info_user ;
        }
    }
 $viewsUser = ControleurUser($controleur);
}else{
    $_SESSION["id_user"] = '1';
    header ('Location: /Kephale/accueil'  );
}
   

    ?>