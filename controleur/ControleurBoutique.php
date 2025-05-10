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
                
                if($psa->rowCount() === 1){
                  $resulte = $psa->fetch(PDO::FETCH_ASSOC);
                  $etat =  $resulte ['etat'];
                  if($etat === 'boutique' ){
                    $tecko = 'psa';
                    $tecka = 'Sur boutique';
                  }elseif($etat === 'client' ){
                    $tecko = 'psa';
                    $tecka = 'Sur client';
                  }
                }else{
                  $boutique = "boutique";
                  $client = "client";
                  $inser_psa = $bd->prepare("INSERT INTO psa ( id_boutique, etat ) VALUES (?,?)");
                  $inser_psa->execute(array($_SESSION["id_boutique"], $client ));
                  header("refresh:1");
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