<?php
require_once ('../models/bd/Model.php');
function infoBoutique($bd) {
   return recTableId($bd, 'boutique','id', $_SESSION["id_boutique"]);
}
// recupere les informations des categori
function infoCategorie($bd) {
    $categori = recRowCount($bd, 'boutique','id', $_SESSION["id_boutique"]);
    if($categori === 1){
        return recTableId($bd, 'boutique','id', $_SESSION["id_boutique"]);

    }else{
        return 'null';
    }
}

?>