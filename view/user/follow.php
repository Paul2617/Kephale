<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? 0;

// Ici tu mets à jour la base de données (toggle suivi)
// Exemple : si déjà suivi -> retirer, sinon ajouter

// Fake exemple
$result = [
  "id" => $id,
  "followed" => (bool)rand(0,1) // remplacer par vrai statut DB
];

echo json_encode($result);
