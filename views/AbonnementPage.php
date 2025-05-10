
<?php ?>

<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class='retoure' class="retoure" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Liste abonnement</h5>
    </section>
</div>

<div style="padding-top: 80px;" ></div>

<div class='listabtn'>
<?php
foreach($recupListAbonnement as $recupListAbonnements){
    require_once ('../models/solde_affiche/solde.php');
    $montant = solde ($recupListAbonnements["montant"]) ;
    ?>
    <section  style='  margin-bottom: 10px;' class="blockFac">
        <section class='blockInfoArticle'>
            <section class='infoAchata'>

<h5><?= $recupListAbonnements["nom"] ?></h5>
<h1><?= $recupListAbonnements["description"] ?></h1>
<h4><?= $montant?> / Mois</h4>
<form class='blocBotoneListe'  method="POST" enctype="multipart/form-data">

<a style='display: flex; justify-content: center; align-items: center;' class="boutton_inpute" class="submit"  href="/Kephale/paiementabt&id_abt=<?= $recupListAbonnements["id"] ?>">Achète l'abonnement</a>
</form>
</section>
</section>

</section>
    <?php
}
?>

</div>