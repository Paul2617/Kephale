<?php
if(isset($_SESSION["id"])){

    if (isset($_POST["demande"]) and !empty($_POST["demande"])) {
        if (!empty($_FILES["img_demande"]["tmp_name"])) {
            require_once "../models/img_verif/img_verif.php";
            $resultImg = img_verif();
            if($resultImg === 'format'){
                $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
            }elseif($resultImg === 'taille') {
                $erreur = "La taille de votre image dépasse 5 Mo. ";
            }else{
                $direction = "asset/imgdemande/";
                $imgNom = $resultImg;
                $imgDirection = $direction.$imgNom;
            }

        }else{
            $erreur = "Ajoutez une image de votre pièce d'identité";
    
        }
    
    }

    $model = "../models/".$controleur."Manager.php";
    if(file_exists($model)){
        require_once ($model);
        $infoUser = infoUser($bd);
       $etatDemande = verifEtat($bd);
        if(isset( $imgDirection )){
            if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $imgDirection)){
              $inserdata = inserdata ($bd, $_SESSION["id"], $imgNom);
              if($inserdata === true){
                $alt = 'Demande envoyer.';
                header ("Refresh: 2");
              }
            }
        }
    }















// Import la page de demande
$page = "../views/".$controleur."Page.php";

if(file_exists($page)){
    require_once ($page);
}
}else{
    header ('Location: /Kephale/accueil'  );
}












?>