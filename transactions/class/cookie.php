<?php
//require_once '../transactions/config.php';
class cookie 
{
// Fonction pour créer un cookie sécurisé
function renouvele_secureCooki($user_id, $user_key)    {
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
        COOKIE_SECRET_KEY, 
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
        COOKIE_NAME,
        $cookie_value,
        time() + COOKIE_EXPIRE,
        '/', // Chemin
        '', // Domaine
        $secure,
        $httponly
    );
    return true ;
}

function createSecureCookie($user_id, $uuid_cinq) {
    if(empty($_COOKIE[COOKIE_NAME])){
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
        COOKIE_SECRET_KEY, 
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
        COOKIE_NAME,
        $cookie_value,
        time() + COOKIE_EXPIRE,
        '/', // Chemin
        '', // Domaine
        $secure,
        $httponly
    );
    return true ;
    
    }else{
        $nom_cookie = COOKIE_NAME;
        $cookie = new cookie();
        $cookie->deleteSecureCookie($nom_cookie);
        return false ;
    }
}

function tantiveCookieExpire($cle_5){
    if (empty($_COOKIE[NOM_COOKIE_ATTEMPTS_EXPIRE])) {

    $cookie_data = 
    [
     'cle' => $cle_5,
     'date_time' => time() + LOGIN_LOCKOUT_TIME,
    ];

     // Sérialisation et chiffrement des données
    $serialized_data = json_encode($cookie_data);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted_data = openssl_encrypt(
        $serialized_data, 
        'aes-256-cbc', 
        COOKIE_SECRET_KEY, 
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
     if(
    setcookie(
        NOM_COOKIE_ATTEMPTS_EXPIRE,
        $cookie_value,
        time() + LOGIN_LOCKOUT_TIME,
        '/', // Chemin
        '', // Domaine
        $secure,
        $httponly
    )
     ){
    return 'setcookie';
     }

    }

}
function verifiCookieExporte(){
    if (!isset($_COOKIE[NOM_COOKIE_ATTEMPTS_EXPIRE])) {
        return false;
    }
    $cookie_value = $_COOKIE[NOM_COOKIE_ATTEMPTS_EXPIRE];
    $decoded = base64_decode($cookie_value);

      // Extraire l'IV (16 octets pour AES-256-CBC)
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decoded, 0, $iv_length);
    $encrypted_data = substr($decoded, $iv_length);

        // Déchiffrer les données
    $serialized_data = openssl_decrypt(
        $encrypted_data, 
        'aes-256-cbc', 
        COOKIE_SECRET_KEY, 
        0, 
        $iv
    );
    if ($serialized_data === false) {
        return false;
    };
    $cookie_data = json_decode($serialized_data, true);

    $date_time = $cookie_data['date_time'];

     return $cookie_data ;
}

// Fonction pour lire et valider le cookie
function validateSecureCookie() {
    
    if (!isset($_COOKIE[COOKIE_NAME])) {
        return false;
    }
    
    $cookie_value = $_COOKIE[COOKIE_NAME];
    $decoded = base64_decode($cookie_value);
    
    // Extraire l'IV (16 octets pour AES-256-CBC)
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decoded, 0, $iv_length);
    $encrypted_data = substr($decoded, $iv_length);
    
    // Déchiffrer les données
    $serialized_data = openssl_decrypt(
        $encrypted_data, 
        'aes-256-cbc', 
        COOKIE_SECRET_KEY, 
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
    if (time() - $cookie_data['date_time'] > COOKIE_EXPIRE) {
        return 'Expire';
    }
    
    return [
        'user_id' => $cookie_data['user_id'],
        'user_key' => $cookie_data['user_key'],
        'date_time' => $cookie_data['date_time'],
    ];
}


// Fonction pour supprimer le cookie
function verifie_cookie() {
    if (!isset($_COOKIE[COOKIE_NAME])) {
        return false;
    }
}

// Fonction pour supprimer le cookie
function deleteSecureCookie($nom_cookie) {
    setcookie(
        $nom_cookie,
        '',
        time() - 3600, // Date dans le passé
        '/',
        '',
        true, // secure
        true  // httponly
    );
    return true;
}
}






// Exemple d'utilisation
// Création du cookie après une connexion réussie
//$user_id = 123; // ID de l'utilisateur
//$user_key = bin2hex(random_bytes(32)); // Clé unique pour l'utilisateur (à stocker en base de données)

//createSecureCookie($user_id, $user_key);

// Validation du cookie lors des requêtes suivantes
//$cookie_data = validateSecureCookie();

//if ($cookie_data) {
//    echo "Utilisateur authentifié : ID = " . $cookie_data['user_id'];
    // Vérifier que la clé correspond à celle en base de données
//} else {   echo "Cookie invalide ou expiré"; }
// Suppression du cookie lors de la déconnexion
// deleteSecureCookie();
?>