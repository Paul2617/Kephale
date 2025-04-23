<?php  require_once ('../controleur/cookie/historique_page_retoure.php');  ?>
<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect' href="<?= getLastPage(); ?>"><img class='retoure'  src='public/asset/_icone/retoure.svg' ></a>
<a class ='lin_connect'href= "/Kephale/user" >
        <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>
<div style="padding-top: 50px;" ></div>

<div class='listProduiti'>


<h1 class='h1' >Liste Articles</h1>
<?php 
if(is_array($infoArticle) and !empty($infoArticle)){
    foreach($infoArticle as $infoArticles){
        require_once ('../models/solde_affiche/solde.php');
        $Solde = solde ($infoArticles["prix"]) ;
        $id_article = $infoArticles["id"];
        $rec = $bd->prepare('SELECT nom_image FROM images_article WHERE article_id = ? LIMIT 1');
        $rec->execute(array($id_article));
        $img = $rec->fetch();
        ?>
    <section class = "blochdfg">
    <img src="public/asset/img_article/<?= $img["nom_image"]  ?>" alt="">
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