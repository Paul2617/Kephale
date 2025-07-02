<?php 
 require_once ('../controleur/cookie/historique_page_retoure.php'); 
$requestUri = $_SERVER['REQUEST_URI'];
 
 ?>
<div class='nav_bare plus_nav'>
    <section class="bloc_nave">
        <a class='lin_connect' href="<?php echo getLastPage(); ?>"><img class='retoure'
                src='public/asset/_icone/retoure.svg'></a>
        <a class='lin_connect' href="/Kephale/user">
            <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>

<?php
$id_article = $infoArticle ["id"];
$rec = $bd->prepare('SELECT nom_image FROM images_article WHERE article_id = ? ORDER BY id ASC ');
$rece = $bd->prepare('SELECT nom_image FROM images_article WHERE article_id = ? ORDER BY id ASC LIMIT 1');
$rec->execute(array($id_article));
$rece->execute(array($id_article));

        ?>

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
                    href="/Kephale/articles<?php if(isset($_GET['rc'])){ echo '&rc='.$_GET['rc']; }?><?php if(isset($_GET['id_categorie'])){echo '&id_categorie='.$_GET['id_categorie']; } ?><?php if(isset($_GET['id_produit'])){echo '&id_produit='.$_GET['id_produit']; }?>&id_article=<?= $_GET['id_article']?>&image=<?= $img["nom_image"] ?>">
                    <img style=" <?php if(isset($_GET['image'])){ if($_GET['image'] === $img["nom_image"] ){?>border: 2px solid #94C123;<?php } }?>"
                        class="hdudjdgdg" src="public/asset/img_article/<?php echo $img["nom_image"]  ?>" alt="">
                </a>
                <?php
}
}
            ?>
            </section>
        </section>

        <section class='blocInfoArticle'>
            <h1><?= $infoArticle ["nom"] ?></h1>
            <h2><?= $infoArticle ["descriptions"] ?></h2>
            <h3 class='local_h2' style=' color: #95C11F;' > <img class='local_' src="public/asset/home_svg/cfa.svg" alt=""> <?= $soldeArticle ?> </h3>
            <h2>La livraison est effectuée par tout au Mali.<br> Seulement <span>200 FCFA</span> par kilomètre sont facturés pour la livraison.</h2>
            <?php 
            if(isset($ok)){

             if( $ok === true){
                ?>
                <h2>Livraison:  <span><?= $frais   ?> </span></h2>
                <h2 class='local_h2'><img class='local_' src="public/asset/home_svg/local1.svg" alt=""> <?= "Vous êtes à ".$km?> </h2>
                <?php 
             }else{
                    ?>
                <h2>Pour enregistrer votre lieu de livraison, il vous suffit de vous rendre dans le <span>paramètre</span> et de cliquer sur <span>Obtenir ma position.</span><span> </span></h2>
                <?php 
             }
            }else{
                if( $adresse_u === false ){
                 ?>
                <h2>Pour enregistrer votre lieu de livraison, il vous suffit de vous rendre dans le <span>paramètre</span> et de cliquer sur <span>Obtenir ma position.</span><span></span></h2>
                <?php 
                }
       
            }

            ?>
        </section>


</section>
        

























             <section class='sectionBloc'>
           <form style = 'flex-direction: column; width: 100%;' method="POST" enctype="multipart/form-data">

            <?php
            if($infoArticle["tailles"] !== 'null'){
                if($i  < count($tailless)){
                    ?>

                     <?php 
                     if (isset($erreur)) 
                     { ?> <h5 class="ddhfj plus"><?php echo $erreur ?></h5> <?php 
                     }else{
                        ?> <h5 class="ddhfj">Tailles disponibles </h5><?php 
                     }
                     ?>
                   

                  <div class="bloc_taille" >

                      <?php
                    foreach($tailless as $taillesse){
                        ?>
                            <div style= 'z-index: 4;' class="form-element">
                                <input type="radio" name="options" value="<?= $taillesse ?>" id="<?= $taillesse ?>">
                                <label for="<?= $taillesse ?>">
                                    <div class="title"><?= $taillesse ?></div>
                                </label>
                            </div>
                            <?php
                    }
                }
                  ?>
                    </div>
      
          <?php
            }
?>
            <div class='blocBoto_style'>
        <div  class='blocBoto_style_bloke'>
            <?= $botoneInfo?>
            <a class="icon_mms_link"  href="">
            <img class="icon_mms" src="public/asset/home_svg/message.svg" alt="">
            </a>
        </div>
    </div>
        </form>
       

        </section>


   


        































