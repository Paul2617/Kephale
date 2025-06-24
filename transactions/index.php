<?php
//header('Content-Type: application/json');
require_once 'autoload.php';

// transactions entre utilisateur 
$tration = new transaction();
//$users_trt = $tration->users_transactions();

// Gestion des requêtes
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = explode('/', trim($requestUri, '/'));

// Routeur
$resource = isset($requestUri[1]) ? $requestUri[1] : null;

if ($requestMethod === 'GET')
{
    // require 'inscription.php';
}

elseif($requestMethod === 'POST')
{
        switch ($resource) 
        {
            case 'connection':
                 require 'connexion.php';
                 break;
            case 'inscription':
                 require 'inscription.php';
                 break;
            default:
            echo 'Action inconnue';
        }
}
?>