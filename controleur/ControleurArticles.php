<?php

            if(!empty($_GET["id_article"])){
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
                // Ajoute le panier
            if(isset($_POST["ajouter"])){
               ajourtPanier ($bd, $id_article);

            }
                // Supprimer le panier
            if(isset($_POST["suprimePanier"])){
               supprimerPanier ($bd, $id_article);

            }

            if (isset($_POST["acheter"])){
               if($infoArticle["tailles"] !== 'null'){
                  if(isset($_POST['options']) and !empty($_POST['options'])){
                     $taillesselecte = $_POST['options'];
                     $tr = true;
                  }else{
                     $erreur = 'Sélectionne la taille..';
                  }
               }else{
                  $taillesselecte = 'null';
                  $tr = true;
               }

            }
               // info paniier de l'article
               if(isset($_SESSION["id"])){
               $etat = $infoArticle['etat']; 
               $infoPanier = panier ($bd, $id_article);
               if($etat === '1'){
               if($infoPanier === 0){
                $panier = "<input class='boutton_inpute' style = ' background-color: #95C11F;'  type='submit' value='Ajouter au Panier' name='ajouter'>";
               }elseif($infoPanier === 1){
                $panier = "<input style = ' background-color: #E94E1B;' type='submit' value='Supprimer' name='suprimePanier'>";
               }
               $botoneInfo = 
               "<form method='POST' enctype='multipart/form-data'>
               <input type='submit' value='Acheter' name='acheter'>
               ".$panier."</form>";
               }else{
               $botoneInfo = 'Article indisponible';
}
               }else{
                $botoneInfo = 'Merci de cree un compte ou vous connections pour efectue un achat.';
               }
               
            }

        if(isset($tr)){
         header ('Location: /Kephale/facture&id_article='.$_GET["id_article"].'&taille='.$taillesselecte);
        }
?>