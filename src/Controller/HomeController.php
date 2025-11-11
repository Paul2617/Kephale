<?php
use NewClass\HomeClass;
use Middleware\Ip;

class HomeController
{
    private static $render;
    private static $page_home;

    public function __construct($parts_uri, $parts_uri_1 = null)
    {
        self::$render = $parts_uri;
        self::$page_home = $parts_uri_1;
    }

    public function HomeController()
    {
        // Détermine si HTTPS est utilisé
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        // Récupère le nom du domaine et le chemin
        $url_actuelle = $protocol . "://" . $_SERVER['HTTP_HOST'];
        HomeClass::HomeClass();
        $recherche = false;

        if (isset($_GET['search'])){
            $produit = HomeClass::produit_liste($_GET['search']);
        }else{
            $produit = HomeClass::produit_liste(false);
        }
        
        $ip_paye = Ip::ip_paye();
        $paye = $ip_paye['country_name'];

        $new_view = self::$render;
        $new_view_page = self::$page_home;
        if (empty($new_view_page)) {
            $view = __DIR__ . '/../../view/' . $new_view . '/index.php';
            if (file_exists($view)) {
                require_once $view;
            }
        } else {
            $new_view = __DIR__ . '/../../view/' . $new_view . '/' . $new_view_page . '/index.php';
            if (file_exists($new_view)) {
                require_once $new_view;
            } else {
                header('Location: /home');
            }
        }
    }
}
?>

