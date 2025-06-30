
<?php ?>

<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/userparametre" >
        <img class='retoure' class="retoure" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Liste abonnement</h5>
    </section>
</div>

<div style="padding-top: 80px;" ></div>

<div style='margin-bottom: 100px ;' class='listabtn'>
<?php
foreach($recupListAbonnement as $recupListAbonnements){

    ?>
    <section  style='  margin-bottom: 10px;' class="blockFac">
        <section class='blockInfoArticle'>
            <section class='infoAchata'>

<h5><?= $recupListAbonnements["nom"] ?></h5>
<h1 style='font-size: 12px; font-weight: 400;' ><?= $recupListAbonnements["description"] ?></h1>
<h4 style='font-size: 12px;' ><?= $recupListAbonnements["categorie"]?></h4>
<?php
if($recupListAbonnements["statut"]  === 'actif'){
    ?>
<form class='blocBotoneListe'  method="POST" enctype="multipart/form-data">
<a style='display: flex; justify-content: center; align-items: center; font-size: 12px;' class="boutton_inpute" class="submit"  href="/Kephale/crtboutique&id_abt=<?= $recupListAbonnements["id"]?>&abn=<?= $recupListAbonnements["abn"]?> ">Crée une Boutique</a>
<a style='display: flex; justify-content: center; align-items: center; font-size: 12px; background-color: #95C11F;' class="boutton_inpute" class="submit"  href="">Certifie la boutique</a>
</form>
    <?php
}
  ?>

</section>
</section>
</section>
    <?php
}
?>

</div>