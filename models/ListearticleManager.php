<?php
require_once ('../models/bd/Model.php');

function listeArticle($bd, $id_produit){
  return  recTableIdBoucle ($bd, 'article', 'id_produit', $id_produit);
}

function prixArticle($bd){
return 'ok';
}
?>