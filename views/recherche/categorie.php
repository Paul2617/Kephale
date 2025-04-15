<div class='listProduiti'>

<?php

while ($result = $stmt->fetch()){
    $nom_categori = $result["nom"];
    $types_categori = $result["types"];
    $img_categori = $result["img"];
    ?>
     <section class = "blochdfg">
    <img src="public/asset/img_categori/<?= $img_categori ;?>" alt="">
    <h1><?= $nom_categori ;?></h1>
    <h1 class='soldeFinfo' ><?= $types_categori  ;?></h1>
    <a href="/Kephale/produitplus&id_boutique=<?= $result["id_boutique"]?>&id_categorie=<?= $result["id"]?>">Voir +</a>
    </section>
<?php
}
?>
</div>
