<?php

     function articles ($bd, $id_article){
     return recTableId ($bd, 'article', 'id', $id_article);
     }
     function panier ($bd, $id_article){
       return $panierVerifi = panierVerifi ($bd, $_SESSION["id"], $id_article);
       
     }
     function ajourtPanier ($bd, $id_article){

     }
?>