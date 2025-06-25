<?php
function ajouteBoutique($bd, $id_abt, $abn, $nomBoutique, $imgNom, $paye){
    $soldeBoutique = '0';
    $inser = $bd->prepare("INSERT INTO boutique ( id_user, nom, img, pays, solde, abonnement ) VALUES (?,?,?,?,?,?)");
    $inser->execute(array($_SESSION["id"], $nomBoutique, $imgNom, $paye, $soldeBoutique, $abn));
    $Id_boutique = $bd->lastInsertId();
    return true ;
}
?>