<?php
// Sécurisation de la configuration de session
ini_set('session.use_strict_mode', value: true);       // Empêche la réutilisation des anciens ID
ini_set('session.use_only_cookies', value: true);      // Interdit les sessions via URL (SID)
ini_set('session.cookie_httponly', value: true);       // Rend le cookie inaccessible en JS
ini_set('session.cookie_secure', value: isset($_SERVER['HTTPS'])); // Seulement en HTTPS
ini_set('session.cookie_samesite', 'Strict'); // Empêche CSRF (Strict ou Lax)
session_name("KEPHALE_SECURE_SESSION");
session_start();

setlocale(LC_TIME, 'fr_FR');
define('BASE_URL', '/public/');

require_once __DIR__ . '/../autoload.php';

use Lib\Data;

class Produit
{
    protected static function data()
    {
        return Data::data();
    }

    static public function produit_liste($recherche)
    {
        $data = self::data();
        // Sécurisation : utilisation de paramètres liés pour éviter l'injection SQL
        $rechercheParam = '%' . $recherche . '%';
         $stmt = $data->prepare(
        "SELECT DISTINCT p.id as id, p.name as nom, p.description as descriptions , p.price as prix, i.img as image   
        FROM products p  
        INNER JOIN product_images i ON i.product_id = p.id AND i.img_ordre = 'p'
        INNER JOIN boutique id_b ON id_b.id = p.id_boutique
        INNER JOIN abonnement_facture af 
        ON af.id_user = id_b.id_user 
        AND af.id = (
        SELECT MAX(id) FROM abonnement_facture 
        WHERE id_user = id_b.id_user AND statut = 'true') 
        INNER JOIN categories c ON c.id = p.category_id
        WHERE ( p.active LIKE '1' AND af.statut LIKE 'true' )
        AND ( p.name LIKE ? OR p.description LIKE ?)

        ORDER BY RAND() LIMIT 50 "
      );
      $stmt->execute(array($rechercheParam, $rechercheParam));
      if ($stmt->rowCount() >= 1){
        $user = $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
        return $user;
      }else{
         $stmt = $data->prepare(
        "SELECT DISTINCT p.id as id, p.name as nom, p.description as descriptions , p.price as prix, i.img as image   
        FROM products p  
        INNER JOIN product_images i ON i.product_id = p.id  AND i.img_ordre = 'p'
        INNER JOIN boutique id_b ON id_b.id = p.id_boutique
        INNER JOIN abonnement_facture af 
        ON af.id_user = id_b.id_user 
        AND af.id = (
        SELECT MAX(id) FROM abonnement_facture 
        WHERE id_user = id_b.id_user AND statut = 'true')
        INNER JOIN categories c ON c.id = p.category_id
        WHERE  p.active LIKE '1' AND af.statut LIKE 'true' 
        AND  (c.nom LIKE ? OR c.description LIKE ?)

        ORDER BY RAND() LIMIT 50 "
      );
        $stmt->execute(array($rechercheParam, $rechercheParam));
      if ($stmt->rowCount() >= 1){
        $user = $stmt->fetchAll( PDO::FETCH_ASSOC);
        return $user;
      }else{
         return false;
      }
      }
    }
}
if (isset($_GET['search'])) {
    // Sécurisation : sanitization de l'input avant utilisation
    $search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
    $produit_liste = Produit::produit_liste($search);
    header('Content-Type: application/json');
    echo json_encode($produit_liste);
    exit;
}else{
     echo json_encode([]);
    exit;
}