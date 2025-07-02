<div class='nav_bare'>
    <section class="bloc_nave">
    <a class ='lin_connect'href= "/Kephale/user" >
        <img class='retoure' src="public/asset/_icone/retoure.svg" alt="">
        </a>
    <h5>Paramètre</h5>
    </section>

</div>
<div style="padding-top: 80px;" ></div>
<?php 
if($userBoutiqueEtat !== 'boutique'){
    $texe_btn = 'Créer une boutique';
}else{
    $texe_btn = 'Boutique';
}
?>

<div class='block_info_boutique'>
    <a class='ddjdjfhkf' href="/Kephale/?url=usermodif">
<img src="public/asset/img_user/<?= $infoUsers ["img"]; ?>" alt="">
<section class='block_info_prame'>
<h1><?= $infoUsers ["nom"]; ?></h1>
<h3 style="font-size: 13px;" >Solde: <span style="font-weight: 600;" ><?= $solde_user ; ?></span></h3>
<?php if($localInfos !== false){ ?> <h3 style="font-size: 9px;" ><?= $localInfos ; ?></h3>  <?php } ?> 
<!-- <h2>+223 <?= $infoUsers ["telephone"]; ?></h2> -->

</section>
    </a>
</div>
<div style="padding-top: 40px;" ></div>
<div class='block_info_boutique flex'>

    <a class='ddjfkff' href="/Kephale/?url=usermodif">Modifier Profile</a>
    <a class='ddjfkff' href="/Kephale/<?= $userBoutiqueEtat; ?>"><?=  $texe_btn; ?></a>
    <a class='ddjfkff' href="">Rechargez mon compte Kephalé</a>
    <?php
    if($localInfo === false){
        ?>
    <button class='ddjfkff' onclick="getLocation()" type="">Obtenir ma position</button>
        <?php
    }else{
        ?>
         <button class='ddjfkff' onclick="getLocationPlus()" type="">Actualiser ma position</button>
          <?php
    }
    ?>
    <a class='ddjfkff' href="">Retraits d'argent</a>
    <a class='ddjfkff deconet' href="/Kephale/deconnection"> Déconnexion </a>
</div>


<script>
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
    navigator.geolocation.getCurrentPosition(showPosition, error, {
      enableHighAccuracy: true,
      timeout: 10000
    });
  } else {
    document.getElementById("position").innerHTML = "La géolocalisation n'est pas supportée par ce navigateur.";
  }
}


function getLocationPlus() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(newPosition, showError);
    navigator.geolocation.getCurrentPosition(newPosition, error, {
      enableHighAccuracy: true,
      timeout: 10000
    });
  } else {
    document.getElementById("position").innerHTML = "La géolocalisation n'est pas supportée par ce navigateur.";
  }
}

function newPosition(position) {
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
  fetch("localisation/new_location.php", {
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


function showPosition(position) {
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
  fetch("localisation/save_location.php", {
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