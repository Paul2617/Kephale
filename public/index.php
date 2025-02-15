<?php 
session_start();
setlocale(LC_TIME, 'fr_FR');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kephalé</title>
</head>
<body>
<?php 


require_once ('../controleur/Routeur.php');
$router = new Routeur();
$router->routePublic();
?>
</body>
</html>
