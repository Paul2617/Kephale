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
    $psa = $bd->prepare("SELECT etat FROM psa WHERE id_boutique = ? ");
    $psa->execute([$id_boutique]);
    if ($psa->rowCount() > "0" ){
        $resulte = $psa->fetch(PDO::FETCH_ASSOC);
        $etat =  $resulte ['etat'];
        if($etat === '1' ){
            if($prix_finale  <= 500000){
                $pourcentages = 8;
            }elseif($prix_finale  <= 1000000 AND $prix_finale > 500000){
                $pourcentages = 10;
            }elseif($prix_finale  <= 50000000 AND $prix_finale > 1000000){
                $pourcentages = 12;
            }
            $poursantage_kephale = ($pourcentages / 100) * $prix_finale;
            return $poursantage_kephale;
        }else{
            return null;
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

     if ($psa_enregistre === "non" ){
    // verifie si la boutique est gratuit avec psk
     $psa = $bd->prepare("SELECT etat FROM psa WHERE id_boutique = ? ");
     $psa->execute([$id_boutique]);
      // Verifie si le psa est retire ou pas dans le compte de la boutique ou pas
     if ($psa->rowCount() > "0" ){
         $resulte = $psa->fetch(PDO::FETCH_ASSOC);
         $etat =  $resulte ['etat'];
         if($etat === '0' ){

            if($prix_article_final  <= 500000){
                $pourcentages = 8;
            }elseif($prix_article_final  <= 1000000 AND $prix_article_final > 500000){
                $pourcentages = 10;
            }elseif($prix_article_final  <= 50000000 AND $prix_article_final > 1000000){
                $pourcentages = 12;
            }
            $poursantage_kephale = ($pourcentages / 100) * $prix_article_final;
            $new_priex_boutique =  $prix_article_final - $poursantage_kephale ;
            $new_psa = $poursantage_kephale ;
            $id_deduit = $id_boutique;
            $new_psa_finale =  $new_psa ;
         }
     }else{
        $new_priex_boutique = $prix_article_final ;
        $new_psa_finale =  "non";
     }

    }else{
        $new_priex_boutique = $prix_article_final;
        $new_psa = $psa_enregistre ;
        $id_deduit = $_SESSION["id"];
        $new_psa_finale =  $new_psa ;
     }
     // Retirer le montant totale dans le solde de user
     $stmt = $bd->prepare('UPDATE user SET solde = solde - ? WHERE id = ? ');
     $stmt->execute(array($totale_achat, $_SESSION["id"]));


                  
     // Ajoute le montant de l'article dans le solde de la boutique
     $stmt = $bd->prepare('UPDATE boutique SET solde = solde + ? WHERE id = ? ');
     $stmt->execute(array($new_priex_boutique, $id_boutique));

     // Ajoute le psa sur le compte kephale
     if(isset($new_psa)){
        $apikephale = "2025777333";
        $stmt = $bd->prepare("UPDATE kephale SET solde = solde + ? WHERE api = ? ");
        $stmt->execute(array($new_psa, $apikephale));
       
        // Ajoute a la liste de transictions
        $motif = 'psa';
        $date_transaction = time();
        $idkephale = "1";
        $stmt = $bd->prepare("INSERT INTO transactions (id_deduit, id_ajout, montant, motif, date_transaction ) VALUES (?,?,?,?,?)");
        $stmt->execute(array($id_deduit,  $idkephale, $new_psa, $motif , $date_transaction));
     }
     // ajoutre achat
     $oui = 'oui';
     $etat_livraison = 'non';
     $stmt = $bd->prepare("INSERT INTO liste_achat (id_user, id_article, id_boutique, prix_article, psa, promo, total, taille, date_achat, date_livraison, etat_livraison, user, boutique ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
     $stmt->execute(array($_SESSION["id"],  $id_article, $id_boutique, $prix_article, $new_psa_finale, $promo_final, $totale_achat, $taille, $date_transaction, $date_livraisons, $etat_livraison, $oui, $oui ));

    
     if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        return true ;
    }
    $stmt->closeCursor();
}
?>