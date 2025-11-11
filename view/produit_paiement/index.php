<?php new html(); ?>
<body>
        <?php ;
    use Middleware\Page_precedant;
    $page_p = Page_precedant::page_p();
    new Retoure($page_p ); ?>
    
    <div class='div_blok div_blok_tenter'>
        <section class='section'>
            <h1 style="font-size: 1.2rem;">Facture D'achat</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero aut odio modi laborum minima facilis et,
                pariatur, saepe ipsa ea vel iusto officiis ut sit autem minus aliquam, sed quibusdam.</p>
                <?php
                if($i === false){
                    ?>
                <p style=" background-color: #ee4747ff; color: #ffffffff; border-radius: 5px; padding: 5px; margin-top: 2px; margin-bottom: 2px; font-size: 0.8rem; text-align: center;">Votre solde de <?=  $balance_.' '. $devise?> n'est pas suffisant pour effectuer l'achat.</p>
                    <?php
                }
                    ?>
                <p><span>Produit :</span> <?= $InfoProduit['nom']?></p>
                <p><span>Taille :</span> <?= $InfoProduit['taille']?></p>
                <p><span>Quantité :</span> <?=  $qte ?></p>
                <p><span>Couleur :</span> <?= $InfoProduit['nom_color']?></p>
                <p><span>Devise d'achat :</span> <?= $InfoProduit['devise']?></p>
                <p><span>Prix : </span><?= $prix_converti.' '. $dvs ?></p>
                <p><span>TVA :</span> 00.0 <?= $InfoProduit['devise']?></p> 
            <h4> Total = <?=  $prix_total_converti.' '. $InfoProduit['devise']?></h4>
            <?php
                if($i === true){
                    ?>
            <form method="POST" enctype="multipart/form-data">
                <p class='formTexte'>Mot de passe</p>
                <input type="password" placeholder="Mot de passe" name="password" required>
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <input class="submit" type="submit" value="Paiement" name="paiement">
                <?php if (isset($errors)) { ?> <h2 style="padding-bottom: 15px; text-align: center;" class="erreur"><?php echo $errors ?></h1> <?php } ?>
            </form>
            <?php
                }elseif($i === false){
                     ?>
            <form method="POST" enctype="multipart/form-data" style=' margin-top: 10px;'>
                <input class="submit" type="submit" value="Récharge mon compte" name="recharge">
                <?php if (isset($errors)) { ?> <h2 style="padding-bottom: 15px; text-align: center;" class="erreur"><?php echo $errors ?></h1> <?php } ?>
            </form>
            <?php
                }
                ?>

        </section>
    </div>
</body>
