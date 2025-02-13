<?php
require_once ('../controleur/Routeur.php');
$router = new Routeur();
$router->routePublic();
echo 'o';
?>