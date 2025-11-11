<?php
namespace NewClass;
use Lib\Data;
use PDO;
class ConnexionClass
{
  protected static function data()
  {
    return Data::data();
  }
  static public function ConnexionClass($telephone, $password)
  {
    $data = self::data();

    $stmt = $data->prepare("SELECT id, password, statut FROM user WHERE numero = ? LIMIT 1");
    $stmt->execute(array($telephone));
    if ($stmt->rowCount() === 1) {
      $user = $stmt->fetch(mode: PDO::FETCH_ASSOC);
      $hashedPassword = $user['password'];
      $statut = $user['statut'];
      // Sécurisation : utilisation de password_verify au lieu de SHA1
      // Si le mot de passe est encore en SHA1 (ancien système), on le vérifie d'abord
      // Sinon on utilise password_verify pour les nouveaux mots de passe
      $passwordValid = false;
      if (strlen($hashedPassword) === 40 && ctype_xdigit($hashedPassword)) {
        // Ancien format SHA1 (40 caractères hexadécimaux)
        $passwordValid = (sha1($password) === $hashedPassword);
      } else {
        // Nouveau format avec password_hash
        $passwordValid = password_verify($password, $hashedPassword);
      }
      
      if ($passwordValid) {
        if ($statut === 'true') {
          $id = $user['id'];
          return $id;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}
?>

