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
        return $prix;
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
function psa ($bd, $id_boutique, $prix){
    $psa = $bd->prepare("SELECT etat FROM psa WHERE id_boutique = ? ");
    $psa->execute([$id_boutique]);
    $resulte = $psa->fetch(PDO::FETCH_ASSOC);
    $etat =  $resulte ['etat'];
    if($etat === '1' ){
        if($prix  <= 500000){
            $pourcentages = 7;
        }elseif($prix  <= 1000000 AND $prix > 500000){
            $pourcentages = 10;
        }elseif($prix  <= 50000000 AND $prix > 1000000){
            $pourcentages = 15;
        }
        $poursantage_kephale = ($pourcentages / 100) * $prix;
        return $poursantage_kephale;
    }else{
        return null;
    }
}
?>