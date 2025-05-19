<!-- -->
<!--nave bare-->
<div class='nav_bare'>
    <section class="bloc_nave">
    <a class='bloc_logo' href="/Kephale/accueil">
        <img class="icon_user" src="public/asset/_icone/accuil.svg" alt="">
    </a>
    <h5><?= $infoUser["nom"]?></h5>
    <a class='lin_connect' href="/Kephale/?url=userparametre">
        <img class="icon_user" src="public/asset/img_user/<?= $infoUser["img"] ?>" alt="">
    </a>
    </section>

</div>
<!-- -->
<div style="padding-top: 70px;"></div>
<!-- -->
<!-- bloc affiche sole et icone -->
<section class="info_user_sold">
    <section class="info_solde">
        <h2>Solde</h2>
        <h1> <?php echo  $userSolde?></h1>
    </section>
    <section class="clock_re_re">
        <a href=""><img src="public/asset/_icone/recharge.svg" alt=""></a>
        <a href=""><img src="public/asset/_icone/retrais.svg" alt=""></a>
    </section>
</section>
<!-- -->

<!-- block recherhe -->
<section class="bloc_recherche">
    <form class="recherche_b" method="post">
        <input class="recherche_sz" type="text" name="recherche" placeholder="Recherche...">
        <input class="recher_dd" type="submit" value="Envoyer">
    </form>
</section>

<?php ?>
<!-- -->
<!-- liste boutique -->
<section class='blocKategirie'>
    <section class='blocPayes'>
        <a href="">Mali</a>
        <a href="">Burkina</a>
        <a href="">Niger</a>
    </section>

    <!--Bloc article-->
    <?php
     if(isset($_POST["recherche"])){
        if(isset($info)){
            if($info === 'boutique'){
                require_once "recherche/boutique.php";
            }elseif($info === 'article'){
                require_once "recherche/article.php";
            }elseif($info === 'produit'){
                require_once "recherche/produit.php";
            }elseif($info === 'categorie'){
                require_once "recherche/categorie.php";
            }
        }else{
            ?>
            <p style= "" >Pas de resulta trouve</p>
            <?php
        }
     }else{
        require_once "../controleur/algoriste/algoriste01.php";
     }

// info rechercher
     require_once "../controleur/cookie/historique_recherche.php";
    ?>
    <!--Fin Bloc article-->


</section>

<!-- -->
<!-- -->
<!--bloce icone de base -->

<section class="section_menu_icon">
    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/_icone/parametre.svg" alt="">
    </a>

    <a class="lien_icon" href="/Kephale/<?= $userBoutiqueEtat ?>">
        <img class="icon_menu" src="public/asset/_icone/boutique.svg" alt="">
    </a>

    <a class="lien_icon" href="/Kephale/?url=userachat">
        <img class="icon_menu" src="public/asset/_icone/notification.svg" alt="">
        <?php
        if(isset($achat_efect)){
            ?>
        <section class="alerte_conteur">
            <p class="conteur"><?= $achat_efect  ?></p>
        </section>
            <?php
        }
        ?>
    </a>
    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/_icone/panye.svg" alt="">
    </a>
</section>