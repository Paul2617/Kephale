<?php
if(isset($_SESSION["id"])){

    $model = "../models/".$controleur."Manager.php";
    if(file_exists($model)){
        require_once ($model);
        require_once ('../models/solde_affiche/solde.php');
    }
















//importe page 
$page = "../views/".$controleur."Page.php";
if(file_exists($page)){
    require_once ($page);
}else{
   echo 'Page_introuvable';
}

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
?>
