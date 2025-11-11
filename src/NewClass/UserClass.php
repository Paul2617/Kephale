<?php
namespace NewClass;
use Lib\Data;
use PDO;
use PDOException;
class UserClass
{

  protected static function data()
  {
    return Data::data();
  }

  static public function UserClass()
  {
    return 'UserClass';
  }

  static public function UserIp(): string|null
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

  static public function UserInfo()
  {
    $data = self::data();
    $sqlUser = "SELECT * FROM user INNER JOIN user_portefeuille ON user.id = user_portefeuille.id_user WHERE user.id = ?  ";
    $stmt = $data->prepare($sqlUser);
    $id = $_SESSION['id'];
    $stmt->execute(array($id));
    if ($stmt->rowCount() === 1) {
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      $usersInfo =
        [
          'nom' => $user['nom'],
          'numero' => $user['numero'],
          'sexe' => $user['sexe'],
          'img_profile' => $user['img_profile'],
          'statut_user' => $user['statut'],
          'types' => $user['types'],
          'balance' => $user['balance'],
          'devise' => $user['devise'],
          'statut_solde' => $user['statut']
        ];
      //http_response_code(200);
      return $usersInfo;
    } else {
      return false;
    }
  }

  static public function UserNewNom($new_nom)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sql = "UPDATE user SET nom = ? WHERE id = ? ";
    $stmt = $data->prepare($sql);
    if ($stmt->execute(array($new_nom, $id))) {
      return header("Refresh:0");
    }
  }

  static public function UserNewNumero($new_telephone)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sql = "UPDATE user SET numero = ? WHERE id = ? ";
    $stmt = $data->prepare($sql);
    if ($stmt->execute(array($new_telephone, $id))) {
      return header("Refresh:0");
    }
  }

  static public function UserNewSex($new_sex)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sql = "UPDATE user SET sexe = ? WHERE id = ? ";
    $stmt = $data->prepare($sql);
    if ($stmt->execute(array($new_sex, $id))) {
      return header("Refresh:0");
    }
  }

  static public function UserNewImg($new_img)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sql = "UPDATE user SET img_profile = ? WHERE id = ? ";
    $stmt = $data->prepare($sql);
    if ($stmt->execute(array($new_img, $id))) {
      return true;
    }
  }

  static public function UserVerifiPassword($password)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    // Sécurisation : récupération du hash pour vérification avec password_verify
    $sqlUser = "SELECT password FROM user WHERE id = ?";
    $stmt = $data->prepare($sqlUser);
    $stmt->execute(array($id));
    if ($stmt->rowCount() === 1) {
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      $hashedPassword = $user['password'];
      // Support des anciens mots de passe SHA1 et nouveaux password_hash
      if (strlen($hashedPassword) === 40 && ctype_xdigit($hashedPassword)) {
        // Ancien format SHA1
        return (sha1($password) === $hashedPassword);
      } else {
        // Nouveau format avec password_hash
        return password_verify($password, $hashedPassword);
      }
    } else {
      return false;
    }
  }

  public static function infoUserBoutique()
  {
    $data = self::data();
    $sql = "SELECT nom FROM boutique WHERE id_user = ?  ";
    $stmt = $data->prepare($sql);
    $id = $_SESSION['id'];
    $stmt->execute(array($id));
    if ($stmt->rowCount() === 1) {
      $boutique = $stmt->fetch(PDO::FETCH_ASSOC);
      $nom = $boutique['nom'];
      if ($nom === 'nom') {
        return header('Location: /user/creation');
      } else {
        return header('Location: /boutique');
      }
    } else {
      return false;
    }
  }

  public static function infoCreationBoutique($nom_boutique, $pays, $img)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sql = "UPDATE boutique SET nom = ?, img_profile = ?, pays = ? WHERE id_user = ? ";
    $stmt = $data->prepare($sql);
    if ($stmt->execute(array($nom_boutique, $img, $pays, $id))) {
      $sqlBoutique = "SELECT id FROM boutique  WHERE id_user = ?";
      $stmt = $data->prepare($sqlBoutique);
      $stmt->execute(array($id));
      $boutique = $stmt->fetch(PDO::FETCH_ASSOC);
      $id_boutique = $boutique['id'];
      return $id_boutique;
    } else {
      return false;
    }
  }

  public static function UserInfoBoutique()
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sqlBoutique = "SELECT id, nom, img_profile, statut FROM boutique  WHERE id_user = ?";
    $stmt = $data->prepare($sqlBoutique);
    $stmt->execute(array($id));
    if ($stmt->rowCount() === 1) {
      $boutique = $stmt->fetch(PDO::FETCH_ASSOC);
      $_SESSION['id_boutique'] = $boutique['id'];
      if ($boutique['statut'] === 'true') {
        $statut = 'Valider';
      } else {
        $statut = 'Suspendu';
      }
      $info = [
        'id' => $boutique['id'],
        'nom' => $boutique['nom'],
        'img_profile' => $boutique['img_profile'],
        'statut' => $statut,
        'boutique' => true
      ];
      return $info;
    } else {
      $info = ['boutique' => false];
      return $info;
    }


  }

  public static function UserListeAchat()
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sql = " SELECT 
        la.id as id_achat,
        p.id as id_produit,
        v.id as id_variants,
        tr.id as id_transactions,
        p.name as nom_produit,
        p.price as prix_produit,
        v.price as prix_variants,
        t.nom as nom_taille,
        t.categorie as categorie_taille,
        c.nom as nom_colors,
        c.hex_code ,
        la.quantite,
        la.statut,
        tr.balance as prix_achat,
        tr.devise as devise,
        lc.latitude,
        lc.longitude,
        lc.pays as pays_boutique,
        lc.quartier,
        b.nom as nomBoutique,
        lc.ville,
        af.type_abonnement,
        IFNULL(bw.id_web, 'null') as id_web,
        i.img as image_p
        FROM liste_achat la 
        LEFT JOIN product_variants v ON v.id = la.id_variants
        LEFT JOIN transactions tr ON tr.id = la.id_transaction
        LEFT JOIN taille t ON t.id = v.size_id
        LEFT JOIN colors c ON c.id = v.color_id
        LEFT JOIN products p ON p.id = la.id_produit 
        LEFT JOIN boutique b ON b.id = p.id_boutique 
        LEFT JOIN boutique_web bw ON bw.id_boutique = p.id_boutique 
        LEFT JOIN abonnement_facture af ON af.id_user = b.id_user 
        LEFT JOIN localisations lc ON lc.id_compts = b.id AND lc.types LIKE 'boutique'
        INNER JOIN product_images i ON i.product_id = p.id AND i.img_ordre = 'p'
        WHERE la.id_user = ? AND la.user LIKE 'true' ORDER BY la.id DESC ";
    $stmt = $data->prepare($sql);
    $stmt->execute(array($id));
    if ($stmt->rowCount() >= 1) {
      $achat = $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
      return $achat;
    } else {
      return false;
    }
  }

  public static function UserInfoLocalisation()
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM localisations WHERE id_compts = ? AND types LIKE 'user' ";
    $stmt = $data->prepare($sql);
    $stmt->execute(array($id));
    if ($stmt->rowCount() === 1) {
      $info = $stmt->fetch(PDO::FETCH_ASSOC);
      return $info;
    } else {
      return false;
    }

  }

  public static function UserLocalisation($result)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $ip = self::UserIp();
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

  public static function UserLocalisationKilometre($id_achat)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
    $sql = "SELECT * FROM localisations_achat WHERE id_user = ? AND id_achat = ?";
    $stmt = $data->prepare($sql);
    $stmt->execute(array($id, $id_achat));
    if ($stmt->rowCount() === 1) {
      $info = $stmt->fetch(PDO::FETCH_ASSOC);
      return $info;
    } else {
      return false;
    }
  }

  public static function UserLocalisationKilometreInsert($distance, $id_achat)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $execute = $stmt = $data->prepare("INSERT INTO localisations_achat ( id_user, id_achat, kilometre) VALUES (?,?,?)");
    $execute = $stmt->execute(array($id, $id_achat, $distance));
  }

  // --- enregistre le lieu de liraison  UserlieuConfirmeLivraison
  static public function UserlieuLivraison($id_achat, $distance, $user_lat, $user_lon, $magasin_lat, $magasin_lon)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    $kilometre = $distance;
    $latitude_user = $user_lat;
    $longitude_user = $user_lon;
    $latitude_boutique = $magasin_lat;
    $longitude_boutique = $magasin_lon;
    $stmt = $data->prepare("INSERT INTO localisations_achat (id_user, id_achat, kilometre, latitude_user, longitude_user, latitude_boutique, longitude_boutique) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute(array($id, $id_achat, $kilometre, $latitude_user, $longitude_user, $latitude_boutique, $longitude_boutique));
    $stmt->closeCursor();
    return true;
  }

  static public function UserConfirmeLivraison($id_achat, $frais_livraison)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    try {
      $sql = "SELECT * FROM livraison WHERE id_achat = ? ";
      $stmt = $data->prepare($sql);
      $stmt->execute(array($id_achat));
      if ($stmt->rowCount() === 1) {
        $data->beginTransaction();
        // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
        $stmt_1 = $data->prepare("UPDATE liste_achat SET statut = ? WHERE id = ? AND id_user = ?");
        $stmt_2 = $data->prepare("UPDATE livraison SET statut = ?, frais = ? WHERE id_achat = ?");
        $execute_1 = $stmt_1->execute(array('Livre', $id_achat, $id));
        $execute_2 = $stmt_2->execute(array('true', $frais_livraison, $id_achat));
        if ($execute_1 === false and $execute_2 === false) {
          $data->rollBack();
          return false;
        }
        $data->commit();
        return true;
      } else {
        return false;
      }

    } catch (Exception $e) {
      $data->rollBack();
      return false;
    }



  }

  static public function UserArchiveAchats($id_achat)
  {
    $data = self::data();
    $id = $_SESSION['id'];
    // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
    $stmt = $data->prepare("UPDATE liste_achat SET user = ? WHERE id = ? AND id_user = ?");
    $execute = $stmt->execute(array('false', $id_achat, $id));
    if ($execute === false) {
      return false;
    } else {
      return true;
    }

  }

   static public function UserAnnulerAchats($id_achat_clt){

   }

}
?>

