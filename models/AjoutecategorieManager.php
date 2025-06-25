<?php
require_once ('../models/bd/Model.php');
function ajoute_categori ($bd, $nomCategorie, $type_categorie,$imgNom ){
    $inser = $bd->prepare("INSERT INTO categorie ( id_boutique, nom, img, types ) VALUES (?,?,?,?)");
    $inser->execute(array($_SESSION["id_boutique"], $nomCategorie, $imgNom, $type_categorie, ));
    return true ;
 }
 function verifieCategori ($bd,  $type_categorie){
    $stmt = $bd->prepare("SELECT * FROM categorie WHERE id_boutique = ? AND types LIKE '$type_categorie' ");
    $stmt->execute([$_SESSION["id_boutique"]]);
    if( $stmt->rowCount() > 0 ){
        return false;
    }else{
        return true;
    }
   
 }
?>