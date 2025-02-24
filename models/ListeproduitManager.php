<?php
require_once ('../models/bd/Model.php');
function infoCategorie ($bd, $id_categorie ){
   return recTableId ($bd, 'categorie', 'id', $id_categorie);
}
function infoBoutique ($bd, $id_boutique){
    return recTableId ($bd, 'boutique', 'id', $id_boutique);
}
function infoProduit ($bd, $id_categorie){
    return recTableIdBoucle ($bd, 'produit', 'id_categorie', $id_categorie);
}


?>