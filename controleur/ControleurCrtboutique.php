<?php
if(isset($_SESSION["id"])){
    if (isset($_POST["boutique"]) and !empty($_POST["boutique"])){
        if (isset($_POST["nomBoutique"]) and !empty($_POST["nomBoutique"])){
            $nomBoutique = htmlspecialchars($_POST["nomBoutique"]);
            if (isset($_POST["paye"]) and !empty($_POST["paye"])){
                $paye = htmlspecialchars($_POST["paye"]);
           if( $paye === 'Mali'){

        
            if (!empty($_FILES["img_demande"]["tmp_name"])) {
                require_once "../models/img_verif/img_verif.php";
                $resultImg = img_verif();
                if($resultImg === 'format'){
                    $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
                }elseif($resultImg === 'taille') {
                    $erreur = "La taille de votre image dépasse 5 Mo. ";
                }else{
                    $direction = "asset/img_boutique/";
                    $imgNom = $resultImg;
                    $imgDirection = $direction.$imgNom;
                }
            }else{
                $erreur = "Ajoutez le logo de la boutique.";
            }
   }else{
       $erreur = "Le ".$paye." a été temporairement suspendu.";
   }

        }else{
            $erreur =  "Veuillez indiquer votre paye.";
        }
        }else{
            $erreur =  "Veuillez indiquer le nom de la boutique.";
        }
    }
 

        if(isset( $imgDirection )){
            if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $imgDirection)){
              $abn = $_GET["abn"];
              $id_abt = $_GET["id_abt"];
              $inserdata = ajouteBoutique ($bd, $id_abt, $abn, $nomBoutique, $imgNom, $paye);
              if($inserdata === true){
                header ('Location: /Kephale/boutique' );
              }
            }
        }
    







}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
?>