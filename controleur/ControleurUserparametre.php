<?php  
 require_once ('../transactions/infoUser.php');
 //Verifie si l'utilisateur a une boutique

if($user_id === $_SESSION["id"]){
     // verifi si users a une boutique 
   $etat_boutique = (new etat_boutique())->verifie_boutique($user_id);
   if( $etat_boutique === true){
 $userBoutiqueEtat = 'boutique';
   }else{
    //si user na pas de boutique
     $userBoutiqueEtat = 'abonnement';
   }
 }

?>