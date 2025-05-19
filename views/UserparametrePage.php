<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Paramètre</h5>
    </section>

</div>
<div style="padding-top: 80px;" ></div>


<div class='block_info_boutique'>
    <a class='ddjdjfhkf' href="/Kephale/?url=usermodif">
<img src="public/asset/img_user/<?= $info_user ["img_user"]; ?>" alt="">
<section class='block_info_prame'>
<h1><?= $info_user ["nom_user"]; ?></h1>
<h2>+223 <?= $info_user ["tel_user"]; ?></h2>
<h3><?= $info_user ["sexe_user"]; ?></h3>
</section>
    </a>
</div>
<div style="padding-top: 40px;" ></div>
<div class='block_info_boutique flex'>
<form class='ddjfkff' method="POST" enctype="multipart/form-data"> 
        <input class='ddjfkff' type="submit" value="Boutique" name="boutique"> 
    </form>
    <a class='ddjfkff' href=""> Vente annulée</a>
    <a class='ddjfkff' href=""> Transfer </a>
    <a class='ddjfkff deconet' href="/Kephale/deconnection"> Déconnexion </a>
</div>