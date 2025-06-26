<?php

     function articles ($bd, $id_article){
     return recTableId ($bd, 'article', 'id', $id_article);
     }
     function panier ($bd, $id_article){
       return $panierVerifi = panierVerifi ($bd, $_SESSION["id"], $id_article);
       
     }
     function ajourtPanier ($bd, $id_article){
     $requestUri = $_SERVER['REQUEST_URI'];
      $ajourtPanier = $bd->prepare("INSERT INTO panie (id_user, id_article ) VALUES (?,?)");
      $ajourtPanier->execute(array($_SESSION["id"], $id_article));
      header("Location: ".$requestUri);
      exit;
     }

     function supprimerPanier ($bd, $id_article){
      $requestUri = $_SERVER['REQUEST_URI'];
      $supprimerPanier = $bd->prepare("DELETE FROM panie WHERE id_user = ? and id_article LIKE '$id_article' ");
      $supprimerPanier->execute(array($_SESSION["id"]));
      header("Location: ".$requestUri);
      exit;
     }
?>