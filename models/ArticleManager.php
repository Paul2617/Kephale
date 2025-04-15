<?php
require_once ('../models/bd/Model.php');

function listeArticle ($bd){
   return  recTableIdBoucle($bd, 'article', 'id_produit', $_GET["id_produit"] );
 }
function img($bd, $id_article){
  $rec = $bd->prepare('SELECT * FROM images_article WHERE article_id = ? LIMIT 1');
  $rec->execute(array($id_article));
  return $rec->fetch();
}
?>