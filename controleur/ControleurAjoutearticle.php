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
                                if (!empty($_FILES["images"]["name"][0])){
                                $selectedOptions = implode(' ', $_POST['options']);
                                $tailles = str_replace(' ', '+', $selectedOptions);
                                $imgDirection = "asset/img_article/";
                                }else{
                                    $erreur =  "Veuillez ajouter l'image de l'article";
                                }

                            }else{
                                $erreur = "Veuillez indiquer les tailles disponible";
                            }
                        }else{
                           
                            if (!empty($_FILES["images"]["name"][0])){
                                $imgDirection = "asset/img_article/";
                                $tailles = 'null';
                                }else{
                                    $erreur =  "Veuillez ajouter l'image de l'article";
                                }
                        }

                        if (isset($_POST["date_livraison"]) and !empty($_POST["date_livraison"])){
                            $date_livraison = htmlspecialchars($_POST["date_livraison"]);

                        }else {
                            $date_livraison = '0';
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


    if(isset( $tailles) and isset( $imgDirection) ){
       
        if (isset($_POST["date_livraison"]) and !empty($_POST["date_livraison"])){
            $date_livraison = $_POST["date_livraison"];
        }else{
            $date_livraison = '0';
        }
        require_once "../models/img_verif/imgPlus.php";

    }

}else{
    header ('Location: /Kephale/boutique');
}










?>