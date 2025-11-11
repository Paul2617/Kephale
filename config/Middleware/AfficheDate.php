<?php
namespace Middleware;


class AfficheDate 
{
  public static function newDateConveti ($data ){
        //jour
    $converty = date('l', $data);

    $day_of_week_fr = [
        'Sunday' => 'Dimanche',
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
    ];
    $Jours = $day_of_week_fr[$converty];

    // affiche Journe en chiffre
         
    $joure_chiffre = date('d', $data);
    
    // affiche mois fr
    $converty_moi = date('F', $data);
        $mois_fr = [
            'January' => 'Janvier',
            'February' => 'Février',
            'March' => 'Mars',
            'April' => 'Avril',
            'May' => 'Mai',
            'June' => 'Juin',
            'July' => 'Juillet',
            'August' => 'Août',
            'September' => 'Septembre',
            'October' => 'Octobre',
            'November' => 'Novembre',
            'December' => 'Décembre',
        ];

        $Mois = $mois_fr[$converty_moi];
    
    // affiche anne
    $annee = date('Y', $data);
    
    // affiche heur
    $heur_ = floor(($data % (24 * 3600)) / 3600);
    
    // affiche minute
    $minute_ = floor(($data % 3600) / 60);
    
 // affiche anne 2
    //$annee = strftime('%Y', $temp_de_livraison);

   $dateConverti = $Jours .' '. $joure_chiffre .' '. $Mois .' '. $annee ;
    return $dateConverti;

  }
}