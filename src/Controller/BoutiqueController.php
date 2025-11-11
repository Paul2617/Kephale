<?php
use NewClass\BoutiqueClass;
use Session\Session;
use Middleware\ConvertionSolde;
use Middleware\SecurityMiddleware;
class BoutiqueController
{
    private static $render;
    private static $page_boutique;
    private static $id_web;
    private static $abonnement = [];

    public function __construct($parts_uri, $parts_uri_1 = null, $parts_uri_2 = null)
    {
        $check_session_boutique = Session::check_session_boutique();

        $InfoAb = BoutiqueClass::InfoAbonnement();
        $jour_restant = $InfoAb['jour_restant'];
        self::$abonnement = $InfoAb;
        self::$render = $parts_uri;
        self::$page_boutique = $parts_uri_1;
        self::$id_web = $parts_uri_2;

        if (self::$page_boutique !== 'web') {
            if ($check_session_boutique === false) {
                Session::logout();
            }
        }
    }

    public function BoutiqueController()
    {
        // Générer un jeton CSRF
        $csrfToken = SecurityMiddleware::generateCsrfToken();


        // --------------------------------------------------------------------------- 

        $InfoAbonnement = self::$abonnement;
        $jour_restant = $InfoAbonnement['jour_restant'];
        if ($jour_restant <= 0) {
            echo "Abonnement Fini";
        }

        $type_abonnement = $InfoAbonnement['type_abonnement'];
        $debut = $InfoAbonnement['debut'];
        $fin = $InfoAbonnement['fin'];
        $abonnement_facture = $InfoAbonnement['abonnement_facture'];
        $statut = $InfoAbonnement['statut'];

        // produit instuction
        $ProduitCode = BoutiqueClass::ProduitRowCount($type_abonnement);

        // info de la boutique 
        $InfoBoutique = BoutiqueClass::InfoBoutique();
        $nom_boutique = $InfoBoutique['nom'];
        $img_profile = $InfoBoutique['img_profile'];
        $pays = $InfoBoutique['pays'];
        $date_creation = $InfoBoutique['date_creation'];
        $balance = $InfoBoutique['balance'];
        $balance_ = ConvertionSolde::newSolde($InfoBoutique['balance']);
        $devise = $InfoBoutique['devise'];
        $statut_solde = $InfoBoutique['statut_solde'];

        //liste des produit
        $ListeProduit = BoutiqueClass::ListeProduit();
        // fin

        // statique
        $statistique = BoutiqueClass::statistique();
        // fin

        // id boutique web
        $id_boutique_web = BoutiqueClass::id_boutique_web($type_abonnement);
        // fin

        // localisations
        $lc = BoutiqueClass::InfoLocalisation();
        // fin

        $new_view = self::$render;
        $new_view_page = self::$page_boutique;
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

