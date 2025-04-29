<?php
function liste_achat($bd){
    $liste_achat = $bd->prepare("SELECT * FROM liste_achat WHERE id_user = ? AND user LIKE 'oui'  ORDER BY date_achat DESC ");
    $liste_achat->execute(array($_SESSION["id"]));
    if ($liste_achat->rowCount() > 0 ){
        return $liste_achat->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return null;
    }
}

function info_article($bd, $id_article){
    $info_article = $bd->prepare("SELECT nom, prix FROM article WHERE id = ? ");
    $info_article->execute([$id_article]);
    $info_articles = $info_article->fetch(PDO::FETCH_ASSOC);
    require_once ('../models/solde_affiche/solde.php');
    $prix_article = solde ($info_articles['prix']);

    $img_article = $bd->prepare("SELECT nom_image FROM images_article WHERE article_id = ? ORDER BY id ASC LIMIT 1 ");
    $img_article->execute([$id_article]);
    $img_articles = $img_article->fetch(PDO::FETCH_ASSOC);
    $img_articles['nom_image'];

    $info = 
    [
        'nom_article' => $info_articles['nom'], 
        'prix_article' => $prix_article, 
        'img_article' => $img_articles['nom_image']
    ];

    return $info ;
}

function recId ($bd,$id_article, $id_boutique){
    // articleInfo
    $articleInfo = $bd->prepare("SELECT id_categorie, id_produit FROM article WHERE id = ? ");
    $articleInfo->execute([$id_article]);
    $info_articleInfo = $articleInfo->fetch(PDO::FETCH_ASSOC);
    $info_articleInfo ['id_categorie'];
    $info_articleInfo ['id_produit'];
    $info = 
    [
        'id_categorie' => $info_articleInfo ['id_categorie'],
        'id_produit' => $info_articleInfo ['id_produit']
    ];

    return $info;
}

function confirmeLivraison($bd, $idArticleConfirme ){
    $oui = 'oui';
    $stmt = $bd->prepare('UPDATE liste_achat SET etat_livraison = ? WHERE id = ? ');
    $stmt->execute(array($oui, $idArticleConfirme ));

    $date_valide = time();
    $stmt = $bd->prepare("INSERT INTO dure_essaye (id_achat, date_valide) VALUES (?,?)");
    $stmt->execute(array($idArticleConfirme, $date_valide));

    if ($stmt->rowCount() !== 0) {
        return true ;
    }
}

function articlelivre($bd, $id_achat, $etat_livraison ){
    if($etat_livraison === 'oui'){
    $articlelivre = $bd->prepare("SELECT date_valide FROM dure_essaye WHERE id_achat = ? ");
    $articlelivre->execute([$id_achat]);
    $info_articlelivre = $articlelivre->fetch(PDO::FETCH_ASSOC);
    $date_valide = $info_articlelivre ['date_valide'];

    $temps_initial = 60 * 70; // 20 minutes en secondes
    $temp =  $date_valide + $temps_initial;
    $temps_passe = time() - $date_valide;
    $temps_restant = $temps_initial - $temps_passe;
    $chrono = gmdate("i", $temps_restant);

    $stmt = $bd->prepare("SELECT * FROM annule_achat_motife WHERE id_achat = ? ");
    $stmt->execute([$id_achat]);
    if($stmt->rowCount() > 0){
        $info_annule_achat_motife = $stmt->fetch(PDO::FETCH_ASSOC);
        $verdicte = $info_annule_achat_motife['verdicte']; 
        $info = 
        [
            'chrono' =>  $chrono ,
            'temp' =>  $temp ,
            'verdicte' =>  $verdicte 
        ];
    }else{
        $info = 
        [
            'chrono' =>  $chrono ,
            'temp' =>  $temp 
        ];
    }


    return $info ;
}else{
    return null;
}
}

function annulerLachatMotife($bd, $raisons, $id_achat, $id_boutique) {
   $verdicte = 'traitement';
   $date_valide = time();
   $stmt = $bd->prepare("INSERT INTO annule_achat_motife (id_achat, id_boutique, motife, verdicte, date_annule) VALUES (?,?,?,?,?)");
   $stmt->execute(array($id_achat, $id_boutique, $raisons, $verdicte, $date_valide ));
   if ($stmt->rowCount() !== 0) {
    return true ;
     }   
}
?>