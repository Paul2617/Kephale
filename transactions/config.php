<?php
// Configuration de sécurité
define('MAX_LOGIN_ATTEMPTS', 5);
define('NOM_COOKIE_ATTEMPTS_EXPIRE', 'login_attempts');
define('LOGIN_LOCKOUT_TIME', 15 * 60); // 15 minutes en secondes
define('MIN_TRANSACTION_AMOUNT', 0.01);
define('MAX_TRANSACTION_AMOUNT', 10000.00);
define('TRANSACTION_FEE_RATE', 0.01); // 1% de frais
define('CSRF_TOKEN_LIFETIME', 30 * 60); // 30 minutes

// Configuration de la base de données transaction
define('DB_HOST', 'localhost');
define('DB_NAME', 'transactions');
define('DB_USER', 'root');
define('DB_PASS', 'root');

//$host = "sql103.infinityfree.com";
//$dbname = "if0_38345177_kephale";
//$username = "if0_38345177";
//$password = "w7QYPEGftfkmxB";
// Configuration de la base de données kephale-groupe
define('DB_NAME_KEPHALE', 'kephale-groupe');
define('DB_USER_KEPHALE', 'root');
define('DB_PASS_KEPHALE', 'root');

// Configuration JWT (pour l'authentification API)
define('JWT_SECRET', 'pk4bd50af-1999-4f77-kephale-3z351486e1ml');
define('JWT_ALGORITHM', 'HS256');
define('JWT_EXPIRE', 3600); // 1 heure

// Configuration de sécurité de cookie
define('COOKIE_SECRET_KEY', 'cookie4bd50af-1999-4f77-kephale-3z351486e1ml'); // Changez cette valeur
define('COOKIE_NAME', 'auth_token');
define('COOKIE_EXPIRE', 30 * 24 * 60 * 60); // 30 jours en secondes

// Initialisation de la session sécurisée
function secure_session_start() {
    $session_name = 'secure_system';
    $secure = true; // HTTPS seulement
    $httponly = true; // Empêcher l'accès JavaScript
    
    ini_set('session.use_only_cookies', 1);
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(
        $cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly
    );
    session_name($session_name);
    session_start();
    session_regenerate_id(true); // Régénérer l'ID de session
}

?>