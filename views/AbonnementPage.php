
<?php ?>

<div class='nav_bare'>
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class="icon_user" src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Liste abonnement</h5>
</div>
<div style="padding-top: 80px;" ></div>

<div class='listabtn'>
<?php
foreach($recupListAbonnement as $recupListAbonnements){
    require_once ('../models/solde_affiche/solde.php');
    $montant = solde ($recupListAbonnements["montant"]) ;
    ?>
    <section class='blocAbonnent'>
<h2><?= $recupListAbonnements["nom"] ?></h2>
<p><?= $recupListAbonnements["description"] ?></p>
<h3><?= $montant?> / Mois</h3>
<a href="/Kephale/paiementabt&id_abt=<?= $recupListAbonnements["id"] ?>">Acheter</a>
</section>
    <?php
}
?>

</div>