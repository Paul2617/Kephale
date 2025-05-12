<?php  
// alerte confirme l'achat
    if(empty($_POST["ferme"])){
    if(isset($_POST["psa"])){
        $titre = "Pourcentage sur achat (psa) ";
        $contenue = $contenu;
        $nameBoutton = 'modifie_psa';
        $valueBoutton = 'Modifier psa';
        $nameInfoId = 'idArticleConfirme';
        $valueInfoId = $_SESSION['id_boutique'] ;
        require_once ('../components/alerte.php');
        Alerte ( $titre, $contenue, $nameBoutton, $valueBoutton, $nameInfoId, $valueInfoId );
    }
}
?>
<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/boutique" >
        <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Paramètre</h5>
    </section>

</div>
<div style="padding-top: 80px;" ></div>


<div class='block_info_boutique'>
    <a class='ddjdjfhkf' href="/Kephale/?url=boutiquemodif">
<img src="public/asset/img_boutique/<?= $info_boutique["img_boutique"]  ?>" alt="">
<section class='block_info_prame'>
<h1><?= $info_boutique["nom_boutique"]  ?></h1>
<h2>Boutique au <?= $info_boutique["pays_boutique"]  ?></h2>
</section>

    </a>
</div>
<div style="padding-top: 40px;" ></div>
<div class='block_info_boutique flex'>
<?php  
if($info_psa !== false){
    ?>
    <form class='ddjfkff' method="POST" enctype="multipart/form-data"> 
        <input class='ddjfkff' type="submit" value="PSA sur <?= $psas ?>" name="psa"> 
    </form>
    <?php
}
 ?>

<a class='ddjfkff' href="">Tableau de bore</a>
<a class='ddjfkff' href="">Abonnement</a>

    <a class='ddjfkff' href=""> Vente annulée</a>
    <a class='ddjfkff' href=""> Transfer </a>
</div>

<?php  


            ?>