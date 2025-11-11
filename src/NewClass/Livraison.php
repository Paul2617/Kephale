<?php
namespace NewClass;
use DateTime;
use Lib\Data;
use NewClass\UserClass;
use Middleware\AfficheDate;
use PDO;
use PDOException;
class Livraison
{
    private static $cle = "eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6ImRkZmZmNmQyMDcxNDRkOGJhNjE4NGYzY2FiZDVlYzgyIiwiaCI6Im11cm11cjY0In0=";
    public function __construct()
    {

    }

    protected static function data()
    {
        return Data::data();
    }

    static public function LivraisonDistanceIp($user_lat, $user_lon, $magasin_lat, $magasin_lon, $id_achat, $distance)
    {
        $UserLocalisationKilometre = UserClass::UserLocalisationKilometre($id_achat);
        if ($UserLocalisationKilometre === false) {
            $Insert = UserClass::UserLocalisationKilometreInsert($distance, $id_achat);
            /* --- Clé API OpenRouteService (à insérer ici)
            $apiKey = self::$cle;
            // URL de l’API OSRM (routage)
            $url = "https://router.project-osrm.org/route/v1/driving/$magasin_lon,$magasin_lat;$user_lon,$user_lat?overview=false";
            // Initialiser cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Exécuter la requête
            $response = curl_exec($ch);
            curl_close($ch);

            // Décoder la réponse JSON
            $data = json_decode($response, true);
            // Vérifier si une route a été trouvée
            if (isset($data['routes'][0]['distance'])) {
                $distance = round($data['routes'][0]['distance'] / 1000, 2); // en kilomètres
                $Insert = UserClass::UserLocalisationKilometreInsert($distance, $id_achat);
                return $distance;
            } else {
                die("Erreur : impossible d'obtenir la distance via ORS");
            }*/
            // --- Requête vers l’API pour la distance réelle
        } else {
            return $UserLocalisationKilometre['kilometre'];
        }
    }

    // --- Fonction pour calculer la distance entre deux points (en km)
    static public function distance($lat1, $lon1, $lat2, $lon2): float
    {
        $rayonTerre = 6371; // Rayon moyen de la Terre en kilomètres

        // Conversion des degrés en radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Formule de Haversine
        $diffLat = $lat2 - $lat1;
        $diffLon = $lon2 - $lon1;

        $a = sin($diffLat / 2) * sin($diffLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($diffLon / 2) * sin($diffLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $rayonTerre * $c + 2; // Distance en km
        $distance = round($distance, 2);

        return $distance ;
    }

    // --- Fonction pour calculer le frais de livraison
    static public function FraisLivraison($distance, $tarifParKm = 100, $minimum = 1000): int
    {
        $frais = $distance * $tarifParKm;
        $seuilKm = 3;
        // Exemple : 300 FCFA par kilomètre
        // return max($frais, $minimum);

        // arondir ver le haut 
        return  (int)round($frais, -2) ;
    }

    // --- Fonction pour calule le delait de livraison
    static public function DelaitLivraison($statut, $date_lv)
    {
        $date = new DateTime($date_lv);
        $date->modify('+3 days');
        $nDate = $date->format('y-m-d h:i:s');
        $newDate = strtotime($nDate);
        $newDateConverti = AfficheDate::newDateConveti($newDate);
        $now = time();

        if ($newDate > $now) {
            $data =
                [
                    'date' => $newDateConverti,
                    'statut' => true,
                ];
        } else {
            $data =
                [
                    'date' => $newDateConverti,
                    'statut' => false,
                ];
        }

        return $data;
    }

    // --- info livraison 
    static public function infoLivreur($id_achat)
    {
        $data = self::data();
        $sql = "SELECT 
        l.id as id_livraison , 
        l.id_livraire,  
        vr.nom as nom_livreur, 
        vr.tel as tel_livreur  
        FROM livraison l
         LEFT JOIN livreur vr ON vr.id = l.id_livraire
         WHERE l.id_achat = ? ";
        $stmt = $data->prepare($sql);
        $stmt->execute(array($id_achat));
        if ($stmt->rowCount() === 1) {
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            return $info;
        } else {
            return false;
        }

    }
}