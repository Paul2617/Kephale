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
<?php if($local_boutique !== false){ ?> <h3 style="font-size: 9px;" ><?= $local_boutique ; ?></h3>  <?php } ?> 
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
<?php 
if($local_boutique === false){
?>
<button class='ddjfkff' onclick="getLocation()" type="">Obtenir ma position</button>
<?php 
}else{
    ?>
<button class='ddjfkff' onclick="getLocationPlus()" type="">Actualiser ma position</button>
<?php 
}
?>
    <a class='ddjfkff' href=""> Vente annulée</a>
    <a class='ddjfkff' href=""> Transfer </a>
</div>

<?php  


            ?>
            <script>

                function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionBoutique, showError);
    navigator.geolocation.getCurrentPosition(showPositionBoutique, error, {
      enableHighAccuracy: true,
      timeout: 10000
    });
  } else {
    document.getElementById("position").innerHTML = "La géolocalisation n'est pas supportée par ce navigateur.";
  }
}


function getLocationPlus() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(newPositionBoutique, showError);
    navigator.geolocation.getCurrentPosition(newPositionBoutique, error, {
      enableHighAccuracy: true,
      timeout: 10000
    });
  } else {
    document.getElementById("position").innerHTML = "La géolocalisation n'est pas supportée par ce navigateur.";
  }
}

function newPositionBoutique(position) {
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
  fetch("localisation/new_location_boutique.php", {
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



            </script>