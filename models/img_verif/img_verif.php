<?php

function img_verif (){
    $img_name = pathinfo($_FILES["img_demande"]["name"], PATHINFO_FILENAME);
    $img_expentions = pathinfo($_FILES["img_demande"]["name"], PATHINFO_EXTENSION);
    $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;
    $img_direction = "public/asset/imgdemande/";

    $photo = $_FILES["img_demande"]["name"];
    $taille_fichier = filesize($_FILES["img_demande"]["tmp_name"]);
    $taille_en_ko = $taille_fichier / 1024;
    $taille_en_mo = $taille_en_ko / 1024;
    round($taille_en_ko, 2);
    $img_autorise = ['jpg', 'jpeg', 'png', 'PNG', 'JPG', 'JPEG'];
    if (in_array($img_expentions, $img_autorise)) {
        if (round($taille_en_mo, 1) <= 5) {
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