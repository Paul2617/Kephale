<?php
       if(isset($_POST["confirme"]) and !empty($_POST["confirme"])){
        if(isset($_POST["password_user"]) and !empty($_POST["password_user"])){
            $code = sha1($_POST["password_user"]);
            
        }else{
            $erreur = 'Veuillez saisir votre Mot de passe. ';
        }

        
       
    }


if(isset($_SESSION["id"])){
        require_once ('../models/solde_affiche/solde.php');
        $info_abonnement = info_abonnement ($bd);
        $info_user = info_user ($bd);
        $montantAbt = solde ($info_abonnement["montant"] );
if(isset($code)){
    if($code === $info_user["code"]){
        // montant de transactions
        $montant = $info_abonnement["montant"];
        // id de l'abonnement
        $id_abt = $_GET["id_abt"];
        if($info_user["solde"] >=  $montant){
// verifie si l'abonnement est gratuit
            if($info_abonnement["mode"] === 'G'){
                $transactionsgratui = transactionsgratui($bd);
                if($transactionsgratui === true ){
                    header ('Location: /Kephale/crtboutique');
                }
            }elseif
            // verifie si l'abonnement est payen
            ($info_abonnement["mode"] === 'P'){
                
               $transactions = transactions($bd, $montant, $id_abt );
               if($transactions === true){
                header ('Location: /Kephale/crtboutique&id_abt='.$_GET["id_abt"]);
               }
            }
        }else{
            $erreur = 'Solde insufisant';
        }
    }else{
        $erreur = ' Mot de passe incorrect !';
    }
}
      

      
    

















}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
?>
