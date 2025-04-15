<?php 
$info_boutique = $bd->prepare("SELECT nom, img FROM boutique WHERE id = ? ");
$info_boutique->execute(array($_GET["id_boutique"]));
$info_boutiques = $info_boutique->fetch();
$nom_boutique = $info_boutiques["nom"]; 
$img_boutique = $info_boutiques["img"]; 


$info_categori = $bd->prepare("SELECT  * FROM produit WHERE id_categorie = ? ");
$info_categori->execute(array($_GET["id_categorie"]));

?>