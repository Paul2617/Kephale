<?php
namespace NewClass;
use Lib\Data;
use PDO;
class InscriptionClass
{
  protected static function data()
  {
    return Data::data();
  }
  static public function InscriptionClass()
  {
    $data = self::data();
    $nom_user = $_SESSION['nom'];
    $telephone_user = $_SESSION['telephone'];
    $password_user = $_SESSION['password'];
    $sexe_user = $_SESSION['sexe'];
    $profile = 'profil.png';
    try {
    $data->beginTransaction();
    $execute = $stmt = $data->prepare("INSERT INTO user ( nom, numero, password, sexe, img_profile ) VALUES (?,?,?,?,?)");
    $execute = $stmt->execute(array($nom_user, $telephone_user, $password_user, $sexe_user, $profile));
    $execute = $usersId = $data->lastInsertId();
    $execute = $stmt_2 = $data->prepare("INSERT INTO user_portefeuille (id_user, types) VALUES (?,?)");
    $execute = $stmt_2->execute(array($usersId, 'Courant'));
    if ($execute === false) {
      $data->rollBack();
      return false;
    }
    $data->commit();
    return true;
        } catch (Exception $e) {
      $data->rollBack();
      return false;
    }

  }

  static public function verifieTelephone($telephone)
  {
    $data = self::data();
    $stmt = $data->prepare("SELECT numero FROM user WHERE numero = ? LIMIT 1");
    $stmt->execute(array($telephone));
    if ($stmt->rowCount() === 1) {
      return false;
    } else {
      return true;
    }
  }
}
?>

