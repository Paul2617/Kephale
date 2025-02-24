<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/listeboutique&rc=<?= $_GET["rc"]?>" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
</div>
<div style="padding-top: 50px;" ></div>

<div class='listProduiti'>

<section class='blocInfoCategories'>
<img src="public/asset/img_boutique/<?= $infoBoutique["img"]?>" alt="">
<section class='ddkfkdk'>
<h2><?= $infoBoutique["nom"]?></h2>
<h3>Catégorie <?= $infoCategorie["types"]?></h3>
</section>
</section>

<h1 class='h1' >Liste Produits</h1>
<?php 
if(is_array($infoProduit) and !empty($infoProduit)){

    foreach($infoProduit as $infoProduits){
        ?>
        <section class = "blochdfg">
    <img src="public/asset/img_produit/<?= $infoProduits["img"]?>" alt="">
    <h1><?= $infoProduits["nom"]?></h1>
    <a href="/Kephale/listearticle&rc=<?= $_GET["rc"]?>&id_categorie=<?= $_GET["id_categorie"]?>&id_produit=<?= $infoProduits["id"]?>">Voir +</a>
    </section>
        <?php 
    }

}else{
    echo 'Pas Produit disponible';
}
?>



</div>