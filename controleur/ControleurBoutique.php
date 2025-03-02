<?php
if(isset($_SESSION["id"])){
    if(isset($_SESSION["id_boutique"])){
       
            $etatAbonnement = etatAbonnement($bd);
            if($etatAbonnement === 'expire'){
                header ('Location: /Kephale/reabonnement');
            }elseif($etatAbonnement === 'G'){
                $tecko = '10%';
                $tecka = 'Sur achat';
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