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

     function infoLocalisations ($bd, $id_boutique){
      $stmt = $bd->prepare("SELECT * FROM localisations WHERE id_boutique = ? AND local LIKE 'boutique' ");
      $stmt->execute([ $id_boutique ]);
    if ($stmt->rowCount() === 1){
       $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $info_stmt ;
    }else{
      return false;
    }
     }

     function infoBoutiqueType ($bd, $id_boutique){
          $stmt = $bd->prepare("SELECT abonnement FROM boutique WHERE id = ?  ");
      $stmt->execute([ $id_boutique ]);
    if ($stmt->rowCount() === 1){
       $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
       $abonnement = $info_stmt['abonnement'];
        return $abonnement;
    }else{
      return false;
    }
     }
?>