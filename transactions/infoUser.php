<?php
require_once ('config.php');
require_once ('autoload.php');

$Cookie = (new cookie())->validateSecureCookie();
$user_id = $Cookie["user_id"];

if($user_id === $_SESSION["id"]){
$uuid_5 = $Cookie ["user_key"];
$infoUsers = (new infoUsers())->infoUsers($uuid_5);
}else{
    
}
?>