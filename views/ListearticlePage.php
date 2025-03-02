<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/listeproduit&rc=<?= $_GET["rc"]?>&id_categorie=<?= $_GET["id_categorie"]?>" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
</div>
<div style="padding-top: 50px;" ></div>

<div class='listProduiti'>


<h1 class='h1' >Liste Articles</h1>
<?php 
if(is_array($infoArticle) and !empty($infoArticle)){
    foreach($infoArticle as $infoArticles){
        $Solde = solde ($infoArticles["prix"]) ;
        ?>
    <section class = "blochdfg">
    <img src="public/asset/img_article/<?= $infoArticles["img"]  ?>" alt="">
    <h1><?= $infoArticles["nom"] ?></h1>
    <h1 class="soldeFinfo"><?= $Solde ?></h1>
    <a href="/Kephale/articles&rc=<?= $_GET["rc"]?>&id_categorie=<?= $_GET["id_categorie"]?>&id_produit=<?= $_GET["id_produit"]?>&id_article=<?= $infoArticles["id"]?>">Voir +</a>
    </section>
        <?php 
    }

}else{
    echo 'Pas Produit disponible';
}
?>



</div>