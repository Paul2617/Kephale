<?php
require_once ('config.php');
require_once ('autoload.php');

$Cookie = (new cookie())->validateSecureCookie();
$user_id = $Cookie["user_id"];

if($user_id === $_SESSION["id"]){
$uuid_5 = $Cookie ["user_key"];
$infoUsers = (new infoUsers())->infoUsers($uuid_5);

require_once ('../models/solde_affiche/solde.php');
$solde_user = solde($infoUsers["solde"] );

$localInfo = (new infoUsers())->localInfo();
$localInfos = $localInfo ["adresse"]; 
$panierInfo = (new infoUsers())->panierInfo();
$achatInfo = (new infoUsers())->achatInfo();

}
?>