<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/listearticle&rc=<?= $_GET["rc"]?>&id_categorie=<?= $_GET["id_categorie"]?>&id_produit=<?= $_GET["id_produit"]?>" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
</div>
<div style="padding-top: 60px;" ></div>

<div class='blocke'>
<section class='blockarticle'>
<img src="" alt="">
<section class='blocImg'>
<img src="" alt="">
</section>
<section class='blocInfoArticle'>
<h1><?= $infoArticle ["nom"] ?></h1>
<h2><?= $infoArticle ["descriptions"] ?></h2>
<h2><?= $soldeArticle ?></h2>
</section>
<section class='sectionBloc'>
<?= $botoneInfo?>  

</section>
</section>
</div>
<?php
?>