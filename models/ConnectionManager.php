<?php
require_once ('../models/Model.php');
function connection ($bd, $telephone, $passwor_usre){
    $req_user = $bd->prepare("SELECT * FROM utilisateur WHERE numero = ? ");
    $req_user->execute([$telephone]);
    $resule_telephone = $req_user->fetch(PDO::FETCH_ASSOC);

}
?>