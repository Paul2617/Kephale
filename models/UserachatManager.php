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
function  achat_annule($bd, $id_achat){
    
    $stmt = $bd->prepare("SELECT *  FROM achat_annule WHERE id_achat = ? ");
    $stmt->execute([$id_achat]);

    if ($stmt->rowCount() === 0) {
        return true ;
    }else{
        return false ;
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

    $temps_initial = 60 * 10; // 20 minutes en secondes
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


function  annule_achat ($bd, $id_achat ){
    $date_transaction = time();
    $stmt_liste_achat = $bd->prepare("SELECT * FROM liste_achat WHERE id = ? ");
    $stmt_liste_achat->execute([$id_achat]);

    if($stmt_liste_achat->rowCount() > 0){
        $info_achat = $stmt_liste_achat->fetch(PDO::FETCH_ASSOC);
        $prix_article = $info_achat['prix_article'];
        $id_user_client = $info_achat['id_user'];
        $promo = $info_achat['promo'];
        if($promo !== 'non'){
            $montan_ranbouse = $promo ;
        }else{
            $montan_ranbouse = $prix_article ;
        }
    }

    $stmt_boutique = $bd->prepare("SELECT solde FROM boutique WHERE id = ? ");
    $stmt_boutique->execute([$info_achat['id_boutique']]);
    if($stmt_boutique->rowCount() > 0){
        $info_boutique = $stmt_boutique->fetch(PDO::FETCH_ASSOC);
        $solde_boutique = $info_boutique['solde']; 
    }

    if($solde_boutique >= $montan_ranbouse ){
        // retire le montant de l'article dans le solde de la boutique
     $stmt = $bd->prepare('UPDATE boutique SET solde = solde - ? WHERE id = ? ');
     $stmt->execute(array($montan_ranbouse, $info_achat['id_boutique']));

      // ajoute le montant de l'article dans le solde du client
     $stmt = $bd->prepare('UPDATE user SET solde = solde + ? WHERE id = ? ');
     $stmt->execute(array($montan_ranbouse, $id_user_client ));

     // sorti boutique 
     $motif_boutique = 'La vante a été annulée par le client à cause du retard de livraison.';
     $stmt = $bd->prepare("INSERT INTO sorti_boutique (id_boutique, id_user, id_achat, montant, motif, date_transaction ) VALUES (?,?,?,?,?,?)");
     $stmt->execute(array($info_achat['id_boutique'], $id_user_client , $id_achat, $montan_ranbouse, $motif_boutique, $date_transaction));

      // entre client
      $motif_user = 'Vous avez annulé un achat pour cause de livraison en retard.';
      $stmt = $bd->prepare("INSERT INTO entre_user (id_user, id_boutique, id_achat, motif, montant, date_transaction ) VALUES (?,?,?,?,?,?)");
      $stmt->execute(array( $id_user_client,  $info_achat['id_boutique'], $id_achat, $motif_user,  $montan_ranbouse, $date_transaction));

      //achat annule
      $stmt = $bd->prepare("INSERT INTO achat_annule (id_achat) VALUES (?)");
      $stmt->execute(array( $id_achat));

      // Valide la livraison de l'article
      $etat_livraison = 'oui';
      $stmt = $bd->prepare('UPDATE liste_achat SET etat_livraison =  ? WHERE id = ? ');
      $stmt->execute(array($etat_livraison, $id_achat ));

      if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        return true ;
    }
    $stmt->closeCursor();
    }else{
       // si le montant de boutique est diferant 0 fcfa
        if($solde_boutique > '0'){
      // ajoute le montant de l'article dans le solde du client
      $stmt = $bd->prepare('UPDATE user SET solde = solde + ? WHERE id = ? ');
      $stmt->execute(array($montan_ranbouse, $id_user_client ));

      // Mettre le solde de la boutique a 0
      $solde = 0;
      $stmt = $bd->prepare('UPDATE boutique SET solde = ? WHERE id = ? ');
      $stmt->execute(array($solde, $info_achat['id_boutique']));
    
      // entre client
      $motif_user = 'Vous avez annulé un achat pour cause de livraison en retard.';
      $stmt = $bd->prepare("INSERT INTO entre_user (id_user, id_boutique, id_achat, motif, montant, date_transaction ) VALUES (?,?,?,?,?,?)");
      $stmt->execute(array( $id_user_client,  $info_achat['id_boutique'], $id_achat, $motif_user,  $montan_ranbouse, $date_transaction));

      // insere la boutique dont il le reste de l'argant
      $etat = 'non';
      $stmt = $bd->prepare("INSERT INTO boutique_reste ( id_boutique, id_user, id_achat, montant, date_envoy, etat ) VALUES (?,?,?,?,?,?)");
      $stmt->execute(array( $info_achat['id_boutique'], $id_user_client,  $id_achat, $montan_ranbouse, $date_transaction, $etat));
      $id_boutique_reste = $bd->lastInsertId();

      // insere montant retire 
      $stmt = $bd->prepare("INSERT INTO boutique_verse ( id_boutique_reste, montant, date_envoy) VALUES (?,?,?)");
      $stmt->execute(array( $id_boutique_reste ,$solde_boutique, $date_transaction));

      //achat annule
      $stmt = $bd->prepare("INSERT INTO achat_annule (id_achat) VALUES (?)");
      $stmt->execute(array( $id_achat));

      if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        return true ;
    }
    $stmt->closeCursor();

    }else{
        // si le solde de la boutique est de 0 fcfa

          // ajoute le montant de l'article dans le solde du client
      $stmt = $bd->prepare('UPDATE user SET solde = solde + ? WHERE id = ? ');
      $stmt->execute(array($montan_ranbouse, $id_user_client ));

        // entre client
        $motif_user = 'Vous avez annulé un achat pour cause de livraison en retard.';
        $stmt = $bd->prepare("INSERT INTO entre_user (id_user, id_boutique, id_achat, motif, montant, date_transaction ) VALUES (?,?,?,?,?,?)");
        $stmt->execute(array( $id_user_client,  $info_achat['id_boutique'], $id_achat, $motif_user,  $montan_ranbouse, $date_transaction));
  
        // insere la boutique dont il le reste de l'argant
        $etat = 'non';
        $stmt = $bd->prepare("INSERT INTO boutique_reste ( id_boutique, id_user, id_achat, montant, date_envoy, etat ) VALUES (?,?,?,?,?,?)");
        $stmt->execute(array( $info_achat['id_boutique'], $id_user_client,  $id_achat, $montan_ranbouse, $date_transaction, $etat));

        //achat annule
        $stmt = $bd->prepare("INSERT INTO achat_annule (id_achat) VALUES (?)");
        $stmt->execute(array( $id_achat));

      if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        return true ;
    }
    $stmt->closeCursor();
    }

    }
}
?>