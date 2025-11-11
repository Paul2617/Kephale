<?php
use NewClass\UserClass;
use NewClass\OffreClass;
use Middleware\SecurityMiddleware;
use Middleware\SecurityTentatives;
use Middleware\GenerateCsrfToken;
use Session\Session;
use Abonnement\Boutique;
use NewClass\Transaction;
class OffreController
{
    private static $render;
    private static $page_offre;
    private static $param_type = false;
    private static $param_offre = false;
    private static $csrfToken = false;

    public function __construct($parts_uri, $parts_uri_1 = null, $parts_uri_2 = false, $parts_uri_3 = false)
    {
        self::$render = $parts_uri;
        self::$page_offre = SecurityMiddleware::sanitizeInput($parts_uri_1);
        self::$param_type = SecurityMiddleware::sanitizeInput($parts_uri_2);
        self::$param_offre = SecurityMiddleware::sanitizeInput($parts_uri_3);
        self::$csrfToken = GenerateCsrfToken::generateCsrfToken();

        if (self::$page_offre === 'paiement') {
            $check_session = Session::check_session();
            if ($check_session === false) {
                Session::logout();
            }
        }
    }

    public function OffreController()
    {

        $param_type = self::$param_type;
        $page_offre = self::$page_offre;
        $csrfToken = self::$csrfToken;

        // recupere les informations de l'offre du client dans la page paiement
        if ($page_offre === 'paiement') {
            UserClass::infoUserBoutique();
            $infoOffre = Boutique::infoOffre($param_type);
            if ($infoOffre === false) {
                Session::logout();
            }
            $prix = $infoOffre['prix'];
            $poursantage = $infoOffre['poursantage'];
            $UserInfo = UserClass::UserInfo();
            $balance = $UserInfo['balance'];
            $devise = $UserInfo['devise'];
            if ($prix <= $balance) {
                $i = true;
            } else {
                $errors = "Fond insufisant.";
                $i = false;
            }
        }
        // methode Poste
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Correction : vérification CSRF correcte avec hash_equals
            if (!isset($_POST['csrf_token']) || !SecurityMiddleware::varifieCsrfToken($_POST['csrf_token'])) {
                Session::logout();
                exit;
            }
            if (isset($_POST['paiement'])) {
                $session_tentative = SecurityTentatives::session_tentative();
                if ($session_tentative <= 6) {
                    $password = $_POST['password'] ?? null;
                    // Ne pas sanitizer le mot de passe, il sera vérifié avec password_verify
                    // Correction : ne plus utiliser sha1, UserVerifiPassword gère déjà password_verify
                    $UserVerifiPassword = UserClass::UserVerifiPassword($password);
                    if ($UserVerifiPassword === true) {
                        $Transaction = Transaction::TransactionAbonnement($prix, $devise, $param_type);
                        if ($Transaction === true) {
                            header('Location: /user/creation');
                        } else {
                            $errors = "Impossible, la transaction est défectueuse.";
                        }
                    } else {
                        SecurityTentatives::security_tentatives();
                        $errors = "Numéro ou Mot de passe incorrect !";
                    }
                } else {
                    Session::logout();
                }

            }
        }

        // creations de boutique 
        if (self::$page_offre === 'creation') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valide'])) {
                // Correction : vérification CSRF correcte avec hash_equals
                if (!isset($_POST['csrf_token']) || !SecurityMiddleware::varifieCsrfToken($_POST['csrf_token'])) {
                    Session::logout();
                    exit;
                }
                if (true) {
                    if (!empty($_FILES["image"]["tmp_name"])) {
                        if (isset($_POST['pays'])) {
                            // Correction : sanitizeInput fait déjà htmlspecialchars, pas besoin de le faire deux fois
                            $nom = SecurityMiddleware::sanitizeInput($_POST['nom'] ?? '');
                            $pays = SecurityMiddleware::sanitizeInput($_POST['pays'] ?? '');
                            require_once('../config/img/img_verif.php');
                            $img_verif = img_verif();
                            if ($img_verif === 'format') {
                                $errors = "Veuiller utiliser une image au format jpeg, jpg ou png";
                            } elseif ($img_verif === 'taille') {
                                $errors = "La taille de votre image dépasse 5 Mo. ";
                            } else {
                                $img = $img_verif;
                                $id_user = 1;
                                $data = ['id_user' => $id_user, 'nom' => $nom, 'pays' => $pays, 'img' => $img,];
                                $result = OffreClass::CreationsBoutique($data);
                                if ($result === true) {
                                    $direction = "../assets/img_boutique_profile/" . $img;
                                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $direction)) {
                                        header('Location: /boutique');
                                    }
                                } else {
                                    $errors = "Inposible de continue.";
                                }
                            }
                        } else {
                            $errors = "Merci de sélectionner le pays";
                        }
                    } else {
                        $errors = "Merci de sélectionner une image de profil";
                    }
                }

            }
        }

        $new_view = self::$render;
        $new_view_page = self::$page_offre;

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

