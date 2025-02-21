<?php
require_once ('../models/bd/Model.php');

function ajoute_produit ($bd, $nomProduit, $type_produit, $imgNom){
    $inser = $bd->prepare("INSERT INTO produit ( id_boutique, id_categorie, nom, types, img ) VALUES (?,?,?,?,?)");
    $inser->execute(array($_SESSION["id_boutique"], $_GET["id_categorie"], $nomProduit, $type_produit, $imgNom ));
    return true ;
}
?>