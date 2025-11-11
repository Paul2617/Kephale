<?php
// Sécurisation de la configuration de session
ini_set('session.use_strict_mode', value: true);       // Empêche la réutilisation des anciens ID
ini_set('session.use_only_cookies', value: true);      // Interdit les sessions via URL (SID)
ini_set('session.cookie_httponly', value: true);       // Rend le cookie inaccessible en JS
ini_set('session.cookie_secure', value: isset($_SERVER['HTTPS'])); // Seulement en HTTPS
ini_set('session.cookie_samesite', 'Strict'); // Empêche CSRF (Strict ou Lax)

//header("X-Frame-Options: SAMEORIGIN");

//header("X-Content-Type-Options: nosniff");

//header("Referrer-Policy: no-referrer-when-downgrade");
//header("Content-Security-Policy-Report-Only: default-src 'self'; ...");
//header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com;style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com;img-src 'self' data: https:;font-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com;connect-src 'self';frame-ancestors 'self';base-uri 'self';");

// Nom personnalisé pour la session
session_name("KEPHALE_SECURE_SESSION");
session_start();

setlocale(LC_TIME, 'fr_FR');
define('BASE_URL', '/public/');
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../html/html.php';
require_once __DIR__ . '/../html/html_nav_bar.php';
require_once __DIR__ . '/../html/retoure.php';
require_once __DIR__ . '/../html/img_file.php';
use lib\Router;
?>
<!DOCTYPE html>
<html lang="fr">
<script src="/public/js/theme.js" defer></script>
<script src="/public/js/app.js" defer></script>
<?php
$router = Router::handleRequest($_SERVER['REQUEST_URI']);
?>

</html>