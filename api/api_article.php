<?php
header("Content-Type: application/json; charset=UTF-8");

require_once ('../models/solde_affiche/solde.php');
require_once ("../models/bd/Cntbd.php");
$Cntbd = new Cntbd();
$bd = $Cntbd->bd();

$input = json_decode(file_get_contents("php://input"), true);
//$recherche = isset($input['recherche']) ? trim($input['recherche']) : '';
$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';
    try {
if ($recherche === '') {
  $stmt = $bd->prepare('SELECT 
  article.id as id_article, 
  article.nom as nom, 
  article.prix as prix,
  article.descriptions as descriptions, 
  images_article.article_id as article_id,
  images_article.nom_image as nom_image  
  
  FROM article INNER JOIN images_article ON article.id = images_article.article_id ');
  $stmt->execute([]);

  $article = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ( $article as  &$articles ) {
      $articles ['prix'] = solde($articles ['prix']);
  }


 echo json_encode($article);

} else {
    
  $stmt = $bd->prepare("SELECT 
  article.id as id_article, 
  article.nom as nom, 
  article.prix as prix,
  article.descriptions as descriptions, 
  images_article.article_id as article_id,
  images_article.nom_image as nom_image  
   FROM article INNER JOIN images_article ON article.id = images_article.article_id 
   WHERE article.nom LIKE '%$recherche%' OR article.descriptions LIKE '%$recherche%'  LIMIT 50 ");
  $stmt->execute([]);
  $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ( $article as  &$articles ) {
      $articles ['prix'] = solde($articles ['prix']);
  }

 echo json_encode($article);

}

   






} catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }








