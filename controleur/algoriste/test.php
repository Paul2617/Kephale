<?php
// Simuler une base de données simple pour démonstration
$fakeDatabase = ['chat', 'chien', 'oiseau', 'poisson'];

// Récupérer la recherche depuis l'URL ou un formulaire
$recherche = isset($_GET['q']) ? trim($_GET['q']) : '';

// Initialiser ou récupérer l'historique depuis le cookie
$historique = [];

if (isset($_COOKIE['historique_recherche'])) {
    $historique = json_decode($_COOKIE['historique_recherche'], true);
    if (!is_array($historique)) {
        $historique = [];
    }
}

// Vérifier si la recherche a un résultat
$resultat = [];
if ($recherche !== '') {
    foreach ($fakeDatabase as $item) {
        if (stripos($item, $recherche) !== false) {
            $resultat[] = $item;
        }
    }

    // Si résultat trouvé, ajouter à l'historique
    if (!empty($resultat)) {
        // Éviter les doublons
        if (!in_array($recherche, $historique)) {
            $historique[] = $recherche;
        }

        // Mettre à jour le cookie (durée : 30 jours)
        setcookie('historique_recherche', json_encode($historique), time() + (30 * 24 * 60 * 60), "/");
    }
}
?>