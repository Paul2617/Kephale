<?php

            if(!empty($_GET["rc"]) AND !empty($_GET["id_categorie"]) AND !empty($_GET["id_produit"]) AND !empty($_GET["id_article"])){
               $id_article = $_GET["id_article"];

               $infoArticle =  articles($bd, $id_article);
               require_once ('../models/solde_affiche/solde.php');
               $soldeArticle = solde ($infoArticle["prix"]) ;

               // info paniier de l'article
               if(isset($_SESSION["id"])){
               $infoPanier = panier ($bd, $id_article);
               if($infoPanier === 0){
                $panier = "<input type='submit' value='Ajouter au Panie' name='ajouter'>";
               }elseif($infoPanier === 1){
                $panier = "<input type='submit' value='Supprimer du Panie' name='suprimePanier'>";
               }
               $botoneInfo = 
               "<form method='POST' enctype='multipart/form-data'>
               <input type='submit' value='Acheter' name='acheter'>
               ".$panier."</form>";

               }else{
                $botoneInfo = 'Merci de cree un compte ou vous connections pour efectue un achat.';
               }
            }else{

            }
        
?>