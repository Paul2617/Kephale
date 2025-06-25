<?php
if(isset($_SESSION["id"])){
    if(isset($_SESSION["id_boutique"])){
       
      
            require_once ('../models/solde_affiche/solde.php');
            $infoBoutique = infoBoutique($bd);
    
            $infoCategorie = infoCategorie($bd);
            $boutiqueSolde = solde ($infoBoutique["solde"]) ;
            $psa = $infoBoutique["psa"];
              if($psa === 'boutique' ){
                    $tecko = 'psa';
                    $tecka = 'Sur boutique';
                  }elseif($psa === 'client' ){
                    $tecko = 'psa';
                    $tecka = 'Sur client';
                  }
                  
                  $_SESSION["abonnement"] = $infoBoutique["abonnement"];
    }else{
        header ('Location: /Kephale/look');
    }

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}


?>