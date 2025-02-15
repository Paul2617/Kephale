<?php
function infoUser(){
require_once ('../models/Model.php');
    $info_use = recTableId ( $bd, 'liste_achat' , '1');
    return $info_use ;
}

    ?>