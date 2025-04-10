<?php

  ?>
<!-- -->
<!--nave bare-->
<div class='nav_bare'>
    <section class="bloc_nave">
    <a class='bloc_logo' href="/Kephale/accueil">
        <img class="icon_user" src="public/asset/_icone/accuil.svg" alt="">
    </a>
    <h5><?= $infoUser["nom"]?></h5>
    <a class='lin_connect' href="/Kephale/deconnection">
        <img class="icon_user" src="public/asset/_icone/user.svg" alt="">
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
    <section class='blocArticlP'>
        <!--Bloc info boutique-->
        <section class='infoBoutique'>
            <section class='blookk'>
                <img class='dkdkdk' src="public/asset/img_boutique/logo_250220_164409.png" alt="">
                <section class='infotextebta'>
                    <h1>Kephalé</h1>
                    <p>Mali</p>
                </section>
            </section>
            <a href="">
                <img class='iconBoutique' src="public/asset/_icone/Icon_boutique.png" alt="">
            </a>
        </section>
        <!--Bloc info boutique fin-->

        <!--Bloc img  catégorie-->
        <img class='imgCategori' src="public/asset/img_categori/31080_250220_002412.jpg" alt="">
        <!--Bloc img  catégorie fin-->

        <!--Bloc info  catégorie-->
        <section class='blocinfoCategorie'>
            <h1>boos homme</h1>
            <p>Categori Homme</p>
        </section>
        <!--Bloc info  catégorie-->
        <!--Bloc info  produit-->
        <section class="BlockProduit">
            <a href="">
                <img class="imgContour" src="public/asset/img_produit/Homme.png" alt="">
                <p class="pColor" >voir +</p>
            </a>
            <a href="">
                <img src="public/asset/img_produit/Homme.png" alt="">
                <p>Montre</p>
            </a>
            <a href="">
                <img src="public/asset/img_produit/Homme.png" alt="">
                <p>Montre</p>
            </a>
            <a href="">
                <img src="public/asset/img_produit/Homme.png" alt="">
                <p>Montre</p>
            </a>
        </section>

    </section>
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

    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/_icone/notification.svg" alt="">
        <section class="alerte_conteur">
            <p class="conteur">0</p>
        </section>
    </a>


    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/_icone/panye.svg" alt="">
    </a>
</section>