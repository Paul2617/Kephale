
<div class='nav_bare'>
  <section class="bloc_nave">
  <a class ='lin_connect'href= "/Kephale/boutique" >
        <img src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Produit</h5>
  </section>
</div>
<div style="padding-top: 70px;" ></div>

<section class='blocKategirie'>
<a class ='linkAjout'href="/Kephale/ajouteproduit&id_categorie=<?= $_GET['id_categorie']; ?>"><h1>Ajouter produit</h1></a>


<?php 
if($listeProduit === null){
}else{
  foreach ($listeProduit as $listeProduits){
    ?>
    <section class = 'blocCategori'>
    <section class='blocko'>
    <img class ='img_cate' src="public/asset/img_produit/<?= $listeProduits['img']; ?>" alt="">
        <section class ='blocTexte'>
        <h3><?= $listeProduits['nom']; ?></h3>
        <h4><span><?= $listeProduits['types']; ?></span></h4>
        </section>
    </section>
    <section class='blocko plusStyle'>
        <a class='linkBtn' href="/Kephale/article&id_categorie=<?= $_GET["id_categorie"]; ?>&id_produit=<?= $listeProduits['id']; ?>"><h1>Produits</h1> </a>
    
        <a href="">
        <img src="public/asset/_icone/suprime.svg" alt="">
        </a>
    </section>
     </section>
    <?php 
  }

}
?>     
</section>