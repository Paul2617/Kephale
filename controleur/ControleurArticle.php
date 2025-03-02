<?php 


if(isset($_SESSION["id"]) and isset($_SESSION["id_boutique"]) and isset($_GET["id_categorie"]) and isset($_GET["id_produit"]) ){
    
            $listeArticle = listeArticle ($bd);
         
}else{
    header ('Location: /Kephale/boutique');
}



?>