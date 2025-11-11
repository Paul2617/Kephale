<?php
header('Content-Type: application/json');

// Exemple en dur (normalement tu récupères depuis MySQL)
echo json_encode([
  ["id"=>1, 
  "text"=>"Un texte assez long qui dépasse deux lignes pour tester la fonction Un texte assez long qui dépasse deux lignes pour tester la fonction Un texte assez long qui dépasse deux lignes pour tester la fonction Un texte assez long qui dépasse deux lignes pour tester la fonction.Un texte assez long qui dépasse deux lignes pour tester la fonction", 
  "likes"=>12, 
  "liked"=>true,
  "img" =>"Homme.jpg",
  "nom"  =>"Paul Koné",
  "followed"=> true
 ],
  ["id"=>2, 
  "text"=>"Un texte court.", 
  "likes"=>3, 
  "liked"=>false,
  "img" =>"Femme.jpg",
  "nom"  =>"Paul Koné",
  "followed"=> false
  ],
  ["id"=>3, 
  "text"=>"Un texte assez long qui dépasse deux lignes pour tester la fonction Un texte assez long qui dépasse deux lignes pour tester la fonction Un texte assez long qui dépasse deux lignes pour tester la fonction Un texte assez long qui dépasse deux lignes pour tester la fonction.Un texte assez long qui dépasse deux lignes pour tester la fonction", 
  "likes"=>5, 
  "liked"=>false,
  "img" =>"Enfant.jpg",
  "nom"  =>"Paul Koné",
  "followed"=> false
  ]
]);
