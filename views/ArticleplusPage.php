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

<h1 class='h1' >Liste articles</h1>
<?php 
if($info_categori->rowCount() >= 1){
    while ($result_info_categori = $info_categori->fetch()){
        $Solde = solde ($result_info_categori["prix"] ) ;
        $id_article = $result_info_categori["id"] ;
            $rec = $bd->prepare('SELECT nom_image FROM images_article WHERE article_id = ? LIMIT 1');
            $rec->execute(array($id_article));
            $img = $rec->fetch();
        ?>
        <section class = "blochdfg">
    <img src="public/asset/img_article/<?= $img["nom_image"] ;?>" alt="">
    <h1><?= $result_info_categori["nom"]  ;?></h1>
    <h1 class='soldeFinfo' ><?= $Solde  ;?></h1>
    <a href="/Kephale/articles&id_boutique=<?= $_GET["id_boutique"]?>&id_categorie=<?= $_GET["id_categorie"]?>&id_produit=<?= $_GET["id_produit"]?>&id_article=<?= $result_info_categori["id"] ?>">Voir +</a>
    </section>
        <?php 
    }
}

?>





</div>