<?php
namespace Services;


class Delait_livraison 
{
  public static function newDelaitLivraison ($delai_livraison ){
    if($delai_livraison === 0){
        return 3;
    }else{
        $_5_jours  = 432000; //5 jours
        $_10_jours  = 864000; //10 jours
        $_15_jours  = 1296000; //15 jours
        $_20_jours  = 1728000; //20 jours
        $_30_jours  = 2592000; //30 jours 1 mois
        $_60_jours  = 5184000; //60 jours 2 mois
        $_80_jours  = 6912000; //80 jours 2 mois 20 jr
        if ($delai_livraison === $_5_jours) {
            $Jour_delais = 5;
        }elseif($delai_livraison === $_10_jours){
            $Jour_delais = 10;
        }elseif($delai_livraison === $_15_jours){
            $Jour_delais = 15;
        }elseif($delai_livraison === $_20_jours){
            $Jour_delais = 20;
        }elseif($delai_livraison === $_30_jours){
            $Jour_delais = 30;
        }elseif($delai_livraison === $_60_jours){
            $Jour_delais = 60;
        }elseif($delai_livraison === $_80_jours){
            $Jour_delais = 80;
        }
    return $Jour_delais;
    }
  }


public static function newCalculeLivraison ($date_achats, $date_livraison){
    if($date_livraison === 0){ $new_date = 259200;}
    else{$new_date = $date_livraison;}
    $new_date_livraison = $new_date + $date_achats;
    $time = time();
    // si la limite n'est pas arrive

    if($time > $new_date_livraison){return false;}
    else{return true;}
}

}
 ?>