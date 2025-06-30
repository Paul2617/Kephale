<!-- -->
<!--nave bare-->

<?php 
function getGreeting() {
    date_default_timezone_set('Africa/Bamako');
    // Obtenir l'heure actuelle (format 24h)
    $currentHour = date('H');
    // Déterminer la salutation en fonction de l'heure
    if ($currentHour >= 0 && $currentHour < 12) {
        return "Bonjour";
    } elseif ($currentHour >= 12 && $currentHour < 18) {
        return "Bon après-midi";
    } elseif ($currentHour >= 18 && $currentHour < 23) {
        return "Bonsoir";
    }
}
$greeting = getGreeting();
?>
<div class='nav_bare'>
    <section class="bloc_nave">

    <h5><span style = 'font-weight: 200;    margin-left: 20px;' ><?= $greeting ?> ! </span><?= $infoUsers["nom"]?></h5>
    <div style = "display: flex; width: 90px;">
        <a class="lien_icon" href="/Kephale/listepanier">
        <img class="icon_menu" src="public/asset/home_svg/panie.svg" alt="">
                <?php
        if($panierInfo > 0){
            ?>
        <section class="alerte_conteur" style='margin-top: -12px;'>
            <p class="conteur"><?= $panierInfo  ?></p>
        </section>
            <?php
        }
        ?>
    </a>

 <a class="lien_icon" href="/Kephale/?url=userachat">
        <img class="icon_menu" src="public/asset/home_svg/home_2.svg" alt="">
              <?php

        if($achatInfo > 0){

            ?>
        <section class="alerte_conteur" style='margin-top: -12px;'>
            <p class="conteur"><?php echo $achatInfo  ?></p>
        </section>
            <?php
        }
        ?>
    </a>
    </div>


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


<?php ?>
<!-- -->



    <!--Fin Bloc article-->


</section>

<!-- -->
<!-- -->
<!--bloce icone de base -->



 <!-- <div class='blockeT'>
    <div class='blockeB'>
        <a href="" class='sectionA'>
            <h1>Block 1</h1>
        </a>
        <a href="" class='sectionA'>
             <h1>Block 2</h1>
        </a>
    </div>
</div>
 -->

