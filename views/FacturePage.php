<?php  require_once ('../controleur/cookie/historique_page_retoure.php');  ?>
<?php  
    if(empty($_POST["ferme"])){
    if(isset($_POST["parame"])){
        ?>
<section class='blocleArte'>
    <section class='bloKleArteb'>
        <section class='blocanule'>
            <form action="" method="POST" enctype="multipart/form-data">
                <button class='dpdiido dddufduud ' name="ferme" value="Connexion">
                    <h1 class='dpdiido'>x</h1>
                </button>
            </form>
        </section>

        <section class='blockinfoAlte'>
            <p>infos</p>
        </section>
    </section>
</section>
<?php  
    }
}
    ?>




<div class='nav_bare'>
    <section class="bloc_nave">

        <a class='lin_connect' href="<?= getLastPage(); ?>"><img class='retoure'
                src='public/asset/_icone/retoure.svg'></a>
        <a class='lin_connect' href="/Kephale/user">
            <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
    </section>
</div>
<div style="padding-top: 70px;"></div>

<div class="blockFacture" >
    <section class='blockFac'>

        <section class='blockInfoArticle'>
            <section style='display: flex;'>
                <img style = 'object-fit: cover;' src="public/asset/img_article/<?= $img_article ;?>" alt="">
                <section class='InfoArticle'>
                    <h1><?= $info_article["nom"] ?></h1>
                    <h2><?= $Montane_prix ?></h2>
                    <h3><?= $nom_boutique ?></h3>
                </section>
            </section>

        </section>
        <section class='infoAchata'>
            <h1>Facture</h1> 
            <?php 
            if(isset($pourcentage)){
                ?>
                <p>Réduction de <?= $pourcentage ?> %</p>
              <h2>Prix: <span style = 'color: #95C11F;' ><?= $Montan_prix  ?></span> au lieu de <span style = 'text-decoration: line-through; color: #E94E1B;' ><?= $Montane_prix  ?></span> </h2>

                <?php 
            }else{
                ?>
              <h2>Prix: <span ><?= $Montan_prix  ?></span></h2>
                <?php 
            }
            ?>
            <?php 
             if($taille  !== "null"){
                ?>
            <h2>Tailles: <span><?= $taille  ?></span></h2>
                <?php
            } ?>
            <h2>Délai de livraison: <span><?=  $date_livraison  ?></span></h2>
            <?php 
            if($psa !== null){
             if($psa["compte"] === 'client'){
                ?>
                        <h2>PSA: <span><?=  $psa_prix  ?> </span></h2>
                <?php
            } }?>

            <h2>Total: <span><?=  $total  ?></span></h2>
            <p>Il est possible d'annuler l'achat et obtenir un remboursement pour la commande, dans le cas où l'article
                ne serait pas livré avant la date limite de livraison.</p>
        </section>
    </section>
</div>
<div style="padding-top: 20px;"></div>
<section class='bloc_form_p'>
    <form method="POST" enctype="multipart/form-data">
        <section class='bloc_form_input'>
            <input type="password" placeholder="Mot de passe" name="password_user">
        </section>
        <input class="boutton_inputee" class="submit" type="submit" value="Confirme l'achat" name="confirme">
        <?php if (isset($erreur)) { ?> <h2 class="erreur"><?php echo $erreur ?></h1> <?php } ?>
    </form>
</section>
</section>

<div class='bloocke'>
    <p class='p'>Si vous souhaitez recharger votre compte et effectuer des achats sur <span>Kephale</span>, n'hésitez pas à contacter le service de livraison au <span>"+223 97 01 97 80"</span> via WhatsApp.</p>
    <p class='verte p'>Vous avez également la possibilité de retirer de l'argent depuis votre compte <span>Kephale</span>.</p>
</div>
<div class='bloockee'>
    <p class='rouge p'><span>À noter</span></p>
    <p class='rouge p'>Si vous êtes victime d'une arnaque avec un numéro de téléphone différent de celui mentionné sur le site, nous ne serons pas en mesure de vous rembourser votre argent.</p>

</div>
<?php ?> 
