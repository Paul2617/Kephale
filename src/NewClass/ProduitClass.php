<?php
namespace NewClass;
use Lib\Data;
use PDO;
class ProduitClass
{

  protected static function data()
  {
    return Data::data();
  }
  static public function ProduitClass($id_produit)
  {
    $data = self::data();
    $sql = "   SELECT 
    p.id AS produit_id,
    p.name AS nom,
    p.description,
    p.price AS prix_global,
    p.devise,
     -- Variantes concaténées
      (
     SELECT GROUP_CONCAT(
        CONCAT(
            '{\"id\":', v.id,
            ',\"taille\":\"', t.nom,
            '\",\"couleur\":\"', c.nom,
            '\",\"couleur_code\":\"', c.hex_code,
            '\",\"prix\":', IFNULL(v.price, 'null'),
            ',\"quantite\":', IFNULL(v.stock_qty, 'null'), 
            '}'
        ) ORDER BY t.id SEPARATOR ','
    ) FROM product_variants v 
    LEFT JOIN taille t ON t.id = v.size_id
    LEFT JOIN colors c ON c.id = v.color_id
        WHERE v.product_id = p.id AND v.stock_qty >= 1 ) AS variantes,

    -- Images concaténées et ordonnées
  ( SELECT COALESCE( GROUP_CONCAT(
        CONCAT(
            '{\"id\":', i.id,
            ',\"image\":\"',  i.img,
            '\",\"ordre\":\"', IFNULL(i.img_ordre, 'p'), '\"}'
        ) ORDER BY FIELD(i.img_ordre, 'p','s') SEPARATOR ','
    ) , '')FROM product_images i
        WHERE i.product_id = p.id ) AS images

   FROM products p
   WHERE p.id = ?  GROUP BY 
    p.id, 
    p.name, 
    p.description, 
    p.price   LIMIT 1 ";
    $stmt = $data->prepare($sql);
    $stmt->execute(array($id_produit));
    if ($stmt->rowCount() > 0) {
      $produit = $stmt->fetch(PDO::FETCH_ASSOC);
      // Conversion en vrais tableaux JSON

      $produit['variantes'] = $produit['variantes']
        ? json_decode('[' . $produit['variantes'] . ']', true)
        : [];
      $produit['images'] = $produit['images']
        ? json_decode('[' . $produit['images'] . ']', true)
        : [];
      return $produit;
    } else {
      return true;
    }
  }

  static public function ProduitPromo($id_produit){
    $data = self::data();
    $stmt = $data->prepare("SELECT * FROM produit_promo WHERE id_produit = ? AND statut LIKE 'true' LIMIT 1 ");
    $stmt->execute(array($id_produit));
    if ($stmt->rowCount() === 1){
      $promo = $stmt->fetch(mode: PDO::FETCH_ASSOC);
      return  $promo;
    }else{
      return false;
    }
  }
}
?>

