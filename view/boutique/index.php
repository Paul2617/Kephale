<?php new html(); ?>

<body>
    <style>
    body {
        color: #333;
    }

    header {
        background: white;
        padding: 3rem 1rem 2rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        top: 0;
        z-index: 10;
    }

    .profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid #eee;
        object-fit: cover;
    }

    .balance {
        background: white;
        margin: 1.5rem 1rem;
        padding: 1.5rem;
        border-radius: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }
.balances{
        margin: 1.5rem 1rem;
        border-radius: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        justify-content: space-around;
}
.balances a {
    width: 40%;
    display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        background: #2d6cdf;
        color: white;
        padding: 10px 10px;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: background 0.2s ease;
}
    .balance .amount h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #2d6cdf;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .actions a {
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        background: #2d6cdf;
        color: white;
        padding: 10px 10px;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: background 0.2s ease;
    }

    .actions a:hover {
        background: #174ab0;
    }

    .grid {
        display: flex;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin: 1.5rem 1rem;
    }

    .card {
        width: 100%;
        height: 100px;
        background: white;
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
        display: grid;
        align-items: center;
    }

    .card:hover {
        transform: translateY(-3px);
    }

    .card h3 {
        margin-bottom: 20px;
        font-size: 0.6rem;
        color: #a8a7a7ff;
    }

    .card p {
        margin: 0;
        color: #555;
    }

    footer {
        text-align: center;
        color: #aaa;
        padding: 1rem 0;
        font-size: 0.8rem;
    }
    </style>
    <header>
        <div class="profile">
            <img src="/assets/img_boutique_profile/<?= $img_profile?>" alt="Profil">
            <div>
                <h4 style="margin-bottom: -8px; font-size: 1rem;"><?= $nom_boutique   ?></h4>
                <small style=" margin-top: 7px; font-size: 0.7rem; display: flex;"><p style="margin-right: 5px;">Offre  <span>  <?= $type_abonnement ?></span> </p>  <p  > <span style=" <?php  if($jour_restant >= 5){ echo "color: #68c802ff;";}else{echo "color: #c82302ff;";} ?>"><?= $jour_restant?> jr</span>   restants</p> </small>
            </div>
        </div>
        <div class="actions">
            <a style="background-color: #ffffff;" href="#"><img class="icon_edite" src="/assets/icons/parametres.svg"
                    alt=""></a>
        </div>
    </header>

    <section class="balance">
        <div class="amount">
            <h2 style="font-size: 0.9rem;">Solde : <?= $balance_.' '. $devise?></h2>
            <p style="font-size: 0.5rem;">Dernière mise à jour : Aujourd’hui</p>
        </div>
        <div class="actions">
            <a style="background-color: #ffffff;" href="#"> <img class="icon_edite" src="/assets/icons/transfer.svg"
                    alt=""></a>
            <a style="background-color: #ffffff;" href="#"> <img class="icon_edite" src="/assets/icons/home.svg"
                    alt=""></a>
        </div>
    </section>

    <section class="balances">
            <a href="/boutique/produit">Mes Produits</a>
            <a href="/web/<?= $id_boutique_web ?>">Web Boutique</a>
    </section>
    <section class="grid">

        <div class="card">
            <h3>Articles</h3>
            <p> <span style="font-size: 1rem;" > <?= $statistique['produits'] ?> </span> Produits actifs</p>
        </div>

        <div class="card">
            <h3>Ventes Réalisées</h3>
              <p> <span style="font-size: 1rem;" > 123</span> Commandes</p>
        </div>
    </section>
    <section class="grid">
        <div class="card">
            <h3>Revenus du Mois</h3>
            <p> <span style="font-size: 1rem;" > 215 000 Fcfa </span><br></p>
        </div>

        <div class="card">
            <h3>Visites</h3>
             <p> <span style="font-size: 1rem;" > 1 842 </span>Visiteurs</p>
        </div>
    </section>

    <footer>
        © 2025 Kephale Mali - Plateforme de vente en ligne.
    </footer>
    <div style=" margin-bottom: 30rem;"></div>
    <?php new html_nav_bar('plus'); ?>
    <script>
        
    const lc = <?= json_encode($lc ) ?>;
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                newPositionBoutique, // Fonction en cas de succès
                showError, // Fonction en cas d'erreur
                {
                    enableHighAccuracy: true, // Meilleure précision (GPS)
                    timeout: 10000, // 10 secondes avant expiration
                    maximumAge: 0 // Ne pas utiliser de cache
                }
            );
        } else {
            alert("La géolocalisation n'est pas supportée par ce navigateur.");
        }
    }
    
    function newPositionBoutique(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        console.log("Latitude:", lat, "Longitude:", lon);

        fetch(`/src/Localisation/nominatim_proxy.php?lat=${lat}&lon=${lon}&types=boutique`)
            .then(response => {
                if (!response.ok) throw new Error("Erreur HTTP " + response.status);
                return response.json();
            })
            .then(data => {
                document.getElementById("position").textContent = "Localisation actualisée";
                setTimeout(() => {
                    location.reload();
                }, 2000);

                console.log("Adresse trouvée :", data);
                //document.getElementById("position").textContent = data.display_name || "Adresse non trouvée";
            })
            .catch(err => {
                   location.reload();
                console.error("Erreur fetch :", err);
                //document.getElementById("position").textContent = "Erreur lors du géocodage.";
            });
    }

    function showError(error) {
        switch (error.code) {
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

    if(lc === false){
        getLocation() ;
    }
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() { // Valeur de scroll initiale
        const scrollLimit = 47;
        // ajuste selon ton besoin

        // Scroll automatique au chargement
        window.scrollTo(0, scrollLimit);

        // Empêcher de descendre au-delà de ce niveau
        window.addEventListener("scroll", function() {
            if (window.scrollY < scrollLimit) {
                window.scrollTo(0, scrollLimit);
            }
        });
    });
    </script>
</body>