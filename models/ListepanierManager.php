<?php

function listePanie($bd){

    $rec_panie =  $bd->prepare('SELECT * FROM panie WHERE id_user = ? ');
    $rec_panie->execute(array($_SESSION["id"]));

    if($rec_panie->rowCount() > 0){
         $rec =  $bd->prepare('SELECT 
            panie.id as id_panie,
            article.id as id_article,
            article.nom as nom,
            article.descriptions as descriptions,
            article.prix as prix,
            ia.nom_image as nom_image  
            FROM panie 
            INNER JOIN article ON panie.id_article = article.id 
            LEFT JOIN ( SELECT ia1.article_id, ia1.nom_image
            FROM images_article ia1
            INNER JOIN ( SELECT article_id, MIN(id) AS min_id
            FROM images_article
            GROUP BY article_id ) ia2 ON ia1.id = ia2.min_id
            ) ia ON article.id = ia.article_id
            WHERE panie.id_user = ? ');

            $rec->execute(array($_SESSION["id"]));

        return  $rec->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return null;
    }
    $rec->closeCursor();
}

function supprimePanier($bd, $id_panie_post){
    $requestUri = $_SERVER['REQUEST_URI'];
      $supprimerPanier = $bd->prepare("DELETE FROM panie WHERE id_user = ? AND id LIKE '$id_panie_post' ");
      $supprimerPanier->execute(array($_SESSION["id"]));
      header("Location: ".$requestUri);
      exit;
}
?>