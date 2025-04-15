<div class='nav_bare'>
    <section class="bloc_nave">

    <?php
    retourPagePrecedente();
    ?>
    <h5><?= $nom_boutique?></h5>
        <a class ='lin_connect'href= "/Kephale/user" >
        <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>
<div style="padding-top: 35px;"></div>

<section class='logoboutique'>
    <img src="public/asset/img_boutique/<?= $img_boutique ;?>" alt="">
</section>


<div class='listProduiti'>

<h1 class='h1' >Liste categorie</h1>
<?php 
if($info_categori->rowCount() >= 1){
    while ($result_info_categori = $info_categori->fetch()){
        ?>
        <section class = "blochdfg">
    <img src="public/asset/img_categori/<?= $result_info_categori["img"] ;?>" alt="">
    <h1><?= $result_info_categori["nom"]  ;?></h1>
    <h1 class='soldeFinfo' ><?= $result_info_categori["types"]  ;?></h1>
    <a href="/Kephale/produitplus&id_boutique=<?= $_GET["id"]?>&id_categorie=<?= $result_info_categori["id"]?>">Voir +</a>
    </section>
        <?php 
    }
}

?>





</div>
