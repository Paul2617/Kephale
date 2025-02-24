<?php

    $model = "../models/".$controleur."Manager.php";
        if(file_exists($model)){
            require_once ($model);
            if(!empty($_GET["rc"]) AND !empty($_GET["id_categorie"]) AND !empty($_GET["id_produit"])){
                $id_produit = $_GET["id_produit"];
                $infoArticle =  listeArticle($bd, $id_produit);
            }else{

            }
        }  













$page = "../views/".$controleur."Page.php";
if(file_exists($page)){
    require_once ($page);
}else{
   echo 'Page_introuvable';
}

?>