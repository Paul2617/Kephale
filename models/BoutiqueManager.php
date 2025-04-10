<?php
function etatAbonnement($bd){
   $listeAbnnt = recTableId($bd, 'abonnement','id_user', $_SESSION["id"]);
   $listeAbnnt ["id_offre"];
   $infoOffre = recTableId($bd, 'offre','id', $listeAbnnt ["id_offre"]);
   $mode = $infoOffre ["mode"];
   if($mode ==='G'){
    return 'G';
   }elseif($mode ==='P'){
    $date_fin = $listeAbnnt ["date_fin"];
    $remaining_time = $date_fin - time();
    $remaining_days = floor($remaining_time / (24 * 60 * 60));
    if($remaining_days <= "0"){
return 'expire';
    }else{
        return  $remaining_days;
    }
   }
}

function infoBoutique($bd) {
   return recTableId($bd, 'boutique','id', $_SESSION["id_boutique"]);
}
// recupere les informations des categori
function infoCategorie($bd) {
    $categori = recRowCount($bd, 'categorie','id_boutique', $_SESSION["id_boutique"]);
    if($categori >= 1){
        return recTableIdBoucle($bd, 'categorie','id_boutique', $_SESSION["id_boutique"]);

    }else{
        return null;
    }
}

?>