<?php
function navebare($resource){
    
    $home = '';
    $restaurant = '';
    $user = '';
    $page_user = [ 'user', 'userparametre'];
    if (in_array($resource, $page_user)){$user = '_';}
    $panie = '';
    $parametre = '';
    if($resource ==='accueil'){$home = '_';}
     if($resource ==='userachat'){$panie = '_';}
   ?> 
   <section class="section_menu_icon">

    <a class="lien_icon" href="/Kephale/accueil">
        <img class="icon_menu" src="public/asset/home_svg/home<?= $home ?>.svg" alt="">
        <p>Accueil</p>
    </a>
    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/home_svg/restaurant.svg" alt="">
        <p>Restaurants</p>
    </a>

    <a class="lien_icon" href="/Kephale/user">
        <img class="icon_menu" src="public/asset/home_svg/user<?= $user ?>.svg" alt="">
        <?php
        if(isset($achat_efect)){
            ?>
        <section class="alerte_conteur">
            <p class="conteur"><?= $achat_efect  ?></p>
        </section>
            <?php
        }
        ?>
        <p>Profil</p>
    </a>
    <a class="lien_icon" href="">
        <img class="icon_menu" src="public/asset/home_svg/message.svg" alt="">
        <section class="alerte_conteur">
            <p class="conteur">5</p>
        </section>
        <p>Discussions</p>
    </a>

    <a class="lien_icon" href="/Kephale/?url=userachat">
        <img class="icon_menu" src="public/asset/home_svg/panie<?= $panie ?>.svg" alt="">

        <p>Achats</p>
    </a>
</section>
   <?php
}
?>


<?php

$page = [ 'accueil', 'user', 'userparametre', 'userachat'];

if (in_array($resource, $page)){
navebare($resource, $page );
}

?>