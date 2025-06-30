<?php

function navebare($resource, $achatInfo, $panierInfo ){
    $home = 'public/asset/home_svg/kephale.svg';
    if($resource ==='accueil'){$home = 'public/home.svg';}

    $restaurant = '';
    $user = '';
    //$page_user = [ 'user', 'userparametre'];
    //if (in_array($resource, $page_user)){$user = '_';}

    $panie = '';
    $parametre = '';
    if($resource ==='user'){$user = '_';}
     if($resource ==='chine'){$panie = '_';}
     if($resource ==='userparametre'){$parametre = '_';}
   ?> 
   <section class="section_menu_icon">

    <a class="lien_icon" href="/Kephale/accueil">
        <img class="icon_menu" src="<?= $home ?>" alt="">
        <p style='<?php if($resource ==='accueil'){ echo 'color: #F29100';} ?>' >Kephale</p>
    </a>
    <a class="lien_icon" href="/Kephale/chine">
        <img class="icon_menu" src="public/asset/home_svg/chine<?= $panie ?>.svg" alt="">
                <?php
        ?>
        <p style='<?php if($resource ==='chine'){ echo 'color: #D11400';} ?>' >Chine</p>
    </a>

    <a class="lien_icon" href="/Kephale/user">
        <img class="icon_menu" src="public/asset/home_svg/user<?= $user ?>.svg" alt="">
        <p>Profil</p>
    </a>
    <a class="lien_icon" href="/Kephale/restaurant">
        <img class="icon_menu" src="public/asset/home_svg/restaurant.svg" alt="">
        <p>Restaurant</p>
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

$page = [ 'accueil', 'user', 'userparametre', 'listepanier', 'chine'];

if (in_array($resource, $page)){
navebare($resource, $achatInfo, $panierInfo);

}

?>