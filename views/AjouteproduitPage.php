<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="/Kephale/produit&id_categorie=<?= $_GET["id_categorie"] ?>">
            <img class='retoure'  src="public/asset/_icone/retoure.svg" alt="">
        </a>
        <h5>Ajouter Produit</h5>
    </section>
</div>
<div style="padding-top: 80px;"></div>
<section class='block_info_boutique flex'>
    <h1> Ajouter un produit </h1>
    <form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
              <section class='blocfildd'>
                    <input type="file" id="file" name="img_demande">
                    <label for="file">
                        <img src="public/asset/_icone/appareil.svg" alt="">
                        <h4>Image</h4>
                    </label>
                </section> 
        <h5 class='h5d'>Nom </h5>
        <input class='ddfkdmjfkff' type="text" placeholder="Nom du produit" name="nom_produit"
                    value="<?php if (isset($nomProduit)) {echo $nomProduit;} ?>">
<?php 
if( $_SESSION["type_boutique"] === 'resto'){
?>
<h5 class='h5d'>Sélectionne</h5>
   <section class='info_radio_djs'>
            <select class="form_input_ddj" name="type_categorie">
              <option value="">Sélectionne</option>
                        <option value="Menu">Menu</option>
                        <option value="Réservation">Réservation</option>
            </select>
        </section>
<?php 
}elseif( $_SESSION["type_boutique"] ==='cosmetique'){
    ?>
   <section class='info_radio_djs'>
            <select class="form_input_ddj" name="type_categorie">
              <option value="">Sélectionne</option>
                        <option value="Cosmétique">Cosmétique</option>
            </select>
        </section>
<?php 
}elseif( $_SESSION["type_boutique"] ==='electro'){
    ?>
   <section class='info_radio_djs'>
            <select class="form_input_ddj" name="type_categorie">
              <option value="">Sélectionne</option>
                        <option value="Électronique">Électronique</option>
            </select>
        </section>
<?php 
}elseif( $_SESSION["type_boutique"] ==='imo'){
    ?>
   <section class='info_radio_djs'>
            <select class="form_input_ddj" name="type_categorie">
              <option value="">Sélectionne</option>
                        <option value="Immobilier">Immobilier</option>
            </select>
        </section>
<?php 
}elseif( $_SESSION["type_boutique"] ==='auto'){
    ?>
   <section class='info_radio_djs'>
            <select class="form_input_ddj" name="type_categorie">
              <option value="">Sélectionne</option>
                        <option value="Automobile">Automobile</option>
            </select>
        </section>
<?php 
}

else{
    ?>
    <h5 class='h5d'>Type du Produit</h5>
            <section class='info_radio_djs'>
            <select class="form_input_ddj" name="type_categorie">
              <option value="">Sélectionne</option>
                        <option value="Chaussure">Chaussure</option>
                        <option value="Vêtement">Vêtement</option>
                        <option value="Autre">Autre</option>
            </select>
        </section>
    <?php 
}
?>
        <input class='ddjfkff' type="submit"  value="Ajouter le produit" name="ajouter">
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>

