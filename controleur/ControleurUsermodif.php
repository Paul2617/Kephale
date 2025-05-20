<?php
$info_user = info_user ($bd); 

$nom_user = $info_user["nom_user"];
$tel_user = str_replace(' ', '', $info_user["tel_user"])  ;
$code_user = $info_user["code_user"];
$img_user = $info_user["img_user"];

if(isset($_POST["modifie"]) ){
// modification du nom
    if(isset($_POST["new_nom"])){
        $new_nom = htmlspecialchars($_POST["new_nom"]);
        }
        if(isset($new_nom)){
            if($new_nom !== $nom_user ){
            new_nom_user($bd, $new_nom);
        }
        }
// modification du telephone
        if(isset($_POST["new_tel"])){
            $new_tel = str_replace(' ', '', $_POST["new_tel"]);
            }
            if(isset($new_tel )){
                if($new_tel !== $tel_user ){
                    new_tel_user($bd, $new_tel);
                }
            }
//modifications de code
if(isset($_POST["encien_password"]) and !empty($_POST["encien_password"]) and isset($_POST["new_password"]) and !empty($_POST["new_password"]) ){
    $new_password = htmlspecialchars ($_POST["new_password"]);
    $encien_password = sha1 ($_POST["encien_password"]);
    if($encien_password === $code_user){
        $new_password_user = sha1 ($new_password );

        if($new_password_user !== $encien_password ){
        new_code_user($bd, $new_password_user);
    }else{
        $erreur = ' Utilise un autre mot de passe.';
    }
    }else{
        $erreur = 'Mot de passe incorrect !';
    }

}
// modifie image de profile 

if(isset($_FILES["img_demande"]["name"]) and !empty($_FILES["img_demande"]["name"])){
    $new_img_user = $_FILES["img_demande"]["name"];

    if(isset( $new_img_user )){
            require_once "../models/img_verif/img_verif.php";
            $resultImg = img_verif();
    
            if($resultImg === 'format'){
                $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
            }elseif($resultImg === 'taille') {
                $erreur = "La taille de votre image dépasse 5 Mo. ";
            }else{
                $img_direction = "../public/asset/img_user/";
            $img_suprime_user = $img_direction . $img_user;
            $new_img_user_final = $img_direction . $resultImg;
            if($img_user !== 'logo.png'){
   if (file_exists($img_suprime_user)) {
                unlink($img_suprime_user);
                if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_user_final)){

                    $new_img_user_finale = $resultImg;
                    new_img_user_final($bd, $new_img_user_finale);

                }
            }else{
                if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_user_final)){

                    $new_img_user_finale = $resultImg;
                    new_img_user_final($bd, $new_img_user_finale);

                }
            }
            }elseif($img_user === 'logo.png'){
                $img_direction = "../public/asset/img_user/";
                $new_img_user_final = $img_direction . $resultImg;
                    if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $new_img_user_final)){

                    $new_img_user_finale = $resultImg;
                    new_img_user_final($bd, $new_img_user_finale);

                }
            }
         
            }

    }
}

}
?>