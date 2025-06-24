<?php  
function info_user ($bd){
    $id_user = $_SESSION["id"];
    $stmt = $bd->prepare("SELECT * FROM user WHERE id = ? ");
    $stmt->execute([ $id_user ]);
    if ($stmt->rowCount() > 0){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $info_stmt["nom"];
        $img = $info_stmt["img"];
        $tel = $info_stmt["tel"];
        $sexe = $info_stmt["sexe"];
if($sexe === 'homme'){
    $sex = 'Homme';
}elseif($sexe === 'femme'){
    $sex = 'Femme';
}else{
    $sex = 'Enfant';
}
        $info = 
        [
            "nom_user" =>  $nom ,
            "img_user" =>  $img ,
            "tel_user" =>  $tel ,
            "sexe_user" =>  $sex 
        ];
        return $info ;
    }
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