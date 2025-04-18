<?php
// Exemple de tableau
$panier = [
    'produit_1' => 2,
    'produit_2' => 1,
    'produit_3' => 4,
];
// On stocke dans la session
$_SESSION['mon_panier'] = $panier;

if (isset($_SESSION['mon_panier'])) {
    $mon_panier = $_SESSION['mon_panier'];
    
    echo "<h3>Contenu du panier :</h3><ul>";
    foreach ($mon_panier as $produit => $quantite) {
        echo "<li>$produit : $quantite</li>";
    }
    echo "</ul>";
} else {
    echo "Aucun panier trouvé en session.";
}


// Supprime juste le panier
unset($_SESSION['mon_panier']);