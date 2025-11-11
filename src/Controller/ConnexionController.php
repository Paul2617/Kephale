<?php
use NewClass\ConnexionClass;
use Middleware\SecurityMiddleware;
use Middleware\SecurityTentatives;
use Session\Session;

class ConnexionController
{
    private static $render;
    private static $page_connexion;

    public function __construct($parts_uri, $parts_uri_1 = null)
    {
        self::$render = $parts_uri;
        self::$page_connexion = $parts_uri_1;
    }

    public function ConnexionController()
    {
        // Générer un jeton CSRF
        $csrfToken = SecurityMiddleware::generateCsrfToken();
        $session_tentative = SecurityTentatives::session_tentative();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
            // Correction : vérification CSRF correcte avec hash_equals
            if (!isset($_POST['csrf_token']) || !SecurityMiddleware::varifieCsrfToken($_POST['csrf_token'])) {
                header('Location: /inscription');
                exit;
            }
            $telephone = SecurityMiddleware::sanitizeInput($_POST['telephone']) ?? null;
            $password = $_POST['password'] ?? null;
            // Ne pas sanitizer le mot de passe, il sera vérifié avec password_verify
            if ($session_tentative <= 6) {
                $ConnexionClass = ConnexionClass::ConnexionClass($telephone, $password);
                if ($ConnexionClass !== false) {
                    $id = $ConnexionClass;
                    $security_session = Session::security_session($id);
                    if ($security_session === $id) {
                        $security_session = Session::check_session();
                        if ($security_session === true) {
                            header('Location: /user');
                        } else {
                            $security_tentatives = SecurityTentatives::security_tentatives();
                            $errors = "Numéro ou Mot de passe incorrect !";
                        }
                    } else {
                        $security_tentatives = SecurityTentatives::security_tentatives();
                        $errors = "Numéro ou Mot de passe incorrect !";
                    }
                } else {
                    $security_tentatives = SecurityTentatives::security_tentatives();
                    $errors = "Numéro ou Mot de passe incorrect !";
                }
            } else {
                $security_timeExiste = SecurityTentatives::security_timeExiste();
                if ($security_timeExiste === true) {
                    $errors = "Merci de réessayer plus tard.";
                } else {
                    Session::logout();
                }
            }



        }


        //echo ConnexionClass::ConnexionClass();
        $new_view = self::$render;
        $new_view_page = self::$page_connexion;
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

