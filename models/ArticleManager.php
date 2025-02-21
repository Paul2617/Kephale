<?php
require_once ('../models/bd/Model.php');

function listeArticle ($bd){
   return  recTableIdBoucle($bd, 'article', 'id_produit', $_GET["id_produit"] );
 }

?>