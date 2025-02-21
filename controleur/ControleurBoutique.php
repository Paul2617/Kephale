<?php
if(isset($_SESSION["id"])){
    if(isset($_SESSION["id_boutique"])){
        $model = "../models/".$controleur."Manager.php";
        if(file_exists($model)){
            require_once ($model);
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
        }
        














        $page = "../views/".$controleur."Page.php";
        if(file_exists($page)){
            require_once ($page);
        }else{
           echo 'Page_introuvable';
        }
    }else{
        header ('Location: /Kephale/look');
    }

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}


?>