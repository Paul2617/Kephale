<?php 


if(isset($_SESSION["id"]) and isset($_SESSION["id_boutique"]) and isset($_GET["id_categorie"])){
  
            $listeProduit = listeProduit($bd);
        
}else{
    header ('Location: /Kephale/boutique');
}
















?>