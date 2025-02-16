<?php
require_once ('../models/bd/Model.php');
function infoUser($bd){
    $info_use = recTableId ( $bd, 'user' , 'id', $_SESSION["id"]);
    return $info_use ;
}
function verifEtat ($bd){
    //verifi si la demande de creation de boutique est envoye
    $demandeEnvoir = recRowCount($bd, 'demande','id_user', $_SESSION["id"]);
    if($demandeEnvoir === 1){
        return true;
    }else{
        return false;
    }
}
function inserdata ($bd, $id, $imgNom){
    $etat = 0;
    $inser = $bd->prepare("INSERT INTO demande ( id_user, img, etat ) VALUES (?,?,?)");
    $inser->execute(array($id, $imgNom, $etat));
    return true ;
}
?>