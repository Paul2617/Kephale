<?php

function navebare($resource, $achatInfo, $panierInfo ){
    $home = 'public/asset/home_svg/home.svg';
    if($resource ==='accueil'){$home = 'public/home.svg';}

    $restaurant = '';
    $user = '';
    //$page_user = [ 'user', 'userparametre'];
    //if (in_array($resource, $page_user)){$user = '_';}

    $panie = '';
    $parametre = '';
    if($resource ==='user'){$user = '_';}
     if($resource ==='userachat'){$panie = '_';}
     if($resource ==='userparametre'){$parametre = '_';}
   ?> 
   <section class="section_menu_icon">

    <a class="lien_icon" href="/Kephale/accueil">
        <img class="icon_menu" src="<?= $home ?>" alt="">
        <p>Kephale</p>
    </a>
    <a class="lien_icon" href="/Kephale/listepanier">
        <img class="icon_menu" src="public/asset/home_svg/panie.svg" alt="">
                <?php
        if($panierInfo > 0){
            ?>
        <section class="alerte_conteur">
            <p class="conteur"><?= $panierInfo  ?></p>
        </section>
            <?php
        }
        ?>
        <p>Panie</p>
    </a>

    <a class="lien_icon" href="/Kephale/user">
        <img class="icon_menu" src="public/asset/home_svg/user<?= $user ?>.svg" alt="">
        <p>Profil</p>
    </a>
    <a class="lien_icon" href="/Kephale/?url=userachat">
        <img class="icon_menu" src="public/asset/home_svg/home_2.svg" alt="">
              <?php

        if($achatInfo > 0){

            ?>
        <section class="alerte_conteur">
            <p class="conteur"><?php echo $achatInfo  ?></p>
        </section>
            <?php
        }
        ?>
        <p>Achats</p>
    </a>

    <a class="lien_icon" href="/Kephale/userparametre">
        <img class="icon_menu" src="public/asset/home_svg/parametre<?= $parametre?>.svg" alt="">

        <p>Paramètre</p>
    </a>
</section>
   <?php
}
?>


<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = explode('/', trim($requestUri, '/'));
$resource = isset($requestUri[1]) ? $requestUri[1] : null;

$page = [ 'accueil', 'user', 'userparametre', 'listepanier'];

if (in_array($resource, $page)){
navebare($resource, $achatInfo, $panierInfo);

}

?>