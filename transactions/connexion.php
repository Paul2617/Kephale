<?php
// Nettoyer et valider le numéro de téléphone
$phone = preg_replace('/[^0-9]/', '', $telephone);
// Hachage sécurisé du mot de passe
$code = sha1($passwor_usre);
$connexion = new connexion();
if(strlen($phone) === 8){
    $verifi_info =  $connexion->verifi_info($phone, $code);
    if($verifi_info === true){

    }else{
        $erreur = $verifi_info;
    }
}else{
    $erreur = 'Numéro invalide';
}

?>