<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect'
            href="/Kephale/article&id_categorie=<?= $_GET['id_categorie']; ?>&id_produit=<?= $_GET['id_produit']; ?>">
            <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
        <h5>Ajouter article</h5>
    </section>

</div>
<style>
.bloc_formE {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 200px;
}
</style>
<div style="padding-top: 80px;"></div>
<section class='block_info_boutique flex'>
    <h1> Ajouter un article </h1>
    <form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
        <section class='blocfildd'>
            <input type="file" id="file" name="images[]" multiple>
            <label for="file">
                <img src="public/asset/_icone/appareil.svg" alt="">
                <h4>Image</h4>
            </label>
        </section>

        <h5 class='h5d'>Nom de l'article</h5>
        <input class='ddfkdmjfkff' type="text" placeholder="Nom de l'article" name="nomArticle"
            value="<?php if (isset($nomArticle)) {echo $nomArticle;} ?>">

        <h5 class='h5d'>Prix de l'article</h5>
        <input class='ddfkdmjfkff' type="number" placeholder="Prix de l'article" name="prixArticle"
            value="<?php if (isset($prixArticle)) {echo $prixArticle;} ?>">

        <h5 class='h5d'>Nom de l'article</h5>
        <textarea class="doldkdmslls"  name="descriptions_article" placeholder="Descriptions"
                    rows="5"><?php if (isset($descriptions_article)) {echo $descriptions_article;} ?></textarea>
        <?php
                // si la boutique est payen par mois
                if($modeBoutique === 'P'){
                    ?>
        <h5 class='h5d'>Si l'artcle est sur commande vous pouvez déterminer un délai de livraison.</h5>
        <section class='info_radio_djs'>
            <select class="form_input_ddj" name="date_livraison">
                <option value="">Sélectionne</option>
                <option value="">Délai de livraison</option>
                <option value="432000">(5) jours</option>
                <option value="864000">(10) jours</option>
                <option value="1296000">(15) jours</option>
                <option value="1728000">(20) jours</option>
            </select>
        </section>
        <?php
                }
                ?>
        <h5 class='h5d'>Type du aticle</h5>
        <?php
                     if($typesProduit === 'Vêtement'){
                        require_once "../views/taille/taille_vetement.php";
                     }elseif($typesProduit === 'Chaussure'){
                        require_once "../views/taille/taille_chaussure.php";
                     }

                ?>
        <input class='ddjfkff' type="submit" value="Ajouter l'article " name="ajouter">
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>
