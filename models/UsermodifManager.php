<?php
function info_user ($bd){
    $id_user = $_SESSION["id"];
    $stmt = $bd->prepare("SELECT * FROM user WHERE id = ? ");
    $stmt->execute([ $id_user ]);
    if ($stmt->rowCount() > 0){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $info_stmt["nom"];
        $img = $info_stmt["img"];
        $tel = $info_stmt["tel"];
        $sexe = $info_stmt["sexe"];
        $code =  $info_stmt["code"]; 
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
    $stmt = $bd->prepare('UPDATE user SET nom = ? WHERE id = ? ');
    $stmt->execute(array($new_nom, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}

function new_tel_user($bd, $new_tel){
    $stmt = $bd->prepare('UPDATE user SET tel = ? WHERE id = ? ');
    $stmt->execute(array($new_tel, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}

function new_code_user($bd, $new_password_user){

    $stmt = $bd->prepare('UPDATE user SET code = ? WHERE id = ? ');
    $stmt->execute(array($new_password_user, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}

function new_img_user_final($bd, $new_img_user_finale){
    $stmt = $bd->prepare('UPDATE user SET img = ? WHERE id = ? ');
    $stmt->execute(array($new_img_user_finale, $_SESSION["id"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}
?>