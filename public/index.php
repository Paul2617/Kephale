<?php 
session_start();
setlocale(LC_TIME, 'fr_FR');

?>

<?php 


require_once ('../controleur/Routeur.php');
$router = new Routeur();
$router->routePublic();
?>