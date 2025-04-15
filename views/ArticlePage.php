<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/produit&id_categorie=<?= $_GET["id_categorie"]; ?>" >
        <img class='retoure'  src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Article</h5>
    </section>
</div>
<div style="padding-top: 70px;" ></div>
<section class='blocKategirie'>
<a class ='linkAjout'href="/Kephale/ajoutearticle&id_categorie=<?= $_GET['id_categorie']; ?>&id_produit=<?= $_GET['id_produit']; ?>"><h1>Ajouter article</h1></a>

<?php
foreach( $listeArticle as $listeArticles){
    $tailles = str_replace('+', ' - ', $listeArticles['tailles']);
    $id_article = $listeArticles['id'];
    $img = img($bd, $id_article);
    ?>
    <section class='bloc_article'>
        <img src="public/asset/img_article/<?= $img['nom_image']; ?>" alt="">
        <section class='blockinfoa'>
            <h1><?= $listeArticles['nom']; ?></h1>
            <p><?= $listeArticles['descriptions']; ?> </p>
            <h2>Tailles: <?= $tailles; ?> </h2>

            <section class = 'bloc_linka'>
<a href="">Modifier</a>
<a class='alte' href="">Supprimer</a>
            </section>
        </section>

    </section>
    <?php
}
?>

</section>