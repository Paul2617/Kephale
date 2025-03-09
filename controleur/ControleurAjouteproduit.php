<?php 
  if (isset($_POST["ajouter"]) and !empty($_POST["ajouter"])){
    if (isset($_POST["nomCategorie"]) and !empty($_POST["nomCategorie"])){
        $nomProduit = htmlspecialchars($_POST["nomCategorie"]);
        if (isset($_POST["type_categorie"]) and !empty($_POST["type_categorie"])){
            if (!empty($_FILES["img_demande"]["tmp_name"])){
                require_once "../models/img_verif/img_verif.php";
            $resultImg = img_verif();
            if($resultImg === 'format'){
                $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
            }elseif($resultImg === 'taille') {
                $erreur = "La taille de votre image dépasse 5 Mo. ";
            }else{
                $type_produit = htmlspecialchars($_POST["type_categorie"]);
               
                $direction = "asset/img_produit/";
                $imgNom = $resultImg;
                $imgDirection = $direction.$imgNom;
            }
            }else{
                $erreur =  "Veuillez ajouter l'image du produit";
            }
        }else{
            $erreur =  "Veuillez indiquer le type du produit";
        }
    }else{
        $erreur =  "Veuillez indiquer le nom du produit";
    }
}

if(isset($_SESSION["id"]) and isset($_SESSION["id_boutique"]) and isset($_GET["id_categorie"])){
 
            if(isset($imgDirection)){
                if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $imgDirection)){
                $ajoute_categori = ajoute_produit($bd, $nomProduit, $type_produit, $imgNom);
                if($ajoute_categori === true){
                    header ('Location: /Kephale/produit&id_categorie='.$_GET["id_categorie"]  );
                }
            }
            }
            
        
}else{
    header ('Location: /Kephale/boutique');
}




?>