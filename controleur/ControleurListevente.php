<?php


$liste_vente = liste_vente($bd);
if($liste_vente !== null){
    $liste_ventes = $liste_vente ; 
}

function tempsLivraisons($bd, $date_livraison, $date_achat){
    require_once ('../models/affiche_date/affiche_date.php');
    if($date_livraison === 3){

        $trois_joure = "259200";
        $dateActule = time();
        $datelimite = $date_achat + $trois_joure ;

        if( $datelimite  >  $dateActule ){
            $etatLivraion = 'oui';
        }else{
            $etatLivraion = 'non';
        }

        $dateLivraison = convertion_date($datelimite);
        $dateAchat = convertion_date($date_achat);
        $info = 
        [
            'etatLivraion' => $etatLivraion ,
            'dateLivraison' => $dateLivraison ,
            'dateAchat' => $dateAchat 
        ];
        return $info ;
    
    }else{
        $_5_jours  = 432000; //5 jours
        $_10_jours  = 864000; //10 jours
        $_15_jours  = 1296000; //15 jours
        $_20_jours  = 1728000; //20 jours
        if ($date_livraison === 5) {
            $Jour_delais = 432000;
        } elseif($date_livraison === 10) {
            $Jour_delais = 864000;
        }elseif($date_livraison === 15 ){
            $Jour_delais = 1296000;
        }elseif($date_livraison === 20 ){
                        $Jour_delais = 1728000;
        }
        $dateActule = time();
        $datelimite = $date_achat + $Jour_delais ;

        if( $datelimite  >  $dateActule ){
            $etatLivraion = 'oui';
        }else{
            $etatLivraion = 'non';
        }
        $dateLivraison = convertion_date($datelimite);
        $dateAchat = convertion_date($date_achat);

        $info = 
        [
            'etatLivraion' => $etatLivraion ,
            'dateLivraison' => $dateLivraison ,
            'dateAchat' => $dateAchat 
        ];
        return $info ;
    }
}
?>