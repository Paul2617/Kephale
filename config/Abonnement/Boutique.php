<?php
namespace Abonnement;
use Lib\Data;
use PDO;

class Boutique
{
      protected static function data()
  {
    return Data::data();
  }
    public static function infoOffre($param_type)
    {
        if ($param_type === 'Starter') {

            $tableau =
                [
                    'prix' => 0,
                    'poursantage' => 10,
                    'produit' => 10
                ];
            return   $tableau;
            exit;
        }elseif($param_type === 'Standard'){
            $tableau =
                [
                    'prix' => 5000,
                    'poursantage' => 7,
                    'produit' => 50
                ];
            return   $tableau;
            exit;

        }elseif($param_type === 'Pro'){
            $tableau =
                [
                    'prix' => 10000,
                    'poursantage' => 5,
                    'produit' => 500
                ];
            return   $tableau;
            exit;

        }elseif($param_type === 'Premium'){
            $tableau =
                [
                    'prix' => 25000,
                    'poursantage' => 3,
                     'produit' => 1000
                ];
            return   $tableau;
            exit;

        }
        return false;
        exit;
    }


}

?>
