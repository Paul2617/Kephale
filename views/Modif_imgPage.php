<?php  
$id_produits = htmlspecialchars($_GET["id_produit"]) ;
$id_categories = htmlspecialchars($_GET["id_categorie"]) ;
$id_articles = htmlspecialchars($_GET["id_article"]) ;

?>
<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="/Kephale/?url=modif_supp&page=article&id_produit=<?= $id_produits ?>&id_categorie=<?= $id_categories ?>&id_article=<?= $id_articles ?>"><img class='retoure'
                src='public/asset/_icone/retoure.svg'></a>
        <a class='lin_connect' href="/Kephale/user">
            <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>
<div style="padding-top: 80px;"></div>

<section class='block_info_boutique flex'>

<form class='ffdofjfjjd' method="POST" enctype="multipart/form-data">
<section class='blocfildd'>
                    <input type="file" id="file" name="images[]" multiple >
                    <label for="file">
                        <img src="public/asset/img_article/<?=  $recupeUneImg ;?>" alt="">
                        <h4>Ajouter plus d'image</h4>
                    </label>
                </section> 
        <input class='ddjfkff' type="submit" value="Ajouter" name="ajouter"> 
             <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>


<div class='listProduiti'>

<?php  
if($recupeTousLesImg !== null){
foreach( $recupeTousLesImg as  $recupeTousLesImgs){
    $IdImgs = $recupeTousLesImgs["id"];
    $imgs = $recupeTousLesImgs["nom_image"];
    
   ?> 
    <section class = "blochdfg">
    <img src="public/asset/img_article/<?= $imgs ;?>" alt="">
    <form class='ffdofjfjjd'  method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_imgs" value="<?= $IdImgs ?>">
         <input type="hidden" name="nom_img" value="<?= $imgs ?>">
        <input style='background-color: #E94E1B; color:rgb(255, 255, 255);'  class="ddjfkff" type="submit" value="Supprimer" name="supprimer">
    </form>
    </section>
   <?php  
}
}


?>
</div>