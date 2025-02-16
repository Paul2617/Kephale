<?php

if(isset($_SESSION["id"])){

    $model = "../models/".$controleur."Manager.php";
    if(file_exists($model)){
        require_once ($model);
        $recupListAbonnement = recupListAbonnement($bd);
    }





//importe page 
$page = "../views/".$controleur."Page.php";
if(file_exists($page)){
    require_once ($page);
}
}
?>
