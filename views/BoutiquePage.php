  <!-- -->
  <!--nave bare-->
  <div class='nav_bare'>
      <section class="bloc_nave">
          <a class='bloc_logo' href="/Kephale/accueil">
              <img class="icon_user" src="public/asset/_icone/accuil.svg" alt="">
          </a>
          <h5><?= $infoBoutique["nom"] ?></h5>
          <a class ='lin_connect'href= "/Kephale/user" >
        <img class="<?= $lala ;?>" src="<?= $icon ;?>" alt="">
        </a>
      </section>

  </div>
  <!-- -->
  <div style="padding-top: 60px;"></div>

  <section class='logoboutique'>
      <img src="public/asset/img_boutique/<?= $infoBoutique["img"] ?>" alt="">
  </section>


  <!-- bloc affiche sole et icone -->
  <section class="info_user_sold">
      <section class="info_solde">

          <h2>Solde</h2>
          <h1> <?= $boutiqueSolde ?></h1>
      </section>


      <section class="clock_re_re">
          <section class='infoAbonnement'>
              <h4><?= $tecko  ?></h4>
              <p><?= $tecka  ?></p>
          </section>
          <a href=""><img src="public/asset/_icone/retrais.svg" alt=""></a>

      </section>
  </section>




  <section class='blocKategirie'>
      <a class='linkAjout' href="/Kephale/ajoutecategorie">
          <h1>Ajouter catégorie</h1>
      </a>
      <!-- bloc liste des categorie -->

      <?php 
if($infoCategorie === 'null'){
    echo 'Pas de catégore';

}else{
    if(is_array($infoCategorie) AND !empty($infoCategorie) ){
        foreach ($infoCategorie as $infoCategories){
            ?>
      <section class='blocCategori'>
          <section class='blocko'>
              <img class='img_cate' src="public/asset/img_categori/<?= $infoCategories['img']; ?>" alt="">
              <section class='blocTexte'>
                  <h3><?= $infoCategories['nom']; ?></h3>
                  <h4><span><?= $infoCategories['types']; ?></span></h4>
              </section>
          </section>
          <section class='blocko plusStyle'>
              <a class='linkBtn' href="/Kephale/produit&id_categorie=<?= $infoCategories['id']; ?>">
                  <h1>Produits</h1>
              </a>

              <a href="">
                  <img src="public/asset/_icone/suprime.svg" alt="">
              </a>
          </section>
      </section>
      <?php 
        }
    }
  
}


?>


      <!-- bloc liste des categorie -->


  </section>








  <!--bloce icone de base -->
  <section class="section_menu_icon">
      <a class="lien_icon" href="">
          <img class="icon_menu" src="public/asset/_icone/parametre.svg" alt="">
      </a>

      <a class="lien_icon" href="">
          <img class="icon_menu" src="public/asset/_icone/boutique.svg" alt="">
      </a>

      <a class="lien_icon" href="">
          <img class="icon_menu" src="public/asset/_icone/notification.svg" alt="">
          <section class="alerte_conteur">
              <p class="conteur">0</p>
          </section>
      </a>


      <a class="lien_icon" href="">
          <img class="icon_menu" src="public/asset/_icone/panye.svg" alt="">
      </a>
  </section>