<?php  
// alerte confirme l'achat
    if(empty($_POST["ferme"])){
    if(isset($_POST["supprimerd"])){
        $titre = "Supprimer le produit";
        $contenue = "En supprimant le produit, vous supprimez tous les articles du produit.";
        $nameBoutton = 'supprimer_produit';
        $valueBoutton = 'Supprimer';
        $nameInfoId = 'id_categorie';
        $valueInfoId = $_GET['id_categorie'];
        require_once ('../components/alerte.php');
        Alerte ( $titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId );
    }
}
?>
<section class='block_info_boutique flex'>

<form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
<section class='blocfildd'>
                    <input type="file" id="file" name="img_demande">
                    <label for="file">
                        <img src="public/asset/img_produit/<?= $img_produit ;?>" alt="">
                        <h4>Modifier l'image</h4>
                    </label>
                </section> 
    <h5 class='h5d'>Nom de la categorie</h5>
        <input class='ddfkdmjfkff'  type="text" name="new_nom_produit" value="<?= $nom_produit ;?>">
        <section class='info_radio_djs' >
                    <select class="form_input_ddj" name="new_types_produit">
                        <option value="<?= $types_produit ;?>"><?= $types_produit ;?></option>
                        <option value="Chaussure">Chaussure</option>
                        <option value="Vêtement">Vêtement</option>
                        <option value="Autre">Autre</option>
                    </select>
                </section>
        <h5 class='h5d'>Type categorie <span class='types_produit_texte'><?= $types_produit ;?></span></h5>
        <input class='ddjfkff' type="submit" value="Modifié" name="modifie_produit"> 
        <input class='ddjfkff' style='background-color: #E94E1B; color:rgb(255, 255, 255);'  type="submit" value="Supprimer" name="supprimerd"> 
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>

<?php 