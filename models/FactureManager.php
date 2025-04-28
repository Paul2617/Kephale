<?php 

function info_article($bd, $id_article){
    $info_article = $bd->prepare("SELECT * FROM article WHERE id = ? ");
    $info_article->execute([$id_article]);
    if ($info_article->rowCount() > 0 ){
        return $info_article->fetch(PDO::FETCH_ASSOC);
    }
}
function verife_promo($bd, $id_article, $prix){
    $verife_promo = $bd->prepare("SELECT * FROM promo_article WHERE id_article = ? AND etat LIKE 1 ");
    $verife_promo->execute([$id_article]);
    if ($verife_promo->rowCount() > 0 ){
        $verife = $verife_promo->fetch(PDO::FETCH_ASSOC);
        $pourcentage = $verife['pourcentage'];
         $pourcentage_prix = $prix / 100 ;
         $tr = $pourcentage_prix * 10 ;
         $trix_pourcentage = $prix - $tr ;
        return $verife;
    }else{
        return null;
    }
}
   // nom de la boutique
function  info_boutique($bd, $id_boutique){
    $info_boutique = $bd->prepare("SELECT nom FROM boutique WHERE id = ? ");
    $info_boutique->execute([$id_boutique]);
    if ($info_boutique->rowCount() > 0 ){
        $nom_boutique = $info_boutique->fetch(PDO::FETCH_ASSOC);
        return $nom_boutique['nom'];
    }else{
        return 'Boutique Inconnu';
    }
}
// nom image
function img_article ($bd, $id_article){
    $img_article = $bd->prepare("SELECT nom_image FROM images_article WHERE article_id = ? ORDER BY id ASC LIMIT 1 ");
    $img_article->execute([$id_article]);
    if ($img_article->rowCount() > 0 ){
        $img_articles = $img_article->fetch(PDO::FETCH_ASSOC);
        return $img_articles['nom_image'];
    }else{
        return 'logo.png';
    }

}

//PSA Poursantage sur achat verifications 
function psa ($bd, $id_boutique, $prix_finale){
    $boutique = 'boutique';
    $client = 'client';
    $psa = $bd->prepare("SELECT etat FROM psa WHERE id_boutique = ? ");
    $psa->execute([$id_boutique]);
    if ($psa->rowCount() > "0" ){
        $resulte = $psa->fetch(PDO::FETCH_ASSOC);
        $etat =  $resulte ['etat'];
        if($prix_finale  <= 10000){
            $pourcentages = 6;
        }elseif($prix_finale  <= 50000 AND $prix_finale > 10000){
            $pourcentages = 8;
        }elseif($prix_finale  <= 500000 AND $prix_finale > 50000){
            $pourcentages = 10;
        }elseif($prix_finale  <= 5000000 AND $prix_finale > 500000){
            $pourcentages = 12;
        }
        $poursantage_kephale = ($pourcentages / 100) * $prix_finale;
        // si c'est la boutique prend a charge psa poursantage sur achats
        if($etat === $boutique ){
            $psa = [
                'compte' => 'boutique',
                'pourcentages' => $poursantage_kephale 
            ];
            return $psa;
        }
        // si c'est le client prend a charge psa poursantage sur achats
        elseif($etat === $client) {
            $psa = [
                'compte' => 'client',
                'pourcentages' => $poursantage_kephale 
            ];
            return $psa ;
        }
    }else{
        return null;
    }
 
}

// verifi le code 
function verifiCode ($bd, $passwor_usre, $totale_achat){
    $code = sha1($passwor_usre);
    $id_user = $_SESSION["id"];
    $req_user = $bd->prepare("SELECT * FROM user WHERE code = ? AND id LIKE '$id_user' ");
    $req_user->execute([$code]);
    if ($req_user->rowCount() > "0" ){
        $resule = $req_user->fetch(PDO::FETCH_ASSOC);
        $solde_user = $resule["solde"]; 
        if($solde_user >= $totale_achat){
            return true ;
        }else{
            return 'Solde insuffisant.';
        }
    }else{
        return 'Le mot de passe est incorrect.';
    }
}

