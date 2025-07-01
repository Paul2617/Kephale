  <!-- -->
  <!--nave bare-->
  <div class='nav_bare'>
      <section style="justify-content: center;" class="bloc_nave">
          <h5><?= $infoBoutique["nom"] ?></h5>
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
              <p><?= $tecka ?></p>
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
     echo verifidaite_boutique($bd);
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

              <a href=" /Kephale/?url=modif_supp&page=categorie&id_categorie=<?= $infoCategories['id']; ?>">
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

       <a class="lien_icon" href="/Kephale/accueil">
          <img class="icon_menu" src="public/asset/home_svg/kephale.svg" alt="">
           <p>Kephale</p>
      </a>
      <a class="lien_icon" href="/Kephale/chine">
          <img class="icon_menu" src="public/asset/home_svg/chine.svg" alt="">
            <p>Chine</p>
      </a>
      <a class="lien_icon" href="/Kephale/user">
          <img class="icon_menu" src="public/asset/home_svg/user.svg" alt="">
          <p>Profil</p>
      </a>
      <a class="lien_icon" href="/Kephale/?url=listevente">
          <img class="icon_menu" src="public/asset/home_svg/notifications.svg" alt="">
          <?php  $infovante = infovante ($bd); 
           if($infovante !== false){
            ?>
          <section class="alerte_conteur">
              <p class="conteur"><?= $infovante ?></p>
          </section>
          <?php 
           }
           ?>
<p>Ventes</p>
      </a>

            <a class="lien_icon" href="/Kephale/?url=boutiqueparametre">
          <img class="icon_menu" src="public/asset/home_svg/parametre.svg" alt="">
          <p>Paramètre</p>
      </a>
  </section>

 <?php 
       if($local_boutique === false){

?>
<script>

    function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionBoutique, showError);
    navigator.geolocation.getCurrentPosition(showPositionBoutique, error, {
      enableHighAccuracy: true,
      timeout: 10000
    });
  } 
}

function showPositionBoutique(position) {
  const lat = position.coords.latitude;
  const lon = position.coords.longitude;

     // Appel au service de reverse geocoding (OpenStreetMap via Nominatim)
  fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`, {
    headers: {
      'Accept-Language': 'fr' // Pour obtenir l’adresse en français si dispo
    }
  }).then(response => response.json())
    .then(data => {
    const addr = data.address;

  // Optionnel : envoyer les coordonnées au serveur PHP
  fetch("localisation/save_location_boutique.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "lat=" + lat + "&lon=" + lon + "&pays=" + addr.country + "&ville=" + addr.city + "&quartier=" + addr.suburb  + "&adresse=" + data.display_name
  });
  })
    .catch(() => {
    document.getElementById("position").textContent = "Erreur lors du géocodage.";
  });

}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      alert("L'utilisateur a refusé la demande de géolocalisation.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Les informations de localisation ne sont pas disponibles.");
      break;
    case error.TIMEOUT:
      alert("La demande de localisation a expiré.");
      break;
    case error.UNKNOWN_ERROR:
      alert("Une erreur inconnue est survenue.");
      break;
  }
}

function error(err) {
  alert("Erreur : " + err.message);
}

document.addEventListener('DOMContentLoaded', () => {
  getLocation(); 
   
});
</script>
 <?php 

                  }
?>