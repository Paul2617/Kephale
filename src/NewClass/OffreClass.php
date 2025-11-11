<?php
namespace NewClass;
use Config\ApiClient;
class OffreClass
{
  static protected $param_types = ['standare', 'grand'];
  static protected $param_offres = ['m', 'a'];

  static public function OffreClass($data): mixed
  {
     //$resulte_api = ApiClient::curl_init($data, 'paiementAbonnement');

    return $data;
  }
  // info paiement 
  static public function InfoPaiement($param_type, $param_offre)
  {
    $param_types = self::$param_types;
    $param_offres = self::$param_offres;
    if (in_array($param_type, $param_types)) {
      if (in_array($param_offre, $param_offres)) {
        return $param_type;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  
  // creation boutique 
  static public function CreationsBoutique($data)
  {
    //$resulte_api = ApiClient::curl_init($data, 'paiementAbonnement');
    return true;
  }
}
?>