<?php
function convertion_date($temp_de_livraison)
{
    //jour
    $converty = date('l', $temp_de_livraison);

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
         
    $joure_chiffre = date('d', $temp_de_livraison);
    
    // affiche mois fr
    $converty_moi = date('F', $temp_de_livraison);
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
    $annee = date('Y', $temp_de_livraison);
    
    // affiche heur
    $heur_ = floor(($temp_de_livraison % (24 * 3600)) / 3600);
    
    // affiche minute
    $minute_ = floor(($temp_de_livraison % 3600) / 60);
    
 // affiche anne 2
    //$annee = strftime('%Y', $temp_de_livraison);

   $dateConverti = $Jours .' - '. $joure_chiffre .' - '. $Mois .' - '. $annee ;
    return $dateConverti;
}