<?php

function infoUser(){
require_once ('../models/bd/Model.php');
    $info_use = recTableId ( $bd, 'user' , $_SESSION["id"]);
    return $info_use ;
}
//verifie si user a une boutique
function infoUserBoutiqu(){
    require_once ('../models/bd/Model.php');
}
    ?>