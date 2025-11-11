<?php ; new html(); ?>

<body>
    <?php ; new Retoure('/offre/boutique'); ?>
    <div class='div_blok div_blok_tenter'>
        <section class='section'>
            <h1 style="font-size: 1.2rem;">Grand</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero aut odio modi laborum minima facilis et,
                pariatur, saepe ipsa ea vel iusto officiis ut sit autem minus aliquam, sed quibusdam.</p>
            <h3>15.000 FCFA / Mois</h3>
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
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <input class="submit" type="submit" value="Récharge mon compte" name="recharge">
                <?php if (isset($errors)) { ?> <h2 style="padding-bottom: 15px; text-align: center;" class="erreur"><?php echo $errors ?></h1> <?php } ?>
            </form>
            <?php
                }
                ?>

        </section>
    </div>
</body>