<?php  require_once ('../controleur/cookie/historique_page_retoure.php');  ?>
<div class='nav_bare'>
    <section class="bloc_nave">
        <a class='lin_connect' href="<?php echo getLastPage(); ?>"><img class='retoure'
                src='public/asset/_icone/retoure.svg'></a>
        <a class='lin_connect' href="/Kephale/user">
            <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>
<div style="padding-top: 60px;"></div>
<?php
$id_article = $infoArticle ["id"];
$rec = $bd->prepare('SELECT nom_image FROM images_article WHERE article_id = ? ORDER BY id ASC ');
$rece = $bd->prepare('SELECT nom_image FROM images_article WHERE article_id = ? ORDER BY id ASC LIMIT 1');
$rec->execute(array($id_article));
$rece->execute(array($id_article));

$requestUri = $_SERVER['REQUEST_URI'];
        ?>
<div class='blockehdte'>
    <section class='blockarticle'>
        <section class='blocImg'>
            <img src="public/asset/img_article/<?= $_GET['image'] ?>" alt="">
        </section>

        <section class="scrole_img">
            <section class="scrol_img_s">
                <?php
            if ($rec->rowCount() > 0){
                $imge = $rece->fetch(PDO::FETCH_ASSOC);
                $imges = $imge['nom_image'];
                if(isset($_GET['image'])){ }else{
                    header("Location: ".$requestUri.'&image='.$imges );
                    exit;
                }

while ($img = $rec->fetch(PDO::FETCH_ASSOC)){
      ?>

                <a class="uegeeyg"
                    href="/Kephale/articles<?php if(isset($_GET['rc'])){ echo '&rc='.$_GET['rc']; }?>&id_categorie=<?= $_GET['id_categorie']?>&id_produit=<?= $_GET['id_produit']?>&id_article=<?= $_GET['id_article']?>&image=<?= $img["nom_image"] ?>">
                    <img style=" <?php if(isset($_GET['image'])){ if($_GET['image'] === $img["nom_image"] ){?>border: 2px solid #94C123;<?php } }?>"
                        class="hdudjdgdg" src="public/asset/img_article/<?php echo $img["nom_image"]  ?>" alt="">
                </a>
                <?php
}}
            ?>



            </section>
        </section>

        <section class='blocInfoArticle'>
            <h1><?= $infoArticle ["nom"] ?></h1>
            <h2><?= $infoArticle ["descriptions"] ?></h2>
            <h3><?= $soldeArticle ?> </h3>
        </section>
        <section class='sectionBloc'>

        <form style = 'flex-direction: column; width: 100%;' method="POST" enctype="multipart/form-data">

            <?php
            if($infoArticle["tailles"] !== 'null'){
                if($i  < count($tailless)){
                    ?>
                            <h5 class="ddhfj">Sélectionnées les tailles disponibles</h5>
        <div class="bloc_taille">

                      <?php
                    foreach($tailless as $taillesse){
                        ?>
                            <div class="form-element">
                                <input type="radio" name="options" value="<?= $taillesse ?>" id="<?= $taillesse ?>">
                                <label for="<?= $taillesse ?>">
                                    <div class="title"><?= $taillesse ?></div>
                                </label>
                            </div>
                            <?php
                    }
                }
            }else{
                ?>
<div class="bloc_taille">

          <?php
            }

?>
        </div>

        <section class='sectionBloc'>
            <?= $botoneInfo?>

        </section>
        </form>
        </section>
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>

    </section>