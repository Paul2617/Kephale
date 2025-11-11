<?php
namespace Lib;
use Middleware\SecurityMiddleware;

class Router
{
    public static function handleRequest ($uri)
    {
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/'); 
        $parts = explode('/', $uri);

        // Correction : sanitizeInput fait déjà htmlspecialchars, pas besoin de le faire deux fois
        $parts_uri = SecurityMiddleware::sanitizeInput($parts[0] ?? '');
        $parts_uri_1 = SecurityMiddleware::sanitizeInput($parts[1] ?? '');
        $parts_uri_2 = SecurityMiddleware::sanitizeInput($parts[2] ?? '');
        $parts_uri_3 = SecurityMiddleware::sanitizeInput($parts[3] ?? '');
        $parts_uri_4 = SecurityMiddleware::sanitizeInput($parts[4] ?? '');
        $controllerName = ucfirst($parts_uri ?? 'home').'Controller';
        $controllerClass = __DIR__ . '/../src/Controller/'.$controllerName.".php";

            if (file_exists($controllerClass)) {
                 require_once $controllerClass;
                 (new $controllerName($parts_uri, $parts_uri_1, $parts_uri_2, $parts_uri_3, $parts_uri_4))->$controllerName($parts_uri);
                  exit;
                 }else{
                 header ('Location: /home');
                 exit;
            }

    }
}
