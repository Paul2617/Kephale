<?php
function ajouteBoutique($bd, $nomBoutique, $imgNom, $paye){
    $soldeBoutique = '0';
    $inser = $bd->prepare("INSERT INTO boutique ( id_user, nom, img, pays, solde ) VALUES (?,?,?,?,?)");
    $inser->execute(array($_SESSION["id"], $nomBoutique, $imgNom, $paye, $soldeBoutique));
    $Id_boutique = $bd->lastInsertId();

    return true ;
}
?>