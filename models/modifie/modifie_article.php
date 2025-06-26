<?php  
function info_article ($bd, $id_article, $id_produit, $id_categorie){
    $stmt = $bd->prepare("SELECT * FROM article WHERE id = ? ");
    $stmt->execute([ $id_article ]);
    if ($stmt->rowCount() > 0){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $info_stmt["nom"];
        $descriptions = $info_stmt["descriptions"];
        $tailles = $info_stmt["tailles"];
        $prix = $info_stmt["prix"];
        $date_livraison = $info_stmt["date_livraison"];
        $date_livraison = $info_stmt["date_livraison"];
        // info image
         $img = $bd->prepare("SELECT * FROM images_article WHERE article_id = ? LIMIT 1 ");
         $img->execute([ $id_article]);
         $info_img = $img->fetch(PDO::FETCH_ASSOC);
         $img_article = $info_img["nom_image"];
         // info produit

         $produit = $bd->prepare("SELECT * FROM produit WHERE id = ?");
         $produit->execute([ $id_produit]);
         $info_produit = $produit->fetch(PDO::FETCH_ASSOC);
         $types_produit = $info_produit["types"];

         require_once ('../models/BoutiqueManager.php');
         //etat de la boutique 

          $etatAbonnement = 'ok';

         // info finalle
        $info = 
        [
            "nom_article" =>  $nom ,
            "descriptions_article" =>  $descriptions ,
            "tailles_article" =>  $tailles ,
            "prix_article" =>  $prix ,
            "date_livraison_article" =>  $date_livraison ,
            "img_article" =>  $img_article, 
            "etatAbonnement" =>  $etatAbonnement, 
            "types_produit" =>  $types_produit
        ];

        return $info;
    }
}

function new_nom_article($bd, $id_article, $new_nom_article ){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE article SET nom = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($new_nom_article, $id_article, $id_boutique));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}


function new_prix_article($bd, $id_article, $new_prix_article ){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE article SET prix = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($new_prix_article, $id_article, $id_boutique));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}

function new_descriptions_article($bd, $id_article, $new_descriptions_article ){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE article SET descriptions = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($new_descriptions_article, $id_article, $id_boutique));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}


function new_delais($bd, $id_article, $new_delais ){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE article SET date_livraison = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($new_delais, $id_article, $id_boutique));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}

function new_tailles($bd, $id_article, $new_tailles ){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE article SET tailles = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($new_tailles, $id_article, $id_boutique));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}