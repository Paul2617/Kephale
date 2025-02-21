<?php 


if(isset($_SESSION["id"]) and isset($_SESSION["id_boutique"]) and isset($_GET["id_categorie"]) and isset($_GET["id_produit"]) ){
    $model = "../models/".$controleur."Manager.php";
        if(file_exists($model)){
            require_once ($model);
           // $listeProduit = listeArticle($bd);
        }  
}else{
    header ('Location: /Kephale/boutique');
}















$page = "../views/".$controleur."Page.php";
if(file_exists($page)){
    require_once ($page);
}else{
   echo 'Page_introuvable';
}


?>