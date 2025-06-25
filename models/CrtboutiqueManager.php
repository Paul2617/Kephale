<?php
function ajouteBoutique($bd, $id_abt, $abn, $nomBoutique, $imgNom, $paye){
    $soldeBoutique = '0';
    $inser = $bd->prepare("INSERT INTO boutique ( id_user, nom, img, pays, psa, solde, abonnement ) VALUES (?,?,?,?,?,?,?)");
    $inser->execute(array($_SESSION["id"], $nomBoutique, $imgNom, $paye, 'boutique', $soldeBoutique, $abn));
    $Id_boutique = $bd->lastInsertId();
    return true ;
}
?>