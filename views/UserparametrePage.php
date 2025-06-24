<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Paramètre</h5>
    </section>

</div>
<div style="padding-top: 80px;" ></div>
<?php 
if($userBoutiqueEtat !== 'boutique'){
    $texe_btn = 'Créer une boutique';
}else{
    $texe_btn = 'Boutique';
}

?>

<div class='block_info_boutique'>
    <a class='ddjdjfhkf' href="/Kephale/?url=usermodif">
<img src="public/asset/img_user/<?= $infoUsers ["img"]; ?>" alt="">
<section class='block_info_prame'>
<h1><?= $infoUsers ["nom"]; ?></h1>
<h2>+223 <?= $infoUsers ["telephone"]; ?></h2>
<h3><?= $infoUsers ["sexe"]; ?></h3>
</section>
    </a>
</div>
<div style="padding-top: 40px;" ></div>
<div class='block_info_boutique flex'>

    <a class='ddjfkff' href="/Kephale/<?= $userBoutiqueEtat; ?>"><?=  $texe_btn; ?></a>
    <a class='ddjfkff' href=""> Vente annulée</a>
    <a class='ddjfkff' href=""> Transfer </a>
    <a class='ddjfkff deconet' href="/Kephale/deconnection"> Déconnexion </a>
</div>