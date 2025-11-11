<?php
namespace Middleware ;

class SecurityCookie
{
      private static  $COOKIE_SECRET_KEY = "YIKgOrkil
oBYkblHqrSftEFjnQ1a+aiCcIzq+VjXE1Gy48Odi4nExecM8oEWCAuL9";
      private static  $COOKIE_NAME = "auth_token";
      private static  $COOKIE_EXPIRE = 30 * 24 * 60 * 60;

// Fonction pour cree un  cookie
 public static  function createSecurityCookie($user_id, $uuid_cinq) {
     if(empty($_COOKIE[self::$COOKIE_NAME])){
     // Données à stocker dans le cookie
     $cookie_data = [
        'user_id' => $user_id,
        'user_key' => $uuid_cinq,
        'date_time' => time()
     ];
    
     // Sérialisation et chiffrement des données
     $serialized_data = json_encode($cookie_data);
     $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
     $encrypted_data = openssl_encrypt(
        $serialized_data, 
        'aes-256-cbc', 
        self::$COOKIE_SECRET_KEY, 
        0, 
        $iv
     );
    
     // Combinaison des données chiffrées avec l'IV
     $cookie_value = base64_encode($iv . $encrypted_data);
    
     // Paramètres du cookie
     $secure = true; // Transmis seulement en HTTPS
     $httponly = true; // Inaccessible en JavaScript
     $samesite = 'Strict'; // Protection contre les attaques CSRF
    
     // Définition du cookie
     setcookie(
        self::$COOKIE_NAME,
        $cookie_value,
        time() + self::$COOKIE_EXPIRE,
        '/', // Chemin
        '', // Domaine
        $secure,
        $httponly
     );
     return true;
    
     }else{
        $nom_cookie =  self::$COOKIE_NAME;
       setcookie($nom_cookie,'',time() - 3600, '/','',true, true );
        return false;
     }
}

// Fonction pour lire et valider le cookie
 public static function validateSecurityCookie() {
    
     if (!isset($_COOKIE[self::$COOKIE_NAME])) {
        return false;
     }
  
     $cookie_value = $_COOKIE[self::$COOKIE_NAME];
     $decoded = base64_decode($cookie_value);
    
     // Extraire l'IV (16 octets pour AES-256-CBC)
     $iv_length = openssl_cipher_iv_length('aes-256-cbc');
     $iv = substr($decoded, 0, $iv_length);
     $encrypted_data = substr($decoded, $iv_length);
    
     // Déchiffrer les données
     $serialized_data = openssl_decrypt(
        $encrypted_data, 
        'aes-256-cbc', 
        self::$COOKIE_SECRET_KEY, 
        0, 
        $iv
     );

     if ($serialized_data === false) {
        return false;
     }

     $cookie_data = json_decode($serialized_data, true);
     
     // Validation des données
     if (!isset($cookie_data['user_id']) || !isset($cookie_data['user_key']) || !isset($cookie_data['date_time'])) {
         return false;
     }
    
     // Vérifier que le cookie n'est pas trop vieux (optionnel)
     if (time() - $cookie_data['date_time'] > self::$COOKIE_EXPIRE) {
        return 'Expire';
     }
    
     return [
        'user_id' => $cookie_data['user_id'],
        'user_key' => $cookie_data['user_key'],
        'date_time' => $cookie_data['date_time'],
     ];
}

// Fonction pour créer un cookie sécurisé
 public static function renouveleSecurityCookie($user_id, $user_key)    {

        // Données à stocker dans le cookie
     $cookie_data = [
        'user_id' => $user_id,
        'user_key' => $user_key,
        'date_time' => time()
     ];
    
     // Sérialisation et chiffrement des données
     $serialized_data = json_encode($cookie_data);
     $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
     $encrypted_data = openssl_encrypt(
        $serialized_data, 
        'aes-256-cbc', 
        self::$COOKIE_SECRET_KEY, 
        0, 
        $iv
     );

        // Combinaison des données chiffrées avec l'IV
     $cookie_value = base64_encode($iv . $encrypted_data);
    
     // Paramètres du cookie
     $secure = true; // Transmis seulement en HTTPS
     $httponly = true; // Inaccessible en JavaScript
     $samesite = 'Strict'; // Protection contre les attaques CSRF
    
     // Définition du cookie
     setcookie(
        self::$COOKIE_NAME,
        $cookie_value,
        time() + self::$COOKIE_EXPIRE,
        '/', // Chemin
        '', // Domaine
        $secure,
        $httponly
     );
     return true ;
}

// Fonction pour supprimer le cookie
 public static function deleteSecurityCookie() {
    $nom_cookie = self::$COOKIE_NAME;
    setcookie($nom_cookie,'',time() - 3600, '/','',true, true );
    return true;
}

 public static function verifieSecurityCookie (){

    $validateSecurityCookie = self::validateSecurityCookie();
    if($validateSecurityCookie !== false){
    $user_id = $validateSecurityCookie['user_id'];
    $user_key = $validateSecurityCookie['user_key'];
    $date_time = $validateSecurityCookie['date_time'];
    $cookie_expire = $date_time  + self::$COOKIE_EXPIRE;

    if($cookie_expire > time()) {
   
    if($_SESSION["id"] === $user_id ){
      $info = ["id" => $user_id ,"user_key" => $user_key ];
    return $info;
    }

       if(empty($_SESSION["id"])){
          $info = ["id" => $user_id ,"user_key" => $user_key ];
          return $info;
      }

     }else{
      // renouvele le cookie
      $renouveleSecurityCookie = self::renouveleSecurityCookie($user_id,  $user_key);
      if($renouveleSecurityCookie === true){
          $info = ["id" => $user_id ,"user_key" => $user_key ];
          return $info;
      }

      return false;
     }
     }else{
          return false;
     }
} 


// Fonction pour verifie le cookie
 public static function verifSecurityCookie() {

    if(isset($_COOKIE[self::$COOKIE_NAME])){
    return true;
    }else{
    return false;
    }
}


}