// transactions achat 
function achat_article ( $bd, $prix_article, $psa_enregistre, $id_boutique, $id_article, $date_livraisons, $prix_promo, $totale_achat, $taille ){
// Si la boutique nest pas en promo le prix de l'article reste la meme
    if ($prix_promo === "non"){
        $promo_final = 'non';
        $prix_article_final = $prix_article;
     }else{
        $prix_article_final = $prix_promo;
        $promo_final = $prix_promo;
     }

     if($psa_enregistre === null){
        $new_psa_client = 'non';
        $new_psa_boutique = 'non';
        $new_solde_retrait_client = $prix_article_final ;
        $new_solde_boutique =  $prix_article_final ;
     }
     // si le client qui prend en compte le psa
     elseif($psa_enregistre["compte"] === 'client'){
        $new_psa_client = $psa_enregistre["pourcentages"];
        $new_psa_boutique = 'non';
        $new_psa = $psa_enregistre["pourcentages"] ;
        $new_solde_retrait_client = $new_psa + $prix_article_final ;
        $new_solde_boutique =  $prix_article_final ;
     }
     // si la boutique qui prend en compte le psa
     elseif($psa_enregistre["compte"] === 'boutique'){
        $new_psa_client = 'non';
        $new_psa_boutique = $psa_enregistre["pourcentages"] ;
        $new_psa = $psa_enregistre["pourcentages"] ;
        $new_solde_retrait_client = $prix_article_final ;
        $new_solde_boutique =  $prix_article_final  - $new_psa;
     }
   
     // Retirer le montant totale dans le solde de user
     $stmt = $bd->prepare('UPDATE user SET solde = solde - ? WHERE id = ? ');
     $stmt->execute(array($new_solde_retrait_client, $_SESSION["id"]));
  

                  
     // Ajoute le montant de l'article dans le solde de la boutique
     $stmt = $bd->prepare('UPDATE boutique SET solde = solde + ? WHERE id = ? ');
     $stmt->execute(array($new_solde_boutique, $id_boutique));

     // Ajoute le psa sur le compte kephale
     $date_transaction = time();
     if(isset($new_psa)){
        $apikephale = "2025777333";
        $stmt = $bd->prepare("UPDATE kephale SET solde = solde + ? WHERE api = ? ");
        $stmt->execute(array($new_psa, $apikephale));
       
        // Ajoute a la liste de transictions
        $motif = 'psa';
        
        $idkephale = "1";
        $id_deduit = "1";
        $stmt = $bd->prepare("INSERT INTO transactions (id_deduit, id_ajout, montant, motif, date_transaction ) VALUES (?,?,?,?,?)");
        $stmt->execute(array($id_deduit, $idkephale, $new_psa, $motif , $date_transaction));
     }
     // ajoutre achat
     $oui = 'oui';
     $etat_livraison = 'non';
     $stmt = $bd->prepare("INSERT INTO liste_achat (id_user, id_article, id_boutique, prix_article, psa_user, psa_boutique, promo, total, taille, date_achat, date_livraison, etat_livraison, user, boutique ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
     $stmt->execute(array($_SESSION["id"],  $id_article, $id_boutique, $prix_article, $new_psa_client, $new_psa_boutique, $promo_final, $totale_achat, $taille, $date_transaction, $date_livraisons, $etat_livraison, $oui, $oui ));
    
     // ajoute entre boutique 
     $id_achat = $bd->lastInsertId();
     $motife = "achat";
     $stmt = $bd->prepare("INSERT INTO entre_boutique (id_boutique, id_achat, montant, motif, date_transaction ) VALUES (?,?,?,?,?)");
     $stmt->execute(array($id_boutique,  $id_achat, $new_solde_boutique, $motife , $date_transaction));
    
     // historique retrait de du compte
     $stmt = $bd->prepare("INSERT INTO achat_user (id_user, id_article, id_boutique, id_achat, prix_article, prix_promo, psa, total_retire, date_achat ) VALUES (?,?,?,?,?,?,?,?,?)");
     $stmt->execute(array($_SESSION["id"], $id_article, $id_boutique, $id_achat , $prix_article, $promo_final, $new_psa_client, $new_solde_retrait_client, time() ));

     if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        return true ;
    }
    $stmt->closeCursor();
}
?>