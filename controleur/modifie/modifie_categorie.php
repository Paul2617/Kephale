<?php  

if(isset($_GET['id_categorie'])){
    $id_categorie = htmlspecialchars ($_GET['id_categorie']);
}
// mofie les categorie ou supprimer touts les element de la categorie
// info de la categorie
if(isset($id_categorie)){
    $info_categorie = info_categorie($bd, $id_categorie);
    $nom_categorie = $info_categorie['nom_categorie'];
    $types_categorie = $info_categorie['types_categorie'];
    $img_categorie = $info_categorie['img_categorie'];
}

if(isset($_POST['modifie_categorie'])){
    if(isset($_POST['new_nom_categorie']) and !empty ($_POST['new_nom_categorie'])){
        $new_nom_categorie = htmlspecialchars ($_POST['new_nom_categorie']);
        if($new_nom_categorie !== $nom_categorie ){

            new_nom_categorie($bd, $new_nom_categorie,  $id_categorie);
        }
    }

}

// modifie image de profile 

if(isset($_FILES["img_demande"]["name"]) and !empty($_FILES["img_demande"]["name"])){
    $new_img_categori = $_FILES["img_demande"]["name"];{
        if(isset( $new_img_categori )){
            require_once "../models/img_verif/img_verif.php";
            $resultImg = img_verif();
    
            if($resultImg === 'format'){
                $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
            }elseif($resultImg === 'taille') {
                $erreur = "La taille de votre image dépasse 5 Mo. ";
            }else{
                $img_direction = "../public/asset/img_categori/";
                $img_suprime_categori = $img_direction . $img_categorie;
                $new_img_categori_final = $img_direction . $resultImg;
                if (file_exists($img_suprime_categori)) {
                    unlink($img_suprime_categori);
                    if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_categori_final)){
    
                        $new_img_categori_finale = $resultImg;
                        new_img_categori_final($bd, $new_img_categori_finale, $id_categorie);
    
                    }
                }else{
                    if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_categori_final)){
    
                        $new_img_categori_finale = $resultImg;
                        new_img_categori_final($bd, $new_img_categori_finale, $id_categorie);
    
                    }
                }
            }
        }
    }
}

?>