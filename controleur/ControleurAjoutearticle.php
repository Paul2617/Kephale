<?php 

if(isset($_SESSION["id"]) and isset($_SESSION["id_boutique"]) and isset($_GET["id_categorie"]) and isset($_GET["id_produit"]) ){

           // $listeProduit = listeArticle($bd);
          $modeBoutique = modeBoutique ($bd);
          $typesProduit = typesProduit ($bd);
      


// debut POST   
        if (isset($_POST["ajouter"]) and !empty($_POST["ajouter"])){
            if (isset($_POST["nomArticle"]) and !empty($_POST["nomArticle"])){
                $nomArticle = htmlspecialchars($_POST["nomArticle"]);
                if (isset($_POST["prixArticle"]) and !empty($_POST["prixArticle"])){
                    $prixArticle = htmlspecialchars($_POST["prixArticle"]);
                    if (isset($_POST["descriptions_article"]) and !empty($_POST["descriptions_article"])){
                        $descriptions_article = htmlspecialchars($_POST["descriptions_article"]);
                        if($typesProduit === "Vêtement" || $typesProduit === "Chaussure"){
                            if (isset($_POST["options"]) and !empty($_POST["options"])){

                                $selectedOptions = implode(' ', $_POST['options']);
                                $tailles = str_replace(' ', '+', $selectedOptions);
                            }else{
                                $erreur = "Veuillez indiquer les tailles disponible";
                            }
                        }else{
                            $tailles = 'null';
                        }

                        if (isset($_POST["date_livraison"]) and !empty($_POST["date_livraison"])){
                            $date_livraison = htmlspecialchars($_POST["date_livraison"]);

                        }else {
                            $date_livraison = '0';
                        }
                        if (!empty($_FILES["img_demande"]["tmp_name"])){
                            require_once "../models/img_verif/img_verif.php";
                        $resultImg = img_verif();
                        if($resultImg === 'format'){
                            $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
                        }elseif($resultImg === 'taille') {
                            $erreur = "La taille de votre image dépasse 5 Mo. ";
                        }else{                           
                            $direction = "asset/img_article/";
                            $imgNom = $resultImg;
                            $imgDirection = $direction.$imgNom;
                        }
        
                        }else{
                            $erreur =  "Veuillez ajouter l'image de la catégorie";
                        }
                    }else{
                        $erreur =  "Veuillez indiquer la descriptions";
                    }
                   
                }else{
                    $erreur =  "Veuillez indiquer le prix de l'article";
                }
            }else{
                $erreur =  "Veuillez indiquer le nom de la catégorie";
            }
        }
// fin POST   




    if(isset( $tailles) and isset( $date_livraison ) and isset( $imgDirection ) ){
        if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $imgDirection)){
    
         $ajouteArticle = ajouteArticle($bd, $nomArticle, $descriptions_article, $prixArticle, $tailles, $imgNom, $date_livraison );
    
        if($ajouteArticle === true){
            header ('Location: /Kephale/article&id_categorie='.$_GET["id_categorie"].'&id_produit='.$_GET["id_produit"] );
        }
    }
    }






}else{
    header ('Location: /Kephale/boutique');
}

















?>