<?php
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


?>