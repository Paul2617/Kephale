<?php
require_once ('../transactions/config.php');
require_once ('../transactions/autoload.php');
function info_user ($bd){
    
$Cookie = (new cookie())->validateSecureCookie();
$user_id = $Cookie ["user_id"];

  if($user_id === $_SESSION["id"]){
     $uuid_5 = $Cookie ["user_key"];
     $infoUsers = (new infoUsers())->infoUsers($uuid_5);
        $nom = $infoUsers["nom"];
        $img = $infoUsers["img"];
        $tel = $infoUsers["telephone"];
        $sexe = $infoUsers["sexe"];
        $code =  $infoUsers["password_user"]; 
if($sexe === 'homme'){
    $sex = 'Homme';
}elseif($sexe === 'femme'){
    $sex = 'Femme';
}else{
    $sex = 'Enfant';
}
        $info = 
        [
            "nom_user" =>  $nom ,
            "img_user" =>  $img ,
            "tel_user" =>  $tel ,
            "code_user" =>  $code ,
            "sexe_user" =>  $sex 
        ];
        return $info ;
    }
}

function new_nom_user($bd, $new_nom){
    $stmt = $bd->prepare('UPDATE users SET nom = ? WHERE id = ? ');
    $stmt->execute(array($new_nom, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}

function new_tel_user($bd, $new_tel){

    $stmt = $bd->prepare("SELECT COUNT(*) FROM users WHERE telephone = :phone");
    $stmt->execute([':phone' => $new_tel]);
    $cleExiste = (bool)$stmt->fetchColumn();

    if (!$cleExiste) {
  $stmt = $bd->prepare('UPDATE users SET telephone = ? WHERE id = ? ');
    $stmt->execute(array($new_tel, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
    }else{
        
    }
  
}

function new_code_user($bd, $new_password_user){

    $stmt = $bd->prepare('UPDATE users SET password_user = ? WHERE id = ? ');
    $stmt->execute(array($new_password_user, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}

function new_img_user_final($bd, $new_img_user_finale){
    $stmt = $bd->prepare('UPDATE users SET img = ? WHERE id = ? ');
    $stmt->execute(array($new_img_user_finale, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}
?>