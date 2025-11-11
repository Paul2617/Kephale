<?php
use NewClass\InscriptionClass;
use Middleware\SecurityMiddleware;
use Session\Session;
use Twilio\Twilio;
class InscriptionController
{
    private static $render;
    private static $page_inscription;

    public function __construct($parts_uri, $parts_uri_1 = null)
    {
        self::$render = $parts_uri;
        self::$page_inscription = $parts_uri_1;
    }
    public function InscriptionController()
    {

        // Générer un jeton CSRF
        $csrfToken = SecurityMiddleware::generateCsrfToken();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {
            // Correction : vérification CSRF correcte
            if (!isset($_POST['csrf_token']) || !SecurityMiddleware::varifieCsrfToken($_POST['csrf_token'])) {
                header('Location: /inscription');
                exit;
            }
            $nom = SecurityMiddleware::sanitizeInput($_POST['nom'] ?? '');
            $telephone = SecurityMiddleware::sanitizeInput($_POST['telephone'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_2 = $_POST['password_2'] ?? '';
            $sexe = SecurityMiddleware::sanitizeInput($_POST['sexe'] ?? '');
            if (!empty($sexe)) {
                if ($password === $password_2 && !empty($password)) {
                    $verifieTelephone = InscriptionClass::verifieTelephone($telephone);
                    if ($verifieTelephone === true) {
                        // $verifieTelephone = Twilio::Twilio(97019780);
                        // if ($verifieTelephone !== false) {
                        session_regenerate_id(true); // Change l'ID de session pour éviter fixation
                        $_SESSION['nom'] = $nom;
                        $_SESSION['telephone'] = $telephone;
                        // Sécurisation : utilisation de password_hash au lieu de SHA1
                        $_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT);
                        $_SESSION['sexe'] = $sexe;
                        $_SESSION['TIME_EXPIRE'] = time() + 60 * 15;
                        $_SESSION['AUTH_CODE'] = sha1(261700);
                        header('Location: /inscription');
                        /*   } else {
                             $errors = "Impossible de vérifier votre numéro";
                         }*/
                    } else {
                        $errors = "Veuillez indiquer un autre numéro de téléphone.";
                    }
                } else {
                    $errors = "Les deux mots de passe ne sont pas similaires.";
                }
            } else {
                $errors = "Veuillez indiquer votre genre.";
            }

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code_valide'])) {
            // Correction : vérification CSRF correcte
            if (!isset($_POST['csrf_token']) || !SecurityMiddleware::varifieCsrfToken($_POST['csrf_token'])) {
                header('Location: /inscription');
                exit;
            }
            $code = sha1($_POST['code'] ?? '');
            if ($_SESSION['TIME_EXPIRE'] > time()) {
                if ($_SESSION['AUTH_CODE'] === $code) {
                    $InscriptionClass = InscriptionClass::InscriptionClass();
                    if ($InscriptionClass === true) {
                        /*  $valide = "Inscription validée.";
                            sleep(10);
                            $logout = Session::logout();
                            header("Refresh: 10; URL=/connexion"); */
                        header('Location:  /connexion');
                    } else {
                        /*  $errors = "L'inscription a échoué, merci de réessayer plus tard.";
                          sleep(10);
                          $logout = Session::logout();
                          header("Refresh: 10; URL=/inscriptions"); */
                        header('Location:  /inscription');
                    }

                } else {
                    $errors = "Code incorrect.";
                }

            } else {
                $errors = "Code validation erronée.";
                sleep(10);
                $logout = Session::logout();
                header("Refresh: 10; URL=/inscriptions");
            }

        }
        $new_view = self::$render;
        $new_view_page = self::$page_inscription;
        if (empty($new_view_page)) {
            $view = __DIR__ . '/../../view/' . $new_view . '/index.php';
            if (file_exists($view)) {
                require_once $view;
            }
        } else {
            $new_view = __DIR__ . '/../../view/' . $new_view . '/' . $new_view_page . '/index.php';
            if (file_exists($new_view)) {
                require_once $new_view;
            } else {
                header('Location: /home');
            }
        }
    }
}
?>

