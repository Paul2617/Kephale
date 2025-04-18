<?php
    // cookie historique_recherche
    if (isset($_COOKIE['historique_recherche'])) {
        $historique = json_decode($_COOKIE['historique_recherche'], true);

        if (!is_array($historique)) {
            $historique = [];
        }
        if(isset($sql)){
            if($stmt->rowCount() >= 1){
                $recherche = $search_term;
                   // Éviter les doublons
        if (!in_array($recherche, $historique)) {
            $historique[] = $recherche;
            // Mettre à jour le cookie (durée : 30 jours)
            setcookie('historique_recherche', json_encode($historique), time() + (30 * 24 * 60 * 60), "/");
        }
            }
        }
      
    }else{
       
        $nom_COOKIE= 'historique_recherche';
        $historique = [];
        $expiration = time() + (30 * 24 * 60 * 60); // 30 jours
       // setcookie($nom_COOKIE, json_encode($historique), $expiration, "/");
    
    }