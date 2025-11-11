<?php
namespace NewClass;
use Lib\Data;
use PDO;
class HomeClass
{
  protected static function data()
  {
    return Data::data();
  }

  static public function HomeClass()
  {

  }
  static public function produit_liste($recherche)
  {
    $data = self::data();
    if ($recherche === false) {
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
        WHERE p.active LIKE '1' AND af.statut LIKE 'true' ORDER BY RAND() LIMIT 50 "
      );
      $stmt->execute(array());
      if ($stmt->rowCount() >= 1) {
        $user = $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
        return $user;
      } else {
        return false;
      }
    } else {
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
}


?>

