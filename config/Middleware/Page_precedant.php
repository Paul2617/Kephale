<?php
namespace Middleware;
class Page_precedant
{
    static function page_p()
    {
        $name = 'page_precedente';
        if (isset($_SERVER['HTTP_REFERER'])) {

            $url_precedente = $_SERVER['HTTP_REFERER'];
            // Détermine si HTTPS est utilisé
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
            // Récupère le nom du domaine et le chemin
            $url_actuelle = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            if (!isset($_COOKIE[$name])) {
                if( $url_precedente !== $url_actuelle ){
                    // Sécurisation : validation de l'URL avant de la stocker dans un cookie
                    $url_precedente = filter_var($url_precedente, FILTER_SANITIZE_URL);
                    if (filter_var($url_precedente, FILTER_VALIDATE_URL) !== false) {
                        setcookie($name, $url_precedente, time() + 3600, "/"); // valide 1h
                        $url = $url_precedente;
                        return $url;
                    }
                    return '/home';
                }else{
                    return '/home';
                } 
            }else{
                if( $url_precedente !== $url_actuelle ){
                    // Sécurisation : validation de l'URL avant de la stocker dans un cookie
                    $url_precedente = filter_var($url_precedente, FILTER_SANITIZE_URL);
                    if (filter_var($url_precedente, FILTER_VALIDATE_URL) !== false) {
                        setcookie($name, $url_precedente, time() + 3600, "/"); // valide 1h
                        $url = $url_precedente;
                        return $url;
                    }
                    return '/home';
                }else{
                    // Sécurisation : validation de l'URL du cookie avant utilisation
                    $url = filter_var($_COOKIE[$name], FILTER_SANITIZE_URL);
                    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                        return $url;
                    }
                    return '/home';
                }
            }
        }else{
            return '/home';
        }
        // Supprime le cookie en le faisant expirer immédiatement
  // setcookie("page_precedente", "", time() - 3600, "/");
    }
}