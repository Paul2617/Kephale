<?php  
function supprimer_produit($bd){
    $id_categorie = $_GET['id_categorie'];
  $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare("DELETE FROM produit WHERE id_categorie = ? AND id_boutique LIKE ? ");
    $stmt->execute(array($id_categorie, $id_boutique ));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        //header("refresh:1");
    }
}

  // supprimer_article_temp cette fonction consite a concerve l'article
function supprimer_article_temp($bd, $id_article, $id_image){
$id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare("DELETE FROM images_article WHERE id = ? AND id_boutique LIKE ? ");
    $stmt->execute(array($id_image, $id_boutique));
    $etat = 0;

    $stmt = $bd->prepare('UPDATE article SET etat = ? WHERE id = ? AND id_boutique LIKE ?  ');
    $stmt->execute(array($etat, $id_article, $id_boutique ));

//header("refresh:1");
}

// supprimer tous de l'article
function supprimer_article($bd, $id_article, $id_image){
$id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare("DELETE FROM images_article WHERE id = ? AND id_boutique LIKE ? ");
    $stmt->execute(array($id_image, $id_boutique ));

    $stmt = $bd->prepare("DELETE FROM article WHERE id = ? AND id_boutique LIKE ? ");
    $stmt->execute(array($id_article, $id_boutique ));

//header("refresh:1");
}

function supprimer_articles ($bd, $id_article){
    $id_boutique = $_SESSION["id_boutique"];
    $etat = 0;
    $stmt = $bd->prepare('UPDATE article SET etat = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($etat, $id_article,  $id_boutique ));
    header("refresh:1");

}

function  supprimer_categori($bd){
    $id_categorie = $_GET['id_categorie'];
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare("DELETE FROM categorie WHERE id = ? AND id_boutique LIKE ? ");
    $stmt->execute(array($id_categorie,  $id_boutique ));

    header ('Location: /Kephale/boutique'  );
}
?>