<?php
namespace Img;
use NewClass\UserClass;
class VerifiImgUnique
{

    public static function img_user($img_profile)
    {
        $img_name = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
        $img_expentions = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;
        $img_direction = __DIR__ . "../../../assets/img_profil/";
        $tmp_name = $_FILES["image"]["tmp_name"];

        $photo = $_FILES["image"]["name"];
        $taille_fichier = filesize($_FILES["image"]["tmp_name"]);
        $taille_en_ko = $taille_fichier / 1024;
        $taille_en_mo = $taille_en_ko / 1024;
        round($taille_en_ko, 2);
        $maxFileSize = 5 * 1024 * 1024;
        $img_autorise = ['jpg', 'jpeg', 'png'];
        
        // Sécurisation : vérification de l'erreur d'upload
        if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
            return "Erreur lors de l'upload du fichier.";
        }
        
        // Sécurisation : validation du type MIME réel du fichier
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES["image"]["tmp_name"]);
        finfo_close($finfo);
        
        $mime_autorise = ['image/jpeg', 'image/jpg', 'image/png'];
        $img_expentions = strtolower($img_expentions);
        
        if (in_array($img_expentions, $img_autorise) && in_array($mime_type, $mime_autorise)) {
            if (round($taille_en_mo, 1) <= 5 && $taille_fichier <= $maxFileSize) {
                try {
                    $img_telecharge = $img_direction . $nom_img;
                    if ($img_profile !== 'profil.png') {
                        // Chemin de l'image à supprimer
                        $imagePath = __DIR__ . "/../../assets/img_profil/" . $img_profile;
                        if (file_exists($imagePath)){
                        unlink($imagePath);
                        }
                    }

                    $UserNewImg = UserClass::UserNewImg($nom_img);
                    if ($UserNewImg === true) {
                        if (move_uploaded_file($tmp_name, $img_telecharge)) {
                            header("Refresh:0");
                            return true;
                        } else {
                            return "Erreur lors du téléchargement de l'image.";
                        }
                    } else {
                        return "Impossible de mettre à jour l'image.";
                    }
                } catch (Exception $e) {
                    return "Impossible";
                }
            } else {
                return "La taille de votre image dépasse 5 Mo. ";
            }
        } else {
            return "Veuiller utiliser une image au format jpeg, jpg ou png";
        }


    }
}