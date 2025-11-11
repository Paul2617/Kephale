<?php
namespace NewClass;
use Lib\Data;
use PDO;
class Produit_paiementClass
{
  protected static function data()
  {
    return Data::data();
  }
  static  public function Produit_paiementClass()
    {
       return  'Produit_paiementClass'  ;  
    }
      static public function InfoProduit( int $id_v)
  {
    $data = self::data();
    $stmt = $data->prepare(
      "SELECT DISTINCT 
        pv.stock_qty,
        pv.price as price_pv,
        p.name as nom,
        p.description as descriptions,
        p.price as price_p,
        p.devise,
        p.id_boutique as id_boutique,
        p.id as id_produit,
        c.nom as nom_c,
        clr.nom as nom_color,
        clr.hex_code as hex_code,
        tl.nom as taille,
        af.type_abonnement,
        COALESCE(pp.promo, 'Aucune promo') AS promo,
        COALESCE(pp.debut, 'null') AS promo_debut,
        COALESCE(pp.fin, 'null') AS promo_fin,
        COALESCE(pp.statut, 'null') AS promo_statut
        FROM product_variants pv 
        INNER JOIN products p ON p.id = pv.product_id 
        INNER JOIN categories c ON c.id = p.category_id 
        INNER JOIN colors clr ON clr.id = pv.color_id
        INNER JOIN taille tl ON tl.id = pv.size_id
        INNER JOIN boutique b ON b.id = p.id_boutique
        INNER JOIN abonnement_facture af 
        ON af.id_user = b.id_user
        AND af.id = (SELECT MAX(id) FROM abonnement_facture WHERE  statut = 'true')
        LEFT JOIN produit_promo pp ON pp.id_produit = p.id 
        WHERE pv.id = ? AND pv.stock_qty >= 1 AND pv.active LIKE '1' AND p.active LIKE '1' "
    );
    $stmt->execute(array($id_v));
    if ($stmt->rowCount() === 1) {
      $products = $stmt->fetch(mode: PDO::FETCH_ASSOC);
      return $products;
    } else {
      return false;
    }
  }
  static public function CalculPromo( int $pourpourcentage, int $debut, int $fin, string $statut ){

  }
}
?>