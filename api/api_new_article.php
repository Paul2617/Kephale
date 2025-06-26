<?php
header("Content-Type: application/json; charset=UTF-8");

require_once ('../models/solde_affiche/solde.php');
require_once ("../models/bd/Cntbd.php");
$Cntbd = new Cntbd();
$bd = $Cntbd->bd();

    try {
  $stmt = $bd->prepare("SELECT 
  article.id as id_article, 
  article.nom as nom, 
  article.prix as prix,
  article.descriptions as descriptions, 
  ia.nom_image as nom_image  
  FROM article
    LEFT JOIN (
    SELECT ia1.article_id, ia1.nom_image
    FROM images_article ia1
    INNER JOIN (
        SELECT article_id, MIN(id) AS min_id
        FROM images_article
        GROUP BY article_id
    ) ia2 ON ia1.id = ia2.min_id
) ia ON article.id = ia.article_id


  INNER JOIN boutique ON article.id_boutique = boutique.id 
  WHERE boutique.pays LIKE 'Mali' 
  AND ( boutique.comptes LIKE 'actif')
  AND ( article.statut LIKE 'publie')
  ORDER BY article.date_creations DESC LIMIT 7");
  $stmt->execute([]);

  $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  foreach ( $article as  &$articles ) {
      $articles ['prix'] = solde($articles ['prix']);
  }

 echo json_encode($article);



}catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }








