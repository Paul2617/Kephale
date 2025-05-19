<?php  

if(isset($_SESSION["id"]) and isset($_SESSION["id_boutique"])){


$info_boutique = info_boutique ($bd); 

if(isset($_POST["modifie"]) ){

if(isset($_POST["new_nom_boutque"])){
$new_nom_boutque = htmlspecialchars($_POST["new_nom_boutque"]);
}
    $nom_boutique = $info_boutique["nom_boutique"];
    $img_boutique = $info_boutique["img_boutique"];

if(isset($new_nom_boutque)){
    if($new_nom_boutque !== $nom_boutique ){
        new_nom_boutque($bd, $new_nom_boutque);
    }
}

if(isset($_FILES["img_demande"]["name"]) and !empty($_FILES["img_demande"]["name"])){
    $new_img_boutque = $_FILES["img_demande"]["name"];
}
if(isset( $new_img_boutque )){
        require_once "../models/img_verif/img_verif.php";
        $resultImg = img_verif();

        if($resultImg === 'format'){
            $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
        }elseif($resultImg === 'taille') {
            $erreur = "La taille de votre image dépasse 5 Mo. ";
        }else{
            $img_direction = "../public/asset/img_boutique/";
            $img_suprime_articles = $img_direction . $img_boutique;
            $new_img_boutque_final = $img_direction . $resultImg;
            if (file_exists($img_suprime_articles)) {
                unlink($img_suprime_articles);
                if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_boutque_final)){
                    $new_img_boutque_finale = $resultImg;
                    new_img_boutque_final($bd, $new_img_boutque_finale);

                }
            }else{
                if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_boutque_final)){
                    $new_img_boutque_finale = $resultImg;
                    new_img_boutque_final($bd, $new_img_boutque_finale);

                }
            }
        }
}
}



}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil');
}

?>