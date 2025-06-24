<?php
class connexion
{

    protected function data (){
         $data = (new data())->data();
         return $data ;
    }

    public function verifi_info ($phone, $code){
       
        $data = $this->data();
        $security = new security();
        $cookie = new cookie();
        $generer_cle = new generer_cle();
        // recupere l'adresse ip de l'utilistaeur 
        $get_client_ip = new get_client_ip ();
        $ip = $get_client_ip->get_client_ip();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        if(empty($_SESSION['cle_5'])){
           $_SESSION['cle_5'] = $generer_cle->generer_cle_5();
        }

        $cle_5 = $_SESSION['cle_5'];
        $nom_cookie = NOM_COOKIE_ATTEMPTS_EXPIRE;

         if (isset($_COOKIE[NOM_COOKIE_ATTEMPTS_EXPIRE])){
             $verifiCookieExporte = $cookie->verifiCookieExporte();
             $cle_cookie = $verifiCookieExporte['user_id'];
             $date_time = $verifiCookieExporte ['date_time'];
             $data_actuel = time();
             if($date_time > $data_actuel){
                http_response_code(400);
                return "Trop de tentatives, réessayez plus tard";
             }else{
               $security->clearOldAttempts($data, $cle_cookie);
               $cookie->deleteSecureCookie($nom_cookie);
             }
            }
        
        
        $rec = "SELECT 
        users.id as id,  
        users.password_user as password_user, 
        uuid.uuid_cinq as uuid_cinq  
        FROM users INNER JOIN uuid ON users.uuid_cle = uuid.uuid_cle 
        WHERE telephone = ?  ";

        $stmt = $data->prepare($rec);
        $stmt->execute([$phone]);
        if($stmt->rowCount() === 1){

            $resulte = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_user = $resulte ['id'];
            $code_user = $resulte ['password_user'];
            $uuid_cinq = $resulte ['uuid_cinq'];
            //echo $code_user.' - '.$code;
            if($code_user ===  $code){
                
            $createSecureCookie = $cookie->createSecureCookie($id_user, $uuid_cinq);

            if($createSecureCookie === true)
            {
                   $_SESSION["id"] = $id_user;
                   header ('Location: /Kephale/accueil');
                   exit();
            }
            }else{
              
                $recordFailedAttempt = $security->recordFailedAttempt($cle_5, $ip, $user_agent, $data);
                return 'Numéro ou Mot de passe incorrect !';
            }
        }else{
            $recordFailedAttempt = $security->recordFailedAttempt($cle_5, $ip, $user_agent, $data);
            return 'Numéro ou Mot de passe incorrect !';
        }
    }
}



?>