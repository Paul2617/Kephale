<?php

    $model = "../models/".$controleur."Manager.php";
        if(file_exists($model)){
            require_once ($model);
            if(!empty($_GET["rc"]) AND (!empty($_GET["id_categorie"])) ){
                $id_categorie = $_GET["id_categorie"];
                $infoCategorie = infoCategorie ($bd, $id_categorie );
                $id_boutique =  $infoCategorie["id_boutique"];
                $infoBoutique = infoBoutique ($bd, $id_boutique);
                $infoProduit = infoProduit ($bd, $id_categorie);
            }else{
                header ('Location: /Kephale/accueil');
            }
        }  













$page = "../views/".$controleur."Page.php";
if(file_exists($page)){
    require_once ($page);
}else{
   echo 'Page_introuvable';
}

?>