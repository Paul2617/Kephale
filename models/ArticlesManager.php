<?php

     function articles ($bd, $id_article){
     return recTableId ($bd, 'article', 'id', $id_article);
     }
     function panier ($bd, $id_article){
       return $panierVerifi = panierVerifi ($bd, $_SESSION["id"], $id_article);
       
     }
     function ajourtPanier ($bd, $id_article){
      
      $ajourtPanier = $bd->prepare("INSERT INTO panie (id_user, id_article ) VALUES (?,?)");
      $ajourtPanier->execute(array($_SESSION["id"], $id_article));
      header("Refresh:0");
      exit;
     }

     function supprimerPanier ($bd, $id_article){
      $supprimerPanier = $bd->prepare("DELETE FROM panie WHERE id_user = ? and id_article LIKE '$id_article' ");
      $supprimerPanier->execute(array($_SESSION["id"]));
      header("Refresh:0");
      exit;
     }
?>