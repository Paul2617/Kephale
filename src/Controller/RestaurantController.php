<?php
use NewClass\RestaurantClass;

class RestaurantController
{
    private static $render;
    private static $page_restaurant;

    public function __construct( $parts_uri, $parts_uri_1 = null  ) {
         self::$render = $parts_uri;
         self::$page_restaurant = $parts_uri_1 ;
        }

    public function RestaurantController()
    {
    RestaurantClass::RestaurantClass();
     $new_view = self::$render; 
     $new_view_page = self::$page_restaurant;
      if(empty($new_view_page)){
            $view = __DIR__ . '/../../view/'.$new_view.'/index.php';
            if (file_exists($view)){ require_once $view;}
        }else{
            $new_view = __DIR__ . '/../../view/'.$new_view.'/'.$new_view_page.'/index.php';
            if (file_exists($new_view)){ require_once $new_view;}else{ header ('Location: /home');}
        }         
    }
}
?>