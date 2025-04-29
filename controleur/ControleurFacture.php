<?php 
require_once ('../models/solde_affiche/solde.php');

if(isset($_GET["taille"])){
$taille = $_GET["taille"];
}else{
    $taille = 'null';
}
if(isset($_GET["id_article"])){
    $id_article = $_GET["id_article"];
    }else{
       
    }
    $info_article = info_article($bd, $id_article);
    $prix = $info_article["prix"];
    $Montane_prix = solde ($prix);

    $verife_promo = verife_promo($bd, $id_article, $prix);
// si l'article est en promo
    if($verife_promo !== null){
        $pourcentage =  $verife_promo["pourcentage"];
        $pourcentage_prix = $prix / 100 ;
        $tr = $pourcentage_prix * $pourcentage ;
        $prix_finale = $prix - $tr ;
        $prix_promo = $prix_finale ;
    }else{
        $prix_promo = 'non';
        $prix_finale = $prix ;
    }
    $Montan_prix = solde ($prix_finale);
    $id_boutique = $info_article["id_boutique"];
    if($info_article["date_livraison"] === 0){
        $date_livraison = "3 Jours";
        $date_livraisons = '3';
    }else{
         $info_article["date_livraison"];
         $date_livraisons = delai_livraison($info_article["date_livraison"]);
         $date_livraison ="La livraison peut prendre ".delai_livraison($info_article["date_livraison"])." jours. <br> Après l'achat, on procède à la commande à l'extérieur.<br>";
    }
    // nom de la boutique
    $nom_boutique = info_boutique ($bd, $id_boutique);
    // nom image
    $img_article = img_article ($bd, $id_article);

    //PSA Poursantage sur achat verifications 
    $psa = psa ($bd, $id_boutique, $prix_finale);
    if($psa !== null){
    if( $psa["compte"] === 'client' ){
        $psa_enregistre = $psa ;
        $psa_prix = solde ($psa["pourcentages"]);
        $totale = $prix_finale + $psa["pourcentages"];
         // totalle
        $total = solde ($totale);
        $totale_achat = $totale ;
    }
}else{
    $psa_enregistre = $psa ;
    $totale_achat = $prix_finale ;
    $total = solde ($prix_finale);
}
    if(isset($_POST["confirme"])){
        if (isset($_POST["password_user"]) and !empty($_POST["password_user"])){
            $passwor_usre = htmlspecialchars($_POST["password_user"]);
        }else{
            $erreur = 'Veuillez saisir le code.';
        }
    }
    if (isset( $passwor_usre ) and !empty($passwor_usre )){
        $verifiCode =  verifiCode ($bd, $passwor_usre, $totale_achat );
        if($verifiCode === true){
            $prix_article = $prix ;
            $achat_article =  achat_article ($bd, $prix_article, $psa_enregistre, $id_boutique, $id_article, $date_livraisons, $prix_promo, $totale_achat, $taille);
            if($achat_article === true){
                header ('Location: /Kephale/?url=userachat'  );
            }
        }else{
            $erreur =  $verifiCode ;
        }
    }
?>