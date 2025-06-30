<?php
class verifie_cookie_user
{
    protected function data (){
         $data = new data();
         $data = $data->data();
         return $data ;
    }

    public function verifie_cookie (){

$data = $this->data();
$cookie = new cookie();
$security = new security();
$validateSecureCookie = $cookie->validateSecureCookie();

$user_id = $validateSecureCookie['user_id'];
$user_key = $validateSecureCookie['user_key'];
$date_time = $validateSecureCookie['date_time'];
$cookie_expire = $date_time  + COOKIE_EXPIRE ;
$valide_user_Key = $security->valide_user_Key($user_key, $user_id, $data);

    if($valide_user_Key !== false){
if($cookie_expire > time()){
    if(!isset($_SESSION["id"])){
        $_SESSION["id"] = $valide_user_Key;
    }
    return true;
     }else{
        // renouve la cookie
       $cookie->renouvele_secureCooki($user_id, $user_key) ;
        if(!isset($_SESSION["id"])){
        $_SESSION["id"] = $valide_user_Key;
         }
        return true;
     }
        }else{

            $nom_cookie = COOKIE_NAME;
            $cookie->deleteSecureCookie($nom_cookie);
            return false;
     }


    } }


$verifie_cookie_user = new verifie_cookie_user();
$verifie_cookie = $verifie_cookie_user ->verifie_cookie();

if($verifie_cookie === true){
header ('Location: /Kephale/accueil');
}else{
    header ('Location: /Kephale/connection');
}

?>