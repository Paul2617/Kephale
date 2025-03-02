<?php

            if(!empty($_GET["rc"]) AND !empty($_GET["id_categorie"]) AND !empty($_GET["id_produit"])){
                $id_produit = $_GET["id_produit"];
                $infoArticle =  listeArticle($bd, $id_produit);

        require_once ('../models/solde_affiche/solde.php');
                
            }else{

            }
        
?>