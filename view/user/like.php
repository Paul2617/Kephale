<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? 0;

// Ici tu mets à jour la base de données (toggle like)
// Exemple : si déjà aimé -> retirer, sinon ajouter
// Puis retourne le nouvel état

// Fake exemple
$result = [
  "id" => $id,
  "likes" => rand(1,20), // remplacer par vrai calcul
  "liked" => (bool)rand(0,1)
];

echo json_encode($result);
