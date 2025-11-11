<?php
use NewClass\WebClass;

class WebController
{
    private static $render;
    private static $page_web;

    public function __construct($parts_uri, $parts_uri_1 = null)
    {
        self::$render = $parts_uri;
        self::$page_web = $parts_uri_1;
    }

    public function WebController()
    {
        $id_web = self::$page_web;
        $produit = WebClass::WebClass($id_web);
        $web_boutique_user = WebClass::web_boutique_user($id_web);
       // var_dump($web_boutique_user);


        $new_view = self::$render;
        $view = __DIR__ . '/../../view/' . $new_view . '/index.php';
        if (file_exists($view)) {
            require_once $view;
        } else {
        }
    }
}
?>
