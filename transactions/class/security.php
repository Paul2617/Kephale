<?php

class security {

        protected function data (){
         $data = new data();
         $data = $data->data();
         return $data ;
    }

    // Protection contre les attaques par force brute
    // Enregistrer une tentative de connexion échouée
    public function recordFailedAttempt($cle_5, $ip,  $user_agent, $data) {
        $cookie = new cookie();
        $select = "SELECT * FROM failed_login_attempts WHERE cle = ? ";
        $stmt = $data->prepare($select);
        $stmt->execute([$cle_5]);
        
         if($stmt->rowCount() === 1){
           $resulte = $stmt->fetch(PDO::FETCH_ASSOC);
           $max = $resulte['max']; 
           if($max < MAX_LOGIN_ATTEMPTS ){
             $stmt = $data->prepare(" UPDATE failed_login_attempts SET max = max + ? WHERE cle = ?");
             $stmt->execute([1, $cle_5 ]);
           }else {
            $tantiveCookieExpire = $cookie->tantiveCookieExpire($cle_5);
             return $tantiveCookieExpire ;
           }
         }else{
        $max =  1;
        $insert = "INSERT INTO failed_login_attempts (cle, ip_address, user_agent, max) VALUES (?, ?, ?, ?) ";
        $stmt = $data->prepare( $insert );
        $stmt->execute([$cle_5, $ip,  $user_agent,  $max]);
         }
    }


    
    // Nettoyer les anciennes tentatives
    public function clearOldAttempts($data, $cle_cookie) {
        $stmt = $data->prepare(" DELETE FROM failed_login_attempts WHERE cle = ?");
        $stmt->execute([$cle_cookie]);
        return true;
    }
    
    
    // Valider user key
    public static function valide_user_Key($user_key, $user_id, $data) {

        $stmt = $data->prepare("SELECT uuid_cle FROM uuid WHERE uuid_cinq = ? ");
        $stmt->execute([$user_key]);

         if($stmt->rowCount() === 1){
            $resulte = $stmt->fetch(PDO::FETCH_ASSOC);
            $uuid_cle = $resulte ['uuid_cle'];
             $stmt = $data->prepare("SELECT id FROM users WHERE uuid_cle = ? ");
             $stmt->execute([$uuid_cle]);
            if($stmt->rowCount() === 1){
            $resulte = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_users = $resulte ['id'];

            if($id_users ===   $user_id){
            return  $id_users ;
            }else{
                 return  false;
            }
                }else{
                     return  false;
                }
          
             return  false;
         }
          return  false;
    }
    
    // Valider le mot de passe
    public static function validatePassword($password) {
        return (strlen($password))>= 8;
    }
    
    // Générer un mot de passe sécurisé
    public static function generatePassword($length = 12) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?';
        return substr(str_shuffle($chars), 0, $length);
    }
    
    // Hacher le mot de passe
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
    
    // Vérifier le mot de passe
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    // Protection contre les injections SQL
    public function prepareQuery($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        return $stmt;
    }
}