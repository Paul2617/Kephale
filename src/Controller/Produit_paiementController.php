<?php
use NewClass\Produit_paiementClass;
use Middleware\SecurityMiddleware;
use Session\Session;
use Middleware\ConvertionSolde;
use NewClass\UserClass;
use Middleware\SecurityTentatives;
use NewClass\Transaction;

class Produit_paiementController
{
    private static $render;
    private static $page_produit_paiement;

    public function __construct( $parts_uri, $parts_uri_1 = null  ) {
          $check_session = Session::check_session();
        if ($check_session === false) {
            Session::logout();
        }
         self::$render = $parts_uri;
         self::$page_produit_paiement = $parts_uri_1 ;
        }

    public function Produit_paiementController()
    {
    Produit_paiementClass::Produit_paiementClass();

    $csrfToken = SecurityMiddleware::generateCsrfToken();
        $session_tentative = SecurityTentatives::session_tentative();
        $id_v = SecurityMiddleware::sanitizeInput((int) $_GET['id_v']) ?? null;
        $qte = SecurityMiddleware::sanitizeInput((int) $_GET['qte']) ?? null;
        $dvs = SecurityMiddleware::sanitizeInput((string) $_GET['dvs']) ?? null;

        // info solde user
        $UserInfo = UserClass::UserInfo();
        $balance_ = ConvertionSolde::newSolde($UserInfo['balance']);
        $balance_user = $UserInfo['balance'];
        $devise = $UserInfo['devise'];
        $types = $UserInfo['types'];

        $InfoProduit = Produit_paiementClass::InfoProduit($id_v);
        if ($InfoProduit['price_pv'] === 0) {
            $prix = $InfoProduit['price_p'];
            $prix_converti = ConvertionSolde::newSolde($prix);
            if ($InfoProduit['promo'] === 'Aucune promo') {
                $prix_total = $prix * $qte;
                $prix_total_converti = ConvertionSolde::newSolde($prix_total);
                $statu_promo = false;
            } else {
                $CalculPromo = Produit_paiementClass::CalculPromo($InfoProduit['promo'], $InfoProduit['debut'], $InfoProduit['fin'], $InfoProduit['statut']);
                $statu_promo = true;
            }
        } else {
            $prix = $InfoProduit['price_pv'];
            $prix_converti = ConvertionSolde::newSolde($prix);
            if ($InfoProduit['promo'] === 'Aucune promo') {
                $prix_total = $prix * $qte ;
                $prix_total_converti = ConvertionSolde::newSolde($prix_total);
                $statu_promo = false;
            } else {
                $CalculPromo = Produit_paiementClass::CalculPromo($InfoProduit['promo'], $InfoProduit['debut'], $InfoProduit['fin'], $InfoProduit['statut']);
                $statu_promo = true;
            }
        }
        if ($balance_user >= $prix_total){
            $i = true;
        } else {
            $i = false;
        }
        
        // var_dump($statu_promo);

        //ProduitAchatClass::ProduitAchatClass();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Correction : vérification CSRF correcte avec hash_equals
            if (!isset($_POST['csrf_token']) || !SecurityMiddleware::varifieCsrfToken($_POST['csrf_token'])) {
                Session::logout();
                exit;
            }
            if (isset($_POST['paiement'])) {
                $password = $_POST['password'] ?? null;
                // Ne pas sanitizer le mot de passe, il sera vérifié avec password_verify
                // Correction : ne plus utiliser sha1, UserVerifiPassword gère déjà password_verify
                if ($session_tentative <= 6) {
                    $VerifiPassword = UserClass::UserVerifiPassword($password);
                    if ($VerifiPassword === true) {
                        if ($devise === $InfoProduit['devise']) {
                            $_devise = $devise;
                        } else {
                            $_devise = $InfoProduit['devise'];
                        }
                        $id_boutique = $InfoProduit['id_boutique'];
                        $id_produit = $InfoProduit['id_produit'];
                        $type_abonnement = $InfoProduit['type_abonnement'];
                        $id_varient = $id_v;

                        $Transaction = Transaction::TransactionAchatProduit(
                            $prix_total,
                            $qte,
                            $_devise,
                            $id_boutique,
                            $id_produit,
                            $id_varient,
                            $type_abonnement
                        );
                        if($Transaction === true){
                            header ('Location: /user/liste_achat');
                            exit;
                        } else {
                            $errors = "La transaction a échoué. Veuillez réessayer.";
                        }

                    } else {
                        $security_tentatives = SecurityTentatives::security_tentatives();
                        $errors = "Mot de passe incorrect !";
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
        }
     $new_view = self::$render; 
     $new_view_page = self::$page_produit_paiement;
      if(empty($new_view_page)){
            $view = __DIR__ . '/../../view/'.$new_view.'/index.php';
            if (file_exists($view)){ require_once $view;}
        }else{
            $new_view = __DIR__ . '/../../view/'.$new_view.'/'.$new_view_page.'/index.php';
            if (file_exists($new_view)){ require_once $new_view;}else{ header ('Location: /home');}
        }         
    }
}
?>