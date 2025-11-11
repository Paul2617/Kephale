<?php
use NewClass\ProduitClass;

class ProduitController
{
    private static $render;
    private static $page_produit;
    public function __construct( $parts_uri, $parts_uri_1 = null  ) {
         self::$render = $parts_uri;
         self::$page_produit = $parts_uri_1 ;
        }

    public function ProduitController()
    {
    $id_produit = self::$page_produit;
    $produit = ProduitClass::ProduitClass($id_produit );
    $ProduitPromo = ProduitClass::ProduitPromo($id_produit);
    if($ProduitPromo === false){
        $prix_promo = 0 ;
    }else{
         $prix_promo = $ProduitPromo  ;
    }
    $variantes = $produit['variantes'];
    $images = $produit['images'];
    $devise = $produit['devise'];

    $taille_couleurs = [];
    foreach ($variantes as $v) {
    $taille_couleurs[$v['taille'] ][] = [
        'couleur' => $v['couleur'],
        'code' => $v['couleur_code'],
        'prix' => $v['prix'],
        'quantite' => $v['quantite'],
        'id' => $v['id']
    ];
}
//var_dump($produit);
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['acheter'])){

        if(isset($_POST['tailleSelect']) && isset($_POST['idProductVariants']) && isset($_POST['quantiteSelect'])){
        // Sécurisation : validation et sanitization des paramètres avant utilisation dans l'URL
        $idVariants = filter_var($_POST['idProductVariants'], FILTER_VALIDATE_INT);
        $quantiteSelect = filter_var($_POST['quantiteSelect'], FILTER_VALIDATE_INT);
        $deviseProduit = htmlspecialchars($produit['devise'], ENT_QUOTES, 'UTF-8');
        
        // Vérification que les valeurs sont valides
        if ($idVariants !== false && $quantiteSelect !== false && $quantiteSelect > 0) {
            header('Location: /produit_paiement?id_v='.$idVariants.'&qte='.$quantiteSelect.'&dvs='.urlencode($deviseProduit));
            exit;
        }
        }
        
    }
  }
     $new_view = self::$render; 
     $view = __DIR__ . '/../../view/'.$new_view.'/index.php';
     if (file_exists($view)){ require_once $view;}
    }
}
?>
