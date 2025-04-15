<div class='listProduiti'>

<?php

while ($result = $stmt->fetch()){
    $nom_produit = $result["nom"];
    $types_produit = $result["types"];
    $img_produit = $result["img"];
    ?>
     <section class = "blochdfg">
    <img src="public/asset/img_produit/<?= $img_produit ;?>" alt="">
    <h1><?= $nom_produit ;?></h1>
    <h1 class='soldeFinfo' ><?= $types_produit  ;?></h1>
    <a href="/Kephale/produitplus&id_boutique=<?= $result["id_boutique"]?>&id_categorie=<?= $result["id_categorie"]?>&id_produit=<?= $result["id"]?>">Voir +</a>
    </section>
<?php
}
?>
</div>