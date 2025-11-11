<?php
use NewClass\UserClass;
use Session\Session;
use Middleware\ConvertionSolde;
use Middleware\SecurityMiddleware;
use Img\VerifiImgUnique;
use Abonnement\Boutique;
use NewClass\Transaction;
class UserController
{
    private static $render;
    private static $page_user;
    private static $param_type = false;

    public function __construct($parts_uri, $parts_uri_1 = null, $parts_uri_2 = false, $parts_uri_3 = false)
    {
        $check_session = Session::check_session();
        if ($check_session === false) {
            Session::logout();
        }
        self::$param_type = SecurityMiddleware::sanitizeInput($parts_uri_2);
        self::$render = $parts_uri;
        self::$page_user = $parts_uri_1;
    }

    public function UserController()
    {
        $csrfToken = SecurityMiddleware::generateCsrfToken();
        $param_type = self::$param_type;
        // infi user globale 
        $UserInfo = UserClass::UserInfo();
        // info user 
        $nom = SecurityMiddleware::sanitizeInput($UserInfo['nom']) ?? null;
        $numero = $UserInfo['numero'];
        $sexe = $UserInfo['sexe'];
        $img_profile = $UserInfo['img_profile'];
        // info solde user
        $balance = ConvertionSolde::newSolde($UserInfo['balance']);
        $balance_ = $UserInfo['balance'];
        $devise = $UserInfo['devise'];
        $types = $UserInfo['types'];
        // fin
        // info user boutique 
        $UserInfoBoutique = UserClass::UserInfoBoutique();
        // fin

        // lista achat use 
        $UserListeAchat = UserClass::UserListeAchat();
        // fin

        // info localisation
        $Lc = UserClass::UserInfoLocalisation();
         // fin

        UserClass::UserClass();
        
        // page gestion de la metode post pour la modifications des info de user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Correction : vérification CSRF correcte avec hash_equals
            if (!isset($_POST['csrf_token']) || !SecurityMiddleware::varifieCsrfToken($_POST['csrf_token'])) {
                Session::logout();
                exit;
            }
            if (isset($_POST['deconnexion'])) {
                Session::logout();
            }
            if (isset($_POST['new_nom'])) {
                $new_nom = SecurityMiddleware::sanitizeInput($_POST['nom']) ?? null;
                if ($new_nom !== $nom) {
                    UserClass::UserNewNom($new_nom);
                }
            }
            if (isset($_POST['new_telephone'])) {
                $new_telephone = SecurityMiddleware::sanitizeInput($_POST['telephone']) ?? null;
                if ($new_telephone !== $numero) {
                    UserClass::UserNewNumero($new_telephone);
                }
            }
            if (isset($_POST['new_password'])) {
                $password = SecurityMiddleware::sanitizeInput($_POST['password']) ?? null;
                $passwordNew = SecurityMiddleware::sanitizeInput($_POST['passwordNew']) ?? null;
                //UserClass::UserNewSex($new_sex);
            }
            if (isset($_POST['new_sex'])) {
                $new_sex = SecurityMiddleware::sanitizeInput($_POST['sexe']) ?? null;
                if ($new_sex !== $sexe) {
                    UserClass::UserNewSex($new_sex);
                }
            }
            if (isset($_POST['new_img'])) {
                if (!empty($_FILES["image"]["tmp_name"])) {
                    $VerifiImgUnique = VerifiImgUnique::img_user($img_profile);
                    if ($VerifiImgUnique !== true) {
                        $infoAlte = $VerifiImgUnique;
                    }
                }
            }
            
            if (isset($_POST['valide'])) {
                    if (!empty($_FILES["image"]["tmp_name"])) {
                        if (isset($_POST['pays'])) {
                            $nom_boutique = SecurityMiddleware::sanitizeInput($_POST['nom_boutique']?? null);
                            $pays = SecurityMiddleware::sanitizeInput($_POST['pays'] ?? null);
                            require_once('../config/img/img_verif.php');
                            $img_verif = img_verif();
                            if ($img_verif === 'format') {
                                $errors = "Veuiller utiliser une image au format jpeg, jpg ou png";
                            } elseif ($img_verif === 'taille') {
                                $errors = "La taille de votre image dépasse 5 Mo. ";
                            } else {
                                $img = $img_verif;
                                $direction = "../assets/img_boutique_profile/".$img;
                                $infoBoutique = UserClass::infoCreationBoutique( $nom_boutique, $pays,  $img);
                                if($infoBoutique !== false){
                                   if(move_uploaded_file($_FILES["image"]["tmp_name"], $direction)){
                                    $_SESSION['id_boutique'] = $infoBoutique;
                                    header ('Location: /boutique');
                                   }else{
                                    $_SESSION['id_boutique'] = $infoBoutique;
                                    header ('Location: /boutique');
                                   }
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
        // fin
        $new_view = self::$render;
        $new_view_page = self::$page_user;
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

