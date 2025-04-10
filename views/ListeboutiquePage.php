<div class='nav_bare'>
    <section class="bloc_nave">

    <a class ='lin_connect'href= "/Kephale/accueil" >
        <img src="public/asset/_icone/retoure.svg" alt="">
        </a>

    </section>
</div>
<div style="padding-top: 60px;" ></div>
<!-- img type -->
<img class="imgPddk" src="public/asset/_img_page/<?= $_GET["rc"]?>.png" alt="">

<!-- block recherhe -->
<section class="bloc_recherche">
    <form class="recherche_b" method="post">
        <input class="recherche_sz" type="text" name="recherche" placeholder="Recherche...">
        <input class="recher_dd" type="submit" value="Envoyer">
    </form>
</section>
 <!-- -->
<div class='blocListP'>
    <!--Bloc article-->

    <?php 
    if($listBoutiqueType !== 'null'){
        foreach($listBoutiqueType as $listBoutiqueTypes){
            $id_categorie = $listBoutiqueTypes["categorie_id"];
            $listeProduit = listeProduit($bd, $id_categorie);
           ?>
               <section class='blocArticlP'>
        <!--Bloc info boutique-->
        <section class='infoBoutique'>
            <section class='blookk'>
                <img class='dkdkdk' src="public/asset/img_boutique/<?= $listBoutiqueTypes["boutique_img"]?>" alt="">
                <section class='infotextebta'>
                    <h1><?= $listBoutiqueTypes["boutique_nom"]?></h1>
                    <p><?= $listBoutiqueTypes["boutique_pays"]?></p>
                </section>
            </section>
            <a href="">
                <img class='iconBoutique' src="public/asset/_icone/Icon_boutique.png" alt="">
            </a>
        </section>
        <!--Bloc info boutique fin-->

        <!--Bloc img  catégorie-->
        <img class='imgCategori' src="public/asset/img_categori/<?= $listBoutiqueTypes["categorie_img"]?>" alt="">
        <!--Bloc img  catégorie fin-->

        <!--Bloc info  catégorie-->
        <section class='blocinfoCategorie'>
            <h1><?= $listBoutiqueTypes["categorie_nom"]?></h1>
            <p>Categori <?= $listBoutiqueTypes["categorie_types"]?></p>
        </section>
        <!--Bloc info  catégorie-->
        <!--Bloc info  produit-->
        <section class="BlockProduit">
           
            <?php
            if($listeProduit !== 'null'){
                ?>
             <a href="/Kephale/listeproduit&rc=<?= $_GET["rc"]?>&id_categorie=<?= $listBoutiqueTypes["categorie_id"]?>">
                <img class="imgContour" src="public/asset/img_categori/<?= $listBoutiqueTypes["categorie_img"]?>" alt="">
                <p class="pColor" >voir +</p>
            </a>
                 <?php
                foreach($listeProduit as $listeProduits){
                    ?>
                    <a href="">
                    <img src="public/asset/img_produit/<?= $listeProduits["img"]?>" alt="">
                    <p><?= $listeProduits["nom"]?></p>
                </a>
                     <?php
                }
            }
            ?>
        </section>

    </section>
           <?php 
        }
    }else{
        echo 'Pas de resulta';
    }
    ?>
    <!--Fin Bloc article-->

</div>
   <!-- -->