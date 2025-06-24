<?php
header("Content-Type: application/json; charset=UTF-8");

require_once ('../models/solde_affiche/solde.php');
require_once ("../models/bd/Cntbd.php");
$Cntbd = new Cntbd();
$bd = $Cntbd->bd();

    try {
  $stmt = $bd->prepare('SELECT 
  article.id as id_article, 
  article.nom as nom, 
  article.prix as prix,
  article.descriptions as descriptions, 
  images_article.article_id as article_id,
  images_article.nom_image as nom_image  
  
  FROM article INNER JOIN images_article ON article.id = images_article.article_id ORDER BY article.date_creations DESC LIMIT 7');
  $stmt->execute([]);

  $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  foreach ( $article as  &$articles ) {
      $articles ['prix'] = solde($articles ['prix']);
  }

 echo json_encode($article);



}catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }








