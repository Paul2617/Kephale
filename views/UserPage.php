<?php

  ?>
  <!-- -->
     <!--nave bare-->
<div class='nav_bare'>
    <a class='bloc_logo' href="/Kephale/accueil">
        <img class="icon_user" src="public/asset/_icone/accuil.svg" alt="">
    </a>
    <h5><?= $infoUser["nom"]?></h5>
    <a class='lin_connect' href="">
        <img class="icon_user" src="public/asset/_icone/user.svg" alt="">
    </a>
</div>
 <!-- -->
<div style="padding-top: 70px;" ></div>
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

<?= $userBoutiqueEtat ?>
<!-- -->
<!-- liste boutique -->
<section class="bloc_boutique">
    <section class='blockInfo'>

  
            <section class="dyud_dijd">
                <section class="heeffefe">
                    <a class="bloc_lien_boutique">
                        <img class="img_user" src="public/asset/img_boutique/image" alt="">
                    </a>

                    <section class="texte_info_boutique">
                        <h1>Kephale</h1>
                        <p>Homme</p>
                        <p style="font-size: 10px; color: #1D70B7; margin-top: 3px;"><img class="local_icon" src="../asset/icone/Icon_localisation.png" alt="">Localisation</p>
                    </section>
                </section>

                <a href=""><img class="icon_btn" src="public/asset/_icone/Icon_boutique.png" alt=""></a>
            </section>

            <section class="img_boutique_type">
                <img src="public/asset/img_produit/" alt="">
            </section>

            <section class="ifbhfhdhdb">
            <a class="lick_sous_prduit" href="">
                            <img src="public/asset//img_groupe_article/<?php echo $result_deux["img_groupe"] ?>">
                            <p>Chausur</p>
                        </a>
                        <a class="lick_sous_prduit" href="">
                              <img style="border: 2px solid #95C11F;" src="../asset/img_produit/" alt="">
                              <p style="font-weight: 600; color: #95C11F;">Voir plus</p>
                               
                                    </a>

            </section>
            </section>
        </section>

<!-- -->
<?= $userBoutiqueEtat ?>
<!-- -->
<!--bloce icone de base -->
<section class="section_menu_icon">
    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/_icone/parametre.svg" alt="">
    </a>

    <a class="lien_icon" href="/kephale/<?= $userBoutiqueEtat ?>">
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