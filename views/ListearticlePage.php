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
        $prixArticle = prixArticle($bd, $infoArticles["prix"]);
        require_once ('../models/solde_affiche/solde.php');
        //$Solde = solde ($infoArticles["prix"]) ;
        ?>
        <section class = "blochdfg">
    <img src="public/asset/img_article/<?= $infoArticles["img"]  ?>" alt="">
    <h1><?= $infoArticles["nom"] ?></h1>
    <h1><?php //$Solde ?></h1>
    <a href="">Voir +</a>
    </section>
        <?php 
    }

}else{
    echo 'Pas Produit disponible';
}
?>



</div>