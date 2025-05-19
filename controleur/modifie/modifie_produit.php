<?php  

if(isset($_GET['id_produit'])){
    $id_produit = htmlspecialchars ($_GET['id_produit']);
}
if(isset($_GET['id_categorie'])){
    $id_categorie = htmlspecialchars ($_GET['id_categorie']);
}
// mofie les categorie ou supprimer touts les element de la categorie
// info de la categorie
if(isset($id_categorie)){
    $info_produit = info_produit($bd, $id_produit, $id_categorie);

    $nom_produit = $info_produit['nom_produit'];
    $types_produit = $info_produit['types_produit'];
    $img_produit = $info_produit['img_produit'];
}

if(isset($_POST['modifie_produit'])){
    if(isset($_POST['new_nom_produit']) and !empty ($_POST['new_nom_produit'])){
        $new_nom_produit = htmlspecialchars ($_POST['new_nom_produit']);
        if($new_nom_produit !== $nom_produit ){

            new_nom_produit($bd, $new_nom_produit,  $id_produit);
        }
    }

    if(isset($_POST['new_types_produit']) and !empty ($_POST['new_types_produit'])){
        $new_types_produit = htmlspecialchars ($_POST['new_types_produit']);
        if($new_types_produit !== $types_produit ){

            new_types_produit($bd, $new_types_produit,  $id_produit);
        }
    }

}

// modifie image de profile 

if(isset($_FILES["img_demande"]["name"]) and !empty($_FILES["img_demande"]["name"])){
    $new_img = $_FILES["img_demande"]["name"];{
        if(isset( $new_img )){
            require_once "../models/img_verif/img_verif.php";
            $resultImg = img_verif();
    
            if($resultImg === 'format'){
                $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
            }elseif($resultImg === 'taille') {
                $erreur = "La taille de votre image dépasse 5 Mo. ";
            }else{
                $img_direction = "../public/asset/img_produit/";
                $img_suprime_categori = $img_direction . $img_produit;
                $new_img_final = $img_direction . $resultImg;
                if (file_exists($img_suprime_categori)) {
                    unlink($img_suprime_categori);
                    if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_final)){
    
                        $new_img_produit_finale = $resultImg;
                        new_img_produit_final($bd, $new_img_produit_finale, $id_produit);
    
                    }
                }else{
                    if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_final)){
    
                        $new_img_produit_finale = $resultImg;
                        new_img_produit_final($bd, $new_img_produit_finale, $id_produit);
    
                    }
                }
            }
        }
    }
}

?>