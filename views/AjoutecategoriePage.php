<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="/Kephale/boutique">
            <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
        <h5>Ajouter Catégorie</h5>
    </section>

</div>
<div style="padding-top: 80px;"></div>

<section class='block_info_boutique flex'>
    <h1> Ajouter une catégorie</h1>
    <form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
              <section class='blocfildd'>
                    <input type="file" id="file" name="img_demande">
                    <label for="file">
                        <img src="public/asset/_icone/appareil.svg" alt="">
                        <h4>Image</h4>
                    </label>
                </section> 
        <h5 class='h5d'>Nom de la categorie</h5>
        <input class='ddfkdmjfkff' type="text" placeholder="Nom de la catégorie" name="nomCategorie"
            value="<?php if (isset($nomCategorie)) {echo $nomCategorie;} ?>">
                <h5 class='h5d'>Type de la categorie</h5>
        <section class='info_radio_djs'>
            <?php 
            if($_SESSION["abonnement"]  === 'grand'){
                ?>
                <select class="form_input_ddj" name="type_categorie">
                <option value="">Sélectionne</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Enfant">Enfant</option>
                <option value="Électronique">Électronique</option>
                <option value="Cosmétique">Cosmétique</option>
                <option value="Boissons">Boissons</option>
            </select>
                <?php 
            }elseif($_SESSION["abonnement"]  === 'standard'){
                ?>
                <select class="form_input_ddj" name="type_categorie">
                <option value="">Sélectionne</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Enfant">Enfant</option>
            </select>
                <?php 
            }elseif($_SESSION["abonnement"]  === 'electro'){
                ?>
                <select class="form_input_ddj" name="type_categorie">
                <option value="">Sélectionne</option>
                <option value="Électronique">Électronique</option>
               </select>
                <?php 
            }elseif($_SESSION["abonnement"]  === 'resto'){
                ?>
                <select class="form_input_ddj" name="type_categorie">
                <option value="">Sélectionne</option>
                <option value="Restaurant">Restaurant</option>
            </select>
                <?php 
            }elseif($_SESSION["abonnement"]  === 'imo'){
                ?>
                 <select class="form_input_ddj" name="type_categorie">
                <option value="">Sélectionne</option>
                <option value="Immobilier">Immobilier</option>
            </select>
                <?php 
            }elseif($_SESSION["abonnement"]  === 'auto'){
                ?>
                 <select class="form_input_ddj" name="type_categorie">
                <option value="">Sélectionne</option>
                <option value="Automobile">Automobile</option>
                <?php 
            }
            ?>
        </section>
        <input class='ddjfkff' type="submit" value="Ajouter la catégorie" name="ajouter">
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>


