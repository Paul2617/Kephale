<?php ; new html(); ?>
<body>
    <?php ; new Retoure('/offre'); ?>
        <div class='div_blok div_blok_tenter'>
        <section class='section section_width'>
            <h1 style="font-size: 1.2rem;">Création de la boutique</h1>
            <div style=" margin-bottom: 2rem;"></div>
                  <form method="POST" enctype="multipart/form-data">
                    <?php ; new ImgFile(); ?>
               <p class='formTexte'>Nom complet</p>
               <input type="text" placeholder="Nom complet" name="nom_boutique"
                        value="<?php if (isset($nom_boutique)) {echo $nom_boutique;} ?>" required autocomplete="off">
                         <p class='formTexte'>Pays</p>

                    <div class="bloc_taille">
                        <div class="form-element-plus">
                            <input type="radio" name="pays" value="Mali" id="Mali" >
                            <label for="Mali">
                                <div class="title">Mali</div>
                            </label>
                        </div>
                        <div class="form-element-plus">
                            <input type="radio" name="pays" value="Burkina" id="Burkina">
                            <label for="Burkina">
                                <div class="title">Burkina</div>
                            </label>
                        </div>
                        <div class="form-element-plus">
                            <input type="radio" name="pays" value="Niger" id="Niger">
                            <label for="Niger">
                                <div class="title">Niger</div>
                            </label>
                        </div>
                    </div>
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
               <input class="submit" type="submit" value="Valide la création" name="valide"> 

               <?php if (isset($errors)) { ?>
                 <h2 class="erreur"><?php echo $errors ?></h1> 
               <div style=" margin-bottom: 0.2rem;"></div>
                 <?php } ?>

            </form>
        </section>
    </div>
</body>