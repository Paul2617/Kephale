<div class='listProduiti'>

<?php

while ($result = $stmt->fetch()){
    $nom_article = $result["nom"];
    $prix_article = $result["prix"];
    $img_article = $result["img"];
    $Solde = solde ($prix_article ) ;
    ?>
     <section class = "blochdfg">
    <img src="public/asset/img_article/<?= $img_article ;?>" alt="">
    <h1><?= $nom_article ;?></h1>
    <h1 class='soldeFinfo' ><?= $Solde  ;?></h1>
    <a href="/Kephale/articles&id_boutique=<?= $result["id_boutique"]?>&id_categorie=<?= $result["id_categorie"]?>&id_produit=<?= $result["id_produit"]?>&id_article=<?= $result["id"] ?>">Voir +</a>
    </section>
<?php
}
?>
</div>