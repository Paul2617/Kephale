<?php
// Sécurisation de la configuration de session
ini_set('session.use_strict_mode', value: true);       // Empêche la réutilisation des anciens ID
ini_set('session.use_only_cookies', value: true);      // Interdit les sessions via URL (SID)
ini_set('session.cookie_httponly', value: true);       // Rend le cookie inaccessible en JS
ini_set('session.cookie_secure', value: isset($_SERVER['HTTPS'])); // Seulement en HTTPS
ini_set('session.cookie_samesite', 'Strict'); // Empêche CSRF (Strict ou Lax)

// Nom personnalisé pour la session
session_name("KEPHALE_SECURE_SESSION");
session_start();

setlocale(LC_TIME, 'fr_FR');
require_once __DIR__ . '../../../autoload.php';

use NewClass\UserClass;
use NewClass\BoutiqueClass;

if (isset($_GET['lat']) && isset($_GET['lon']) && isset($_GET['types']) ) {
    // Sécurisation : validation et sanitization des paramètres GET
    $lat = filter_var($_GET['lat'], FILTER_VALIDATE_FLOAT);
    $lon = filter_var($_GET['lon'], FILTER_VALIDATE_FLOAT);
    $types = filter_var($_GET['types'], FILTER_SANITIZE_STRING);
    
    // Vérification que les coordonnées sont valides
    if ($lat === false || $lon === false || !in_array($types, ['user', 'boutique'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Coordonnées ou type invalide']);
        exit;
    }
    
    // Sécurisation : échappement des valeurs dans l'URL
    $lat_escaped = htmlspecialchars($lat, ENT_QUOTES, 'UTF-8');
    $lon_escaped = htmlspecialchars($lon, ENT_QUOTES, 'UTF-8');
    $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" . urlencode($lat_escaped) . "&lon=" . urlencode($lon_escaped);

    // Initialiser la requête cURL (plus fiable que file_get_contents pour ce genre d’appel)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'GeoApp/1.0'); // obligatoire pour Nominatim
    $response = curl_exec($ch);
    curl_close($ch);

    // Décodage du JSON complet
    $data = json_decode($response, true);

    // Extraction des infos principales
    // Extraction des infos principales
    $ville = $data['address']['city'] ??
        $data['address']['town'] ??
        $data['address']['village'] ??
        $data['address']['municipality'] ??
        null;

    $quartier = $data['address']['suburb'] ??
        $data['address']['neighbourhood'] ??
        $data['address']['district'] ??
        null;

    $pays = $data['address']['country'] ?? null;
    $adresse = $data['display_name'] ?? null;

    // Réponse simplifiée

    $result = [
        'lat' => $lat,
        'lon' => $lon,
        'ville' => $ville,
        'quartier' => $quartier,
        'pays' => $pays,
        'adresse' => $adresse,
        'types' => $types
    ];
    if($types === 'user'){
         UserClass::UserLocalisation($result);
    }elseif($types === 'boutique'){
         BoutiqueClass::NewLocalisation($result);
    }

    // En-têtes pour le retour JSON
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Coordonnées manquantes']);
}
?>

