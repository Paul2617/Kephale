<div class='nav_bare'>
<section class="bloc_nave">
    <?php
retourPagePrecedente();
?>
    </section>
</div>
<div style="padding-top: 60px;"></div>
<div class='blockehdte'>

    <section class='blockarticle'>
        <section class='blocImg'>
            <img src="public/asset/img_article/<?= $infoArticle ["img"] ?>" alt="">
        </section>

        <section class="scrole_img">
            <section class="scrol_img_s">

                <a class="uegeeyg"
                    href="index.php?page=arti&id_produit=<?php echo $id_produit ?>&type=<?php echo $type ?>&id_groupe_article=<?php echo $id_groupe_article ?>&id_article=<?php echo $id_article ?>">
                    <img style="<?php if(empty($_GET['image'])){?>border: 2px solid #94C123;<?php } ?>"
                    class="hdudjdgdg" src="public/asset/img_article/<?php echo $infoArticle["img"] ?>" alt="">
                </a>

                <a  class="uegeeyg" href="index.php?page=arti&id_produit=<?php echo $id_produit ?>&type=<?php echo $type ?>&id_groupe_article=<?php echo $id_groupe_article ?>&id_article=<?php echo $id_article ?>&image=<?= $nom_img;?>">
                <img style=" <?php if(isset($_GET['image'])){ if($_GET['image'] === $result["img"] ){?>border: 2px solid #94C123;<?php } }?>" class="hdudjdgdg" src="public/asset/img_article/<?php echo $infoArticle["img"]  ?>" alt="">
                </a>

                
            </section>
        </section>

        <section class='blocInfoArticle'>
            <h1><?= $infoArticle ["nom"] ?></h1>
            <h2><?= $infoArticle ["descriptions"] ?></h2>
            <h3><?= $soldeArticle ?> </h3>
        </section>
        <h5 class="ddhfj">Sélectionnées les tailles disponibles</h5>
        <div class="bloc_taille">
            <?php
if($i  < count($tailless)){
    foreach($tailless as $taillesse){
        ?>
            <div class="form-element">
                <input type="radio" name="options[]" value="<?= $taillesse ?>" id="<?= $taillesse ?>">
                <label for="<?= $taillesse ?>">
                    <div class="title"><?= $taillesse ?></div>
                </label>
            </div>
            <?php
    }
}
?>
        </div>

        <section class='sectionBloc'>
            <?= $botoneInfo?>
        </section>

    </section>