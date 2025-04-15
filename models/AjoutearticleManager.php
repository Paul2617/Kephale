<?php
require_once ('../models/bd/Model.php');

function modeBoutique ($bd){
   $recTableId = recTableId($bd, 'abonnement', 'id_user', $_SESSION["id"] );
   $id_offre  =  $recTableId ["id_offre"];

   $infoOffre = recTableId($bd, 'offre', 'id',  $id_offre );

   $modeOffre = $infoOffre ["mode"];

   return $modeOffre ;
 }

 function typesProduit ($bd){
    $recTableId = recTableId($bd, 'produit', 'id', $_GET["id_produit"] );
    $typesProduit  =  $recTableId ["types"];

    return $typesProduit ;
 }

 function ajouteArticle($bd, $nomArticle, $descriptions_article, $prixArticle, $tailles, $date_livraison, $imgDirection ){

   require_once "../models/img_verif/img_verif_plus.php";
   $resultImg = img_verif($bd, $nomArticle, $descriptions_article, $prixArticle, $tailles, $date_livraison, $imgDirection );
if($resultImg === 'format'){
   return 'format' ;
}elseif($resultImg === 'taille'){
   return 'taille' ;
}elseif($resultImg === true ){
   return true ;
}
    //$date_creations = time();
    //$inser = $bd->prepare("INSERT INTO article ( id_boutique, id_categorie, id_produit, nom, descriptions, tailles, img, prix, date_livraison, date_creations ) VALUES (?,?,?,?,?,?,?,?,?,?)");
    //$inser->execute(array($_SESSION["id_boutique"], $_GET["id_categorie"], $_GET["id_produit"], $nomArticle, $descriptions_article, $tailles, $imgNom, $prixArticle, $date_livraison, $date_creations));
    //return true ;

 }
?>