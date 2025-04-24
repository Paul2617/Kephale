<?php
if(isset($_SESSION["id"])){
    if(isset($_SESSION["id_boutique"])){
       
            $etatAbonnement = etatAbonnement($bd);
            // si l'abonnement est expire
            if($etatAbonnement === 'expire'){
                header ('Location: /Kephale/reabonnement');
            }elseif($etatAbonnement === 'G'){
                $psa = $bd->prepare("SELECT etat FROM psa WHERE id_boutique = ? ");
                $psa->execute([$_SESSION["id_boutique"]]);
                $resulte = $psa->fetch(PDO::FETCH_ASSOC);
                $etat =  $resulte ['etat'];
              if($etat === '1' ){
                $tecko = 'psa';
                $tecka = 'Sur clients';
              }else{
                $tecko = 'psa';
                $tecka = 'Sur boutique';
              }

            }else{
                $tecko = $etatAbonnement.' Jr' ;
                $tecka = 'Restant';
            }
            require_once ('../models/solde_affiche/solde.php');
            $infoBoutique = infoBoutique($bd);
            $infoCategorie = infoCategorie($bd);
            $boutiqueSolde = solde ($infoBoutique["solde"]) ;
        
        











    }else{
        header ('Location: /Kephale/look');
    }

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}


?>