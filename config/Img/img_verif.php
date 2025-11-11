<?php

function img_verif (){

    // Sécurisation : vérification de l'erreur d'upload
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        return "Erreur lors de l'upload du fichier.";
    }

    $img_name = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
    $img_expentions = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;
    $img_direction = "public/asset/imgdemande/";

    $photo = $_FILES["image"]["name"];
    $taille_fichier = filesize($_FILES["image"]["tmp_name"]);
    $taille_en_ko = $taille_fichier / 1024;
    $taille_en_mo = $taille_en_ko / 1024;
    round($taille_en_ko, 2);
    $maxFileSize   = 5 * 1024 * 1024; 
    $img_autorise = ['jpg', 'jpeg', 'png'];
    
    // Sécurisation : validation du type MIME réel du fichier
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES["image"]["tmp_name"]);
    finfo_close($finfo);
    
    $mime_autorise = ['image/jpeg', 'image/jpg', 'image/png'];

    if (in_array($img_expentions, $img_autorise) && in_array($mime_type, $mime_autorise)) {
        if (round($taille_en_mo, 1) <= 5 && $taille_fichier <= $maxFileSize) {
            $img_telecharge = $img_direction . $nom_img;
            return $nom_img;
        }else{
            $erreur = "taille";
        }
    }else{
        $erreur = "format";
    }

    if(isset($erreur)){
        return  $erreur;
    }
}
 ?>