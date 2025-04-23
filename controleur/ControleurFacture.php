<?php 
if(isset($_GET["taille"])){
$taille = $_GET["taille"];
}else{
    $taille = null;
}
if(isset($_GET["id_article"])){
    $id_article = $_GET["id_article"];
    }else{
       
    }
    $info_article = info_article($bd, $id_article);
    $prix = $info_article["prix"];
    $verife_promo = verife_promo($bd, $id_article, $prix);
// si l'article est en promo
    if($verife_promo !== null){
        $pourcentage =  $verife_promo["pourcentage"];
        $pourcentage_prix = $prix / 100 ;
        $tr = $pourcentage_prix * $pourcentage ;
        $prix_finale = $prix - $tr ;

    }else{
        $prix_finale = $prix ;
    }
    require_once ('../models/solde_affiche/solde.php');
    $Montan_prix = solde ($prix_finale);
    $Montane_prix = solde ($prix);
    $id_boutique = $info_article["id_boutique"];
    if($info_article["date_livraison"] === 0){
        $date_livraison = "3";
    }else{
        $date_livraison = $info_article["date_livraison"];
    }
    // nom de la boutique
    $nom_boutique = info_boutique ($bd, $id_boutique);
    // nom image
    $img_article = img_article ($bd, $id_article);

    //PSA Poursantage sur achat verifications 
    $psa = psa ($bd, $id_boutique, $prix);
    if($psa !== null ){
        $psa_prix = solde ($psa);
        $totale = $prix_finale + $psa;
        // totalle
        $total = solde ($totale);
    }else{
        $total = solde ($prix_finale);
    }


?>