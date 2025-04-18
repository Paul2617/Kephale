<?php 
session_start();
setlocale(LC_TIME, 'fr_FR');
$timestamp = date('Ymd');
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
    <title>Kephalé</title>
</head>
<body>
    <div class='body_2'>
<?php 
require_once ('../controleur/Routeur.php');
$router = new Routeur();
$router->routePublic();
?>

    </div>

</body>
</html>
