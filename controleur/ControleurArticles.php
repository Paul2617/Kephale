<?php

            if( !empty($_GET["id_categorie"]) AND !empty($_GET["id_produit"]) AND !empty($_GET["id_article"])){
               $id_article = $_GET["id_article"];

               $infoArticle =  articles($bd, $id_article);
               require_once ('../models/solde_affiche/solde.php');
               $soldeArticle = solde ($infoArticle["prix"]) ;
               if($infoArticle["tailles"] === 0){
               }else{
                  $taille = str_replace('+', ' ', $infoArticle["tailles"]);
                  $tailless = explode(" ",  $taille);
                  $i = 0;
               }
            if(isset($_POST["ajouter"])){
               ajourtPanier ($bd, $id_article);

            }
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