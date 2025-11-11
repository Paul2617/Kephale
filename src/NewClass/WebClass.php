<?php
namespace NewClass;
use Lib\Data;
use PDO;
class WebClass
{

     protected static function data()
   {
      return Data::data();
   }
  static  public function WebClass($id_web)
    {
            $data = self::data();
      $sql = "SELECT id_boutique FROM boutique_web WHERE id_web = ? ";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id_web));
      if ($stmt->rowCount() === 1){
          $stmts = $stmt->fetch(PDO::FETCH_ASSOC);
          $id_boutique = $stmts['id_boutique'];
          $stmt = $data->prepare(
        "SELECT DISTINCT 
        p.id as id, p.name as nom, p.description as descriptions, 
        p.price as prix, p.devise, i.img as image, c.id as id_categori, c.nom as categori    
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
      $stmt->execute(array($id_boutique));
      if ($stmt->rowCount() >= 1) {
        $product_images = $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
        return $product_images;
      } else {
        return false;
      }
      }else{
         return false;
      }
    }

         static public function web_boutique_user($id_web){
      $data = self::data();
      $sql = "SELECT id_boutique FROM boutique_web WHERE id_web = ? ";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id_web));
      if ($stmt->rowCount() === 1){
          $stmts = $stmt->fetch(PDO::FETCH_ASSOC);
          $id_boutique = $stmts['id_boutique'];
          $stmt = $data->prepare(
        "SELECT b.nom as nom, b.img_profile as img, u.nom as user_nom 
        FROM boutique b  
        INNER JOIN user u ON u.id = b.id_user 
        WHERE b.id = ? "
      );
      $stmt->execute(array($id_boutique));
      if ($stmt->rowCount() >= 1) {
        $web_boutique_user = $stmt->fetch(mode: PDO::FETCH_ASSOC);
        return $web_boutique_user;
      } else {
        return false;
      }
      }else{
         return false;
      }
   }
}
?>