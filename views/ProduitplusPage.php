<div class='nav_bare'>
    <section class="bloc_nave">

    <?php
    retourPagePrecedente();
    ?>
        <a class ='lin_connect'href= "/Kephale/user" >
        <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>
<div style="padding-top: 70px;"></div>

<div class='listProduiti'>

<h1 class='h1' >Liste produit</h1>
<?php 
if($info_categori->rowCount() >= 1){
    while ($result_info_categori = $info_categori->fetch()){
        ?>
        <section class = "blochdfg">
    <img src="public/asset/img_produit/<?= $result_info_categori["img"] ;?>" alt="">
    <h1><?= $result_info_categori["nom"]  ;?></h1>
    <h1 class='soldeFinfo' ><?= $result_info_categori["types"]  ;?></h1>
    <a href="/Kephale/articleplus&id_boutique=<?= $_GET["id_boutique"]?>&id_categorie=<?= $_GET["id_categorie"]?>&id_produit=<?= $result_info_categori["id"]?>">Voir +</a>
    </section>
        <?php 
    }
}

?>





</div>