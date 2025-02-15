<?php
require_once ('../models/bd/Model.php');
function connection ($bd, $telephone, $passwor_usre){
    $req_user = $bd->prepare("SELECT * FROM user WHERE tel = ? ");
    $req_user->execute([$telephone]);
    $resule_telephone = $req_user->rowCount();
    if ($req_user->rowCount() == true ) {
        $code = sha1($passwor_usre);
        $resule = $req_user->fetch(PDO::FETCH_ASSOC);
        if ($code  === $resule["code"]) {
            $_SESSION["id"] = $resule["id"];
            $info = 'valide';
        }else{
            $info = 'code_inconu';
        }
    }else{
        $info = 'numero_inconu';
    }

    return $info ;
}
?>