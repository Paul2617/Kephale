<?php
require_once ('../models/bd/Model.php');
function ajouteBoutique($bd, $imgNom){
    $etat = 0;
    $inser = $bd->prepare("INSERT INTO demande ( id_user, img, etat ) VALUES (?,?,?)");
    $inser->execute(array($id, $imgNom, $etat));
    return true ;
}
?>