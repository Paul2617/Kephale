<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/article&id_categorie=<?= $_GET['id_categorie']; ?>&id_produit=<?= $_GET['id_produit']; ?>" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Ajouter article</h5>
</div>
<style>
    .bloc_formE{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 200px;
    }
</style>
<div style="padding-top: 80px;" ></div>
<section class='bloc_formE'>
<section class='bloc_form_p' >
        <h1> Ajouter  l'article</h1>
        <p></p>
        <form method="POST" enctype="multipart/form-data">
            <section class='bloc_form_input'>
            <input  type="text" placeholder="Nom de l'article" name="nomArticle" value="<?php if (isset($nomArticle)) {echo $nomArticle;} ?>" >
            <input  type="number" placeholder="Prix de l'article" name="prixArticle" value="<?php if (isset($prixArticle)) {echo $prixArticle;} ?>" >
            <textarea class="jdhjgfd" name="descriptions_article" placeholder="Descriptions" rows="5"><?php if (isset($descriptions_article)) {echo $descriptions_article;} ?></textarea>
            <?php
                     if($typesProduit === 'Vêtement'){
                        require_once "../views/taille/taille_vetement.php";
                     }elseif($typesProduit === 'Chaussure'){
                        require_once "../views/taille/taille_chaussure.php";
                     }

                ?>
                <?php
                // si la boutique est payen par mois
                if($modeBoutique === 'P'){
                    ?>
                         <h5>Si l'artcle est sur commande vous pouvez déterminer un délai de livraison.</h5>
                 <section class ='info_radio'>
                 <select class="form_input" name="date_livraison">
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
            
                       
            </section>
            
            <p>Veuillez ajouter le photo de l'article.</p>
            <section class ='blocfil'>
            <input type="file" id="file" name="img_demande">
            <label for="file">
            <img src="public/asset/_icone/appareil.svg" alt="">
            <h4>Ajouter</h4>
            </label>
            </section>
            <input class="boutton_inpute" class="submit" type="submit" value="Ajouter la catégorie" name="ajouter">

            <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
        </form>
    </section>
</section>


