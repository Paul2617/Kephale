<?php
    require_once ('../models/bd/Model.php');

function inscription($bd, $nom_user, $numerau_user, $password_user, $category ){

    $req_numeraux_existe = recRowCount($bd,'user', 'tel', $numerau_user);
    if( $req_numeraux_existe === 1){
        
        return  'numero_existe';
    }else{ 
        $nom_img = 'null';
        $solde_usre = "0";
        $code = sha1($password_user);
        $inser_user = $bd->prepare("INSERT INTO user ( nom, tel, img, sexe, code, solde) VALUES (?,?,?,?,?,?)");
        $inser_user->execute(array($nom_user, $numerau_user, $nom_img, $category, $code, $solde_usre));
        $inser_user->closeCursor();
        return  'ok' ;
    }
}
?>