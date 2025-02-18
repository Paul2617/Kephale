<?php
require_once ('../models/bd/Model.php');

function verifiCode($bd, $passwor_usre){
   $codeUser = recTableId($bd, 'user', 'id',$_SESSION["id"]);
   $codeUserRec = sha1($passwor_usre);
   if($codeUser["code"] === $codeUserRec ){
    return true;
   }else{
    return false;
   }
}

function activeSessionBoutique ($bd){
    $idBoutique = recTableId($bd, 'boutique', 'id_user',$_SESSION["id"]);
    $_SESSION["id_boutique"] = $idBoutique["id"];
    return true;
   }
?>