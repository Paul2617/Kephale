<?php
if(isset($_SESSION["id_boutique"])){
    if (isset($_POST["ajouter"]) and !empty($_POST["ajouter"])){
        if (isset($_POST["nomCategorie"]) and !empty($_POST["nomCategorie"])){
            $nomCategorie = htmlspecialchars($_POST["nomCategorie"]);
            if (isset($_POST["type_categorie"]) and !empty($_POST["type_categorie"])){
                if (!empty($_FILES["img_demande"]["tmp_name"])){
                    require_once "../models/img_verif/img_verif.php";
                $resultImg = img_verif();
                if($resultImg === 'format'){
                    $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
                }elseif($resultImg === 'taille') {
                    $erreur = "La taille de votre image dépasse 5 Mo. ";
                }else{
                    $type_categorie = htmlspecialchars($_POST["type_categorie"]);
                   
                    $direction = "asset/img_categori/";
                    $imgNom = $resultImg;
                    $imgDirection = $direction.$imgNom;
                }
                }else{
                    $erreur =  "Veuillez ajouter l'image de la catégorie";
                }
            }else{
                $erreur =  "Veuillez indiquer le type de la catégorie";
            }
        }else{
            $erreur =  "Veuillez indiquer le nom de la catégorie";
        }
    }


        if(isset($imgDirection)){
           $verifieCategori =  verifieCategori ($bd,  $type_categorie);
           if($verifieCategori === true){
            if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $imgDirection)){
            $ajoute_categori = ajoute_categori($bd, $nomCategorie, $type_categorie,$imgNom );
            if($ajoute_categori === true){
                header ('Location: /Kephale/boutique'  );
            }
        }
           }else{
            $erreur = "La catégorie pour ".$type_categorie." existe déjà.";
           }

        }
    






}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
?>