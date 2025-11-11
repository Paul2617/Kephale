<?php
namespace Services;
use Middleware\SecurityEncode;
use Middleware\ApiClient;
use Services\ConvertionSolde;
use Services\AfficheDate;
class Livraison 
{
    // 1800
private static $_30Minute =  3600;

 public static function livreur ($id_achat){
     if(!isset($_SESSION['id'])){return false;}
     $data = [ 'id_users'=> $_SESSION['id'],  'id_achat' => $id_achat];
     $encode =  SecurityEncode::encode($data);
     $dataEncode = $encode['data'];
     $AUTH_TOKEN = $encode['AUTH_TOKEN'];
     $API_KEY = $encode['API_KEY'];
     $curl_init =  ApiClient::curl_init($dataEncode, $AUTH_TOKEN, $API_KEY, 'ordre_livraison');
     $infos = json_decode($curl_init , true);

     if($infos === false){return 'Traitement de Livraisons en cours...';} 
      $nom = htmlspecialchars($infos['nom'] ?? '', ENT_QUOTES, 'UTF-8');
     $tel = htmlspecialchars($infos['tel'] ?? '', ENT_QUOTES, 'UTF-8');
     $frais = $infos['frais'] ?? 0; 
     $new_frais = ConvertionSolde::newSolde($frais)." FCFA";

     $info = 'Le frère de Livraisons est de <span>'.$new_frais.
     '</span> et elle doit être livrée par Monsieur <span>'.$nom. 
     '</span> avec  le numéro suivant <br><a href=""  style = "color: #95C11F;"> +223 '.$tel.'</a>';
     return $info;
}

 public static function timeEssayeArticle ($id_achat){
    self:: $_30Minute; 
    if(!isset($_SESSION['id'])){return false;}
     $data = [ 'id_users'=> $_SESSION['id'],  'id_achat' => $id_achat];
     $encode =  SecurityEncode::encode($data);
     $dataEncode = $encode['data'];
     $AUTH_TOKEN = $encode['AUTH_TOKEN'];
     $API_KEY = $encode['API_KEY'];
     $curl_init =  ApiClient::curl_init($dataEncode, $AUTH_TOKEN, $API_KEY, 'timeEssayeArticle');
     $info = json_decode($curl_init , true);
     if($info === false){return false;}
     $date = strtotime($info) ;
     $temps_initial = self:: $_30Minute ; // 30 minutes en secondes
     $temptValide = $date + $temps_initial ;
     $time_actuel = time();
     if($time_actuel > $temptValide){ return false;}

     $temp =  $date + $temps_initial;
     $temps_passe = time() - $date;
     $temps_restant = $temps_initial - $temps_passe;
     $chrono = gmdate("i", $temps_restant);
     return $chrono;
}


 public static function  infoAchatAnnule ($id_achat){
     if(!isset($_SESSION['id'])){return false;}
     $data = [ 'id_users'=> $_SESSION['id'],  'id_achat' => $id_achat];
     $encode =  SecurityEncode::encode($data);
     $dataEncode = $encode['data'];
     $AUTH_TOKEN = $encode['AUTH_TOKEN'];
     $API_KEY = $encode['API_KEY'];
     $curl_init =  ApiClient::curl_init($dataEncode, $AUTH_TOKEN, $API_KEY, 'infoAchatAnnule');
     $info = json_decode($curl_init , true);
     if($info === false){return false;}

     $montant = $info['montant'];
     $montant_verse = $info['montant_verse'];
     $reste = $info['reste'];
     $etat = $info['etat'];
     $date = strtotime( $info['data_transactions']);
     $new_date = AfficheDate::newDateConveti($date);

     if($etat === 'total'){
     $new_montant = ConvertionSolde::newSolde($montant)." FCFA";
     $info = [
        'titre' => 'Vous avez annulé l’achat parce que l’article n’a pas été livré dans le délai. Le montant total de <span>'.$new_montant .'</span> de l’achat vous a été reversé.',
        'alt' => 'Nous tenons à nous excuser par rapport à cela.',
        'date' => $new_date
        ]; 
        return $info; }

     if($montant_verse > 0){
     $new_montant_verse = ConvertionSolde::newSolde($montant_verse)." FCFA";
     $new_reste = ConvertionSolde::newSolde($reste)." FCFA";
     $titre = "Vous avez annulé l’achat parce que l’article n’a pas été livré dans le délai. <span>"
     .$new_montant_verse."</span> vous a été reversé, le reste <span>".$new_reste."</span> vous sere reversé losque la boutique aura recharge son compte.";
      }elseif($montant_verse === 0){
     $new_montant = ConvertionSolde::newSolde($montant)." FCFA";
     $titre = "Vous avez annulé l’achat parce que l’article n’a pas été livré dans le délai. Vous sere renbourse montant total de <span>".$new_montant."</span> de l’achat losque la boutique aura recharge son compte.";
      }

      $info = [
        'titre' => $titre,
        'alt' => 'Nous tenons à nous excuser par rapport à cela.',
        'date' => $new_date
        ]; 
        return $info;

}

public static function  signal ($id_achat){
    // 'traitement','change','annuler','changement','annulation'
     if(!isset($_SESSION['id'])){return false;}
     $data = [ 'id_users'=> $_SESSION['id'],  'id_achat' => $id_achat];
     $encode =  SecurityEncode::encode($data);
     $dataEncode = $encode['data'];
     $AUTH_TOKEN = $encode['AUTH_TOKEN'];
     $API_KEY = $encode['API_KEY'];
     $curl_init =  ApiClient::curl_init($dataEncode, $AUTH_TOKEN, $API_KEY, 'Infosignal');
     $info = json_decode($curl_init , true);

     if($info === false ){return false;}

     if($info['statut'] === 'traitement'){
     return 'Votre demande est en cours de traitement, nous vous contacterons dans les 72 heures à venir.';
     }
     if($info['statut'] === 'changement'){
     return 'Votre demande a été prise en compte le commerçant prendra en charge le changement et le frair de livraisons de la nouvelle article.';
     }
     if($info['statut'] === 'annulation'){
     return "Votre achat est en cours d'annulation";
     }
     if($info['statut'] === 'annuler'){
     return "Votre achat a été annulé suite aux vérification de  article qui vous a été livré vous avez été remboursé du montant total de l'achat.";
     }
     
}
 
}