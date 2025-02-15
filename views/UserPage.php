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
<!-- -->

<!-- -->
<!--bloce icone de base -->
<section class="section_menu_icon">
    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/_icone/parametre.svg" alt="">
    </a>

    <a class="lien_icon" href="">
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