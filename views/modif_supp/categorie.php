
<?php  
// alerte confirme l'achat
    if(empty($_POST["ferme"])){
    if(isset($_POST["supprimerd"])){
        $titre = "Supprimer la catégorie";
        $contenue = "En supprimant la catégorie, vous supprimez tous les produits et articles de cette catégorie.";
        $nameBoutton = 'supprimer_categorie';
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
                        <img src="public/asset/img_categori/<?= $info_categorie['img_categorie'];?>" alt="">
                        <h4>Modifier l'image</h4>
                    </label>
                </section> 
    <h5 class='h5d'>Nom de la categorie</h5>
        <input class='ddfkdmjfkff'  type="text" name="new_nom_categorie" value="<?= $info_categorie['nom_categorie'];?>">
        <h5 class='h5d'>Type categorie '<?= $info_categorie['types_categorie'];?>'</h5>
        <input class='ddjfkff' type="submit" value="Modifié" name="modifie_categorie"> 
        <input class='ddjfkff' style='background-color: #E94E1B; color:rgb(255, 255, 255);'  type="submit" value="Supprimer" name="supprimerd"> 
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>

<?php 
