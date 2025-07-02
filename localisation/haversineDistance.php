<?php

function haversineDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km') {
    // Rayon de la Terre en kilomètres ou miles
    $earthRadius = ($unit === 'km') ? 6371 : 3958.8;

    // Convertir les degrés en radians
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Différences
    $deltaLat = $lat2 - $lat1;
    $deltaLon = $lon2 - $lon1;

    // Formule de Haversine
    $a = sin($deltaLat / 2) ** 2 +
         cos($lat1) * cos($lat2) * sin($deltaLon / 2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Distance
    $distance = $earthRadius * $c;

    return $distance;
}



 //$distanceKm = haversineDistance($lat1, $lon1, $lat2, $lon2);
 //echo "Distance : " . round($distanceKm, 2) . " km<br>";

 //$distanceMi = haversineDistance($lat1, $lon1, $lat2, $lon2, 'mi');
 //echo "Distance : " . round($distanceMi, 2) . " miles";


function calculerFraisLivraison($distanceKm, $tarifParKm = 200) {
    // Minimum 1 km facturé
    $distance = max($distanceKm, 1);

    // Calcul du prix
    $prix = $distance * $tarifParKm;

    // Arrondir à l’unité supérieure
    return ceil($prix); // en FCFA
}

// Exemple d’utilisation
 //$distance = 12.4; // en kilomètres (résultat de haversineDistance)
 //$frais = calculerFraisLivraison($distance);
 //echo "Frais de livraison : " . $frais . " FCFA";


function fraisParPalier($distanceKm) {
    if ($distanceKm <= 5) {
        return 1000;
    } elseif ($distanceKm <= 10) {
        return 1500;
    } elseif ($distanceKm <= 20) {
        return 2500;
    } elseif ($distanceKm <= 30) {
        return 4000;
    } else {
        return 6000 + ($distanceKm - 30) * 200; // surcharge par km au-delà de 30 km
    }
}

// Exemple d’utilisation
 //$distance = 25;
 //$frais = fraisParPalier($distance);
 //echo "Frais de livraison : " . $frais . " FCFA";

?>
