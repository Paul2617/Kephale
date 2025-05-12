<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="/Kephale/boutique">
            <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
        <h5>Liste vente</h5>
    </section>
</div>
<div style="padding-top: 80px;"></div>

<section class="blockFacture">
    <?php
require_once ('../models/solde_affiche/solde.php');

if(isset($liste_ventes)){
    foreach ($liste_ventes as $liste_vente){

        $id_achat = $liste_vente['id'];
        $id_article = $liste_vente['id_article'];
        $id_boutique = $liste_vente['id_boutique'];
        $prix_article = $liste_vente['prix_article'];
        $psa_user = $liste_vente['psa_user'];
        $psa_boutique = $liste_vente['psa_boutique'];
        $promo = $liste_vente['promo'];
        $total = $liste_vente['total'];
        $taille = $liste_vente['taille'];
        $date_achat = $liste_vente['date_achat'];
        $date_livraison = $liste_vente['date_livraison'];
        $etat_livraison = $liste_vente['etat_livraison'];

        // info article
        $info_article = info_article($bd, $id_article);

        // verifie si c'est la boutique a payes le psa
        if (ctype_digit($psa_boutique)) {
            $psa = solde ($psa_boutique);
        }else{
            $psa = null;
        }

        if(ctype_digit($psa_user)) {
            $PSA_userplus = solde ($psa_user);
        }else{
            $PSA_userplus = null;
        }
        // verifi si l'article etait en prommo
        if( $promo !== 'non'){
            $promos = solde ($promo);
            $prix_articles = solde ($prix_article);

        }else{
            $prix_articles = solde ($prix_article);
        }

        if($psa_boutique !== "non"){
            if( $promo !== 'non'){
                $total_boutique = $promo - $psa_boutique;
            }else{
                $total_boutique = $prix_article - $psa_boutique;
            }
        }else{
            if( $promo !== 'non'){
                $total_boutique = $promo ;
            }else{
            $total_boutique = $prix_article ;

            }
        }
        // gere le tempt de livraison
        $tempsLivraisons = tempsLivraisons($bd, $date_livraison, $date_achat);

         // rec info pour le line de l'article
       $recId = recId ($bd,$id_article,$id_boutique );
       // article livre
      $articlelivre = articlelivre($bd, $id_achat, $etat_livraison);
        // verifie si l'achat est annule
        $achat_annule = achat_annule($bd, $id_achat);
?>
    <section style='  margin-bottom: 10px;' class="blockFac">


        <section class='blockInfoArticle'>

            <section style='display: flex;'>
                <img style='object-fit: cover;' src="public/asset/img_article/<?= $info_article['img_article'] ;?>"
                    alt="">
                <section class='InfoArticle'>
                    <h1><?= $info_article['nom_article'] ;?></h1>
                    <h2><?= $info_article['prix_article'] ;?></h2>
                    <a href="/Kephale/articles&id_boutique=<?= $liste_vente['id_boutique'];?>&id_categorie=<?= $recId['id_categorie'];?>&id_produit=<?= $recId['id_produit'];?>&id_article=<?= $id_article ;?>"
                        style='color: #95C11F;'>
                        <h3>Voir l'article</h3>
                    </a>
                </section>
            </section>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_achat" value="<?= $id_achat?>">
                <button class='dddufduud' name="parame" value="Connexion">
                    <h1>:</h1>
                </button>

            </form>
        </section>


        <section class='infoAchata'>
            <?php 
         if( $promo !== 'non'){
            ?>
            <h2>Prix a l'achat : <span style='color: #95C11F;'><?= $promos ?></span> au lieu de <span
                    style='text-decoration: line-through; color: #E94E1B;'><?= $prix_articles  ?></span></h2>
            <?php 
         }else{
            ?>
            <h2>Prix a l'achat : <span><?= $prix_articles  ?></span></h2>

            <?php 
         }
        ?>
            <?php if(isset($psa)){?><h2>psa sur boutique: <span><?= $psa ?></span> </h2> <?php } ?>
            <?php if(isset($PSA_userplus)){?><h2>psa sur client: <span><?= $PSA_userplus ?></span> </h2> <?php } ?>
            <h2>Date d'achat : <span><?= $tempsLivraisons['dateAchat'] ?></span></h2>
            <h2>Date limite : <span><?= $date_livraison ?> Jours</span></h2>
            <h2>Totale : <span><?= solde ($total_boutique) ?> </span></h2>
            <?php 
            // si l'achat n'est annule
            if($achat_annule === true ){
                // si l'article n'est pas livre
                if($etat_livraison === 'non'){
                    // verifi si de dellai de livrais est epuise
                    if($tempsLivraisons['etatLivraion'] === 'non'){
                        ?>
                        <p class='date_position' style=' color: #E94E1B;'>Délai de livraison passé</p>
                        <p class='date_position' style=' color: #E94E1B;'><?= $tempsLivraisons['dateLivraison'] ;?></p>

                        <?php 
                    }
                    // si le delais n'est pas arrive
                    elseif($tempsLivraisons['etatLivraion'] === 'oui'){
                        ?>
                        <div>
                        <p class='date_position'>Date limite pour la livraison</p>
                        <p class='date_position' ><?= $tempsLivraisons['dateLivraison'] ;?></p>
                        </div>
                         <?php
                    }
                }else{
                    if($articlelivre !== null){
                        // verifie si une demande d'annulations de l'article est lanse
                        if(isset( $articlelivre['verdicte'])){
                            if($articlelivre['verdicte'] === 'traitement'){
                                ?>
                                <p class='date_position'>Le client veut annuler la vente <br> Le service de livraison vous contactera dans les 24 h.</p>
                                 <?php 
                            }elseif($articlelivre['verdicte'] === 'accorde'){
                                ?>
                                <p class='date_position'>La demande du client a été accordée.<br>  <a style=' color: #1D71B8;'  href="">Pour plus d'info...</a></p>
                                 <?php 
                            }elseif($articlelivre['verdicte'] === 'refuse'){
                                ?>
                                <p class='date_position' style=' color: #E94E1B;'  >La demande du client a été refusée.<br>  <a style=' color: #1D71B8;'  href="">Pour plus d'info...</a></p>
                                 <?php 
                            }

                        }else{
                            // si le temps de verifiactions 
                            $temp = $articlelivre['temp'];
                            if ($temp > time()) {
                                $chrono = $articlelivre['chrono'];
                                
                                ?>
                                <div>
                                <p class='date_position'>Temps pour la vérification de l'article.</p>
                                <p class='date_position' ><?= $chrono ;?> minutes restantes</p>
                                </div>
                                 <?php 
                            }else{
                                ?>
                                <div>
                                <p class='date_position'>Le client approuve l'article.</p>
                                <p class='date_position'>Merci pour votre confiance.</p>
                                </div>
                                 <?php 
                            }
                        }
                    }
                }
            }else{
                ?>
                <p style=' color: #E94E1B;' class='date_position'>Achat annulé<br>  <a style=' color: #1D71B8;'  href="">Pour plus d'info...</a></p>
                <?php
            }
             ?>



        </section>
    </section>


    <?php
    }
}

?>



</section>

<div style="padding-top: 80px;"></div>