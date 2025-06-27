<?php 
session_start();
setlocale(LC_TIME, 'fr_FR');
$timestamp = date('Ymd');
$timestamp_ = time();

if (isset($_GET['i'])) {
    // Supprimer ?i=1 de l'URL via redirection propre
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: $url");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="public/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="public/style.css?v=<?=$timestamp?>">
<link rel="manifest" href="public/manifest.json">
 <link rel="apple-touch-icon" href="icons/logo.png" sizes="1512x512">
  <meta name="theme-color" content="#fff">

  <!-- Nom de l'app (utilisé sur Android) -->
<meta name="application-name" content="Kephalé">

<!-- iOS spécifique : plein écran -->
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="Kephalé">

<!-- Windows spécifique -->
<meta name="msapplication-TileColor" content="#0d6efd">

<!-- SEO (facultatif mais utile) -->
<meta name="description" content="Application Kephalé">
<meta name="author" content="Kephalé">
<meta name="keywords" content="Application web, mobile">

    <title>Kephalé</title>
 <script src="public/js/axios.min.js"></script>

</head>
<body>
    <div class='body_2'>

<?php 
require_once '../transactions/config.php';
require_once ('../transactions/autoload.php');
require_once ('../controleur/Routeur.php');
$router = new Routeur();
$router->routePublic();
?>

</div>
    </div>

  <script src="public/js/app.js" >

  </script>
</body>
</html>
