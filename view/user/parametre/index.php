<?php new html(); ?>

<body>
    <style>
    /* CSS */
    .truncate-5 {
        display: inline-block;
        /* nécessaire pour text-overflow */
        max-width: 9ch;
        /* limite à ~5 caractères */
        white-space: nowrap;
        /* empêcher le retour à la ligne */
        overflow: hidden;
        /* masquer l'excédent */
        text-overflow: ellipsis;
        /* ajouter "..." quand ça déborde */
        vertical-align: bottom;
        font-size: 1rem;
    }
    </style>
    <div class="div_blok">
        <div class="div display_flex">
            <div class="display_flex_justifi">
                <section style="display: flex;">
                    <img class="user_img" src="/assets/img_profil/<?= $img_profile ?>" alt="">
                    <section>
                        <h1 class="user_nom"><?= $nom ?></h1>
                        <?php 
                        if($Lc !== false){
                              ?>
                        <p><?= $Lc['ville'].' - '. $Lc['quartier'] ?></p>

                        <?php 
                        }else{
                             ?>
                        <p>Localisation...</p>

                        <?php 
                        }
                        ?>
                        <P>Solde <span><?=  $balance.' '.$devise ?></span></P>
                    </section>
                </section>
            </div>
            <a href="/user/edite">
                <img class="icon_edite" src="/assets/icons/edit.png" alt="">
            </a>
        </div>
        <?php 
        if($UserInfoBoutique ['boutique'] === true){
            // #68c802ff #c82302ff
            ?>
        <div style="width: 75%;" class="div display_flex">
            <div class="display_flex_justifi">
                <section style="display: flex;">
                    <img class="user_img" src="/assets/img_boutique_profile/<?= $UserInfoBoutique ['img_profile'] ?>"
                        alt="">
                    <section>
                        <h1 class="truncate-5" class="user_nom">
                            <?= $UserInfoBoutique ['nom'] ?></h1>
                        <p
                            style="  <?php if($UserInfoBoutique ['statut'] === 'Valider'){ echo'color: #68c802ff;'; }else{echo'color: #c82302ff;';} ?> ">
                            Boutique: <span><?= $UserInfoBoutique ['statut'] ?></span> </p>
                    </section>
                </section>
            </div>
            <a href="/boutique">
                <img class="icon_edite" src="/assets/icons/accueil.svg" alt="">
            </a>
        </div>
        <?php 
        }
        
        ?>
        <section class="display_flex_blok">
            <a class="link_liste" href="/user/liste_achat">Liste d'achat</a>
            <a class="link_liste" href="/offre">Kephalé commerçans</a>
            <a class="link_liste" href="">confidentialité</a>
            <a class="link_liste" href="">Transaction</a>

            <?php 
                        if($Lc !== false){
                            ?>
            <a class="link_liste" onclick="getLocation();" href="#">Actualise la localisation 
                <p style="font-size: 0.7rem; color: #40c204ff;" id="position" ></p> </a>

            <?php 
                        }else{
                             ?>
            <a class="link_liste" onclick="getLocation();" href="#">Localisation</a>

            <?php 
                        }
                             ?>
            <a class="link_liste" href="">Aide</a>
            <div style=" margin-bottom: 2rem;"></div>
            <form method="POST" enctype="multipart/form-data">
                <input class="red" type="submit" value="Déconnexion" name="deconnexion">
            </form>
        </section>

    </div>
    <script>
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

        fetch(`/src/Localisation/nominatim_proxy.php?lat=${lat}&lon=${lon}&types=user`)
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
    </script>
    <div style=" margin-bottom: 5rem;"></div>
    <?php new html_nav_bar('parametre'); ?>
</body>