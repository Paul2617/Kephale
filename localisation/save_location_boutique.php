<?php
session_start();
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $lat = htmlspecialchars($_POST['lat'] ) ?? null;
   $lon = htmlspecialchars($_POST['lon'])  ?? null;
   $pays = htmlspecialchars($_POST['pays'])  ?? null;
   $ville = htmlspecialchars($_POST['ville'])  ?? null;
   $quartier = htmlspecialchars($_POST['quartier'])  ?? null;
   $adresse = htmlspecialchars($_POST['adresse']) ?? null;

    if ($lat && $lon && $pays && $ville && $quartier && $adresse ) {
        // Traitement : enregistrer dans un fichier, une base de données, etc.

        require_once ('../transactions/eLocalisations.php');

        $eLocalisations = new eLocalisations();
        $eLocalisations ->eLocalisationsBoutique($lat, $lon, $pays, $ville, $quartier, $adresse );
        $requestUri = $_SERVER['REQUEST_URI'];
        header("Location: ".$requestUri );
        
        // file_put_contents("coords.txt", "Latitude: $lat, Longitude: $lon, Pays: $pays, Ville: $ville, Quartier: $quartier, Adresse: $adresse\n", FILE_APPEND);
    }
}
?>