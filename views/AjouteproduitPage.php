
<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/produit&id_categorie=<?= $_GET["id_categorie"] ?>" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Ajouter Produit</h5>
</div>

<section class="bloc_form">

<section class='bloc_form_p' >
        <h1> Ajouter un produit</h1>
        <p></p>
        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <input  type="text" placeholder="Nom de la catégorie" name="nomCategorie" value="<?php if (isset($nomCategorie)) {echo $nomCategorie;} ?>" >
            </section>
            <section class='bloc_form_input'>
            <section class ='info_radio'>
            <select class="form_input" name="type_categorie">
                    <option value="">Sélectionne</option>
                    <option value="Chaussure">Chaussure</option>
                    <option value="Vêtement">Vêtement</option>
                    <option value="Autre">Autre</option>
                </select>
                    </section>
            </section>
            <p>Veuillez ajouter le photo de la catégorie.</p>
            <section class ='blocfil'>
            <input type="file" id="file" name="img_demande">
            <label for="file">
            <img src="public/asset/_icone/appareil.svg" alt="">
            <h4>Ajouter</h4>
            </label>
            </section>
            <input class="boutton_inpute" class="submit" type="submit" value="Ajouter la produit" name="ajouter">

            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
        </form>
    </section>
    </section>

</section>
