<?php
namespace NewClass;
use Middleware\AfficheDate;
use Abonnement\Boutique;
use Lib\Data;
use PDO;
class BoutiqueClass
{
   protected static function data()
   {
      return Data::data();
   }
   static public function BoutiqueIp(): string|null
   {
      // Liste des en-têtes à vérifier (ordre important)
      $keys = [
         'HTTP_CLIENT_IP',
         'HTTP_X_FORWARDED_FOR', // peut contenir une liste d'IPs
         'HTTP_X_FORWARDED',
         'HTTP_X_CLUSTER_CLIENT_IP',
         'HTTP_FORWARDED_FOR',
         'HTTP_FORWARDED',
         'REMOTE_ADDR'
      ];

      foreach ($keys as $key) {
         if (!empty($_SERVER[$key])) {
            $ipList = $_SERVER[$key];

            // HTTP_X_FORWARDED_FOR peut contenir plusieurs adresses séparées par des virgules
            if (strpos($ipList, ',') !== false) {
               $ips = array_map('trim', explode(',', $ipList));
            } else {
               $ips = [$ipList];
            }

            // Vérifie chaque ip et retourne la première IP publique valide
            foreach ($ips as $ip) {
               // enleve les espaces et les caractères non imprimables
               $ip = trim($ip);

               // Valider l'adresse IP (IPv4 ou IPv6)
               if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE | FILTER_FLAG_NO_PRIV_RANGE)) {
                  return $ip; // IP publique valide
               }
            }

            // Si aucune IP publique trouvée, on peut retourner la première IP valide (privée incluse)
            foreach ($ips as $ip) {
               $ip = trim($ip);
               if (filter_var($ip, FILTER_VALIDATE_IP)) {
                  return $ip;
               }
            }
         }
      }

      return 'null';

   }
   
   static public function genererCode($longueur = 7)
   {
      $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      $code = '';
      for ($i = 0; $i < $longueur; $i++) {
         $code .= $caracteres[random_int(0, strlen($caracteres) - 1)];
      }
      return $code;
   }

   static public function BoutiqueClass()
   {
      return 'BoutiqueClass';
   }

   static public function InfoBoutique()
   {
      $data = self::data();
      $id = $_SESSION['id'];
      $id_boutique = $_SESSION['id_boutique'];

      $sql_boutique = "SELECT * FROM boutique INNER JOIN boutique_portefeuille ON boutique.id = boutique_portefeuille.id_boutique WHERE boutique.id = ? AND boutique.id_user = ?  ";
      $stmt = $data->prepare($sql_boutique);
      $stmt->execute(array($id_boutique, $id));
      if ($stmt->rowCount() === 1) {
         $boutique = $stmt->fetch(PDO::FETCH_ASSOC);
         $usersBoutique =
            [
               'nom' => $boutique['nom'],
               'img_profile' => $boutique['img_profile'],
               'pays' => $boutique['pays'],
               'statut' => $boutique['statut'],
               'date_creation' => $boutique['date_creation'],
               'balance' => $boutique['balance'],
               'devise' => $boutique['devise'],
               'statut_solde' => $boutique['statut']
            ];
         return $usersBoutique;
      } else {
         return false;
      }
   }

   static public function InfoAbonnement()
   {
      $data = self::data();
      $id = $_SESSION['id'];
      $id_boutique = $_SESSION['id_boutique'];
      $sql = "SELECT * FROM abonnement_facture WHERE id_user = ? AND statut = ? LIMIT 1  ";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id, 'true'));
      if ($stmt->rowCount() === 1) {
         $facture = $stmt->fetch(PDO::FETCH_ASSOC);

         $now_time = time();
         $fin = $facture['fin'];
         // Différence en secondes
         $diff = $fin - $now_time;
         // Conversion en jours (arrondi vers le bas ou haut selon ton besoin)
         $daysRemaining = floor($diff / (60 * 60 * 24));

         $info = [
            'jour_restant' => $daysRemaining,
            'type_abonnement' => $facture['type_abonnement'],
            'debut' => AfficheDate::newDateConveti($facture['debut']),
            'fin' => AfficheDate::newDateConveti($facture['fin']),
            'abonnement_facture' => $facture['date_creation'],
            'statut' => $facture['statut']
         ];
         return $info;
      } else {
         return false;
      }
   }

   static public function ProduitRowCount($type_abonnement)
   {
      $data = self::data();
      $id_boutique = $_SESSION['id_boutique'];
      $sql = "SELECT id FROM products p WHERE p.id_boutique = ?";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id_boutique));
      $ProduitRowCount = $stmt->rowCount();
      $infoOffre = Boutique::infoOffre($type_abonnement);
      $produisLimite = $infoOffre['produit'];

      if ($type_abonnement === 'Pro') {
         return true;
      } elseif ($type_abonnement === 'Premium') {
         return true;
      } else {
         if ($ProduitRowCount <= $produisLimite) {
            return true;
         } else {
            return false;
         }
      }

   }

   static public function ListeProduit()
   {
      $data = self::data();
      $id_boutique = $_SESSION['id_boutique'];
      $sql = "SELECT  
      p.id AS produit_id, 
      p.name,
      i.img AS image_url FROM products p  LEFT JOIN product_images i ON i.product_id = p.id 
      AND i.img_ordre = 'p' WHERE p.id_boutique = ? ORDER BY p.id ";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id_boutique));
      if ($stmt->rowCount() >= 1) {
         $produit = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $produit;
      } else {
         return false;
      }

   }

   static public function statistique()
   {
      $data = self::data();
      $id_boutique = $_SESSION['id_boutique'];
      $sql_article = "SELECT id FROM products WHERE id_boutique = ? AND active LIKE '1' ";
      $stmt_article = $data->prepare($sql_article);
      $stmt_article->execute(array($id_boutique));

      $stastique = [
         'produits' => $stmt_article->rowCount()
      ];
      return $stastique;
   }
   static public function id_boutique_web($type_abonnement)
   {
      $genererCode = self::genererCode();
      $data = self::data();
      $id_boutique = $_SESSION['id_boutique'];
      $sql = "SELECT * FROM boutique_web WHERE id_boutique = ? ";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id_boutique));
      if ($stmt->rowCount() === 0) {
         $stmts = $data->prepare("INSERT INTO boutique_web ( id_boutique, id_web) VALUES (?,?)");
         if ($stmts->execute(array($id_boutique, $genererCode))) {
            return $genererCode;
         }
      } else {
         $id = $stmt->fetch(PDO::FETCH_ASSOC);
         $id_web = $id['id_web'];
         return $id_web;
      }
   }
   static public function InfoLocalisation()
   {

      $data = self::data();
      $id = $_SESSION['id_boutique'];
      $sql = "SELECT * FROM localisations WHERE id_compts = ? AND types LIKE 'boutique' ";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id));
      if ($stmt->rowCount() === 1) {
         $info = $stmt->fetch(PDO::FETCH_ASSOC);
         return $info;
      } else {
         return false;
      }

   }

   static public function NewLocalisation($result)
   {
      $data = self::data();
      $id = $_SESSION['id_boutique'];
      $ip = self::BoutiqueIp();
      $types = $result['types'];
      // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
      $sql = "SELECT id FROM localisations WHERE id_compts = ? AND types = ?";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id, $types));
      if ($stmt->rowCount() === 0) {
         $inserLocal = $data->prepare("INSERT INTO localisations (types, id_compts, latitude, longitude, pays, ville, quartier, adresse, ip ) VALUES (?,?,?,?,?,?,?,?,?)");
         $inserLocal->execute(array($types, $id, $result['lat'], $result['lon'], $result['pays'], $result['ville'], $result['quartier'], $result['adresse'], $ip));
         $inserLocal->closeCursor();
         return true;
      } else {
         // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
         $stmt = $data->prepare("UPDATE localisations SET latitude = ?, longitude = ?, pays = ?, ville = ?, quartier = ?, adresse = ?, ip = ? WHERE id_compts = ? AND types = ?");
         $stmt->execute(array($result['lat'], $result['lon'], $result['pays'], $result['ville'], $result['quartier'], $result['adresse'], $ip, $id, $types));
         return true;
      }
   }
}
?>

