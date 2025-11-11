<?php
namespace Services;

class PoursantageKephale 
//'standard','electronique','restaurant','cosmetique','immobilier','auto','grand'
{
     private static $standard = 7;
     private static $electronique = 10;
     private static $restaurant = 10;
     private static $cosmetique = 10;
     private static $immobilier = 10;
     private static $auto = 10;

    public static function  poursantage ($boutique_statut, $boutique_type, $total){
   
        if($boutique_statut === 'certifie'){
             return false;
        }elseif($boutique_statut === 'standard' ){

          
        if($boutique_type === 'standard'){
           
                 $i = $total / 100 * self::$standard;
            }elseif($boutique_type === 'electronique'){
                   $i = $total / 100 * self::$electronique;
            }elseif($boutique_type === 'restaurant'){
                   $i = $total / 100 * self::$restaurant;
            }elseif($boutique_type === 'cosmetique'){
                   $i = $total / 100 * self::$cosmetique;
            }elseif($boutique_type === 'immobilier'){
                   $i = $total / 100 * self::$immobilier;
            }elseif($boutique_type === 'auto'){
                   $i = $total / 100 * self::$auto;
            }
           return $i;

         }

    }
}