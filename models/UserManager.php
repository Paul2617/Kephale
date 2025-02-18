<?php
require_once ('../models/bd/Model.php');

function infoUser($bd){
    $info_use = recTableId ( $bd, 'user' , 'id', $_SESSION["id"]);
    return $info_use ;
}
//verifie si user a une boutique
function infoUserBoutiqu($bd){
    //si la user a une boutique
    $boutiqueEtat = recRowCount($bd, 'boutique', 'id_user', $_SESSION["id"]);
    if($boutiqueEtat === 1){
        return 'boutique';
    }else{
        //verifi si la demande de creation de boutique est envoye
        $demandeEnvoir = recRowCount($bd, 'demande','id_user', $_SESSION["id"]);
        if( $demandeEnvoir === 1){
            //verifi si la demande est valide 
           $etatDemande = recTableId ($bd, 'demande', 'id_user', $_SESSION["id"]);
           if($etatDemande["etat"] === 1){
             //verifi si la si il y a un abonnement au compte de user
             $abonnementexiste = recRowCount($bd, 'abonnement','id_user', $_SESSION["id"]);

             if($abonnementexiste === 1){
                return 'crtboutique';
             }else{
                return 'abonnement';
             }
           }else{
            return 'demande';
           }
        }else{
            return 'demande';
        }
    }
    
}
    ?>