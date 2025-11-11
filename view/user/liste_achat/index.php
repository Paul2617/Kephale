<?php new html(); ?>

<body>
    <style>
    .leaflet-routing-container {
        display: none !important;
    }

    .leaflet-control-attribution {
        display: none !important;
    }

    .leaflet-control {
        display: none !important;
    }
    </style>
    <?php new Retoure('/user/parametre'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- ✅ Icônes Leaflet AwesomeMarkers -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.0.4/leaflet.awesome-markers.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.0.4/leaflet.awesome-markers.js">
    </script>
    <div class="listeAchat">
        <?php
        use Middleware\ConvertionSolde;
        use NewClass\Livraison;
        use NewClass\UserClass;
        use Session\Session;
        if ($UserListeAchat !== false) {
            foreach ($UserListeAchat as $la) {
                $id_achat = $la['id_achat'];
                $statut = $la['statut'];
                $nomBoutique = $la['nomBoutique'];
                $magasin_Ville = $la['ville'];
                $magasin_Quartier = $la['quartier'];
                $type_abonnement = $la['type_abonnement'];
                $id_web = $la['id_web'];

                //$LivraisonDistanceIp = Livraison::LivraisonDistanceIp($user_lat,  $user_lon, $magasin_lat, $magasin_lon, $id_achat, $distance);
        
                //$distance = $LivraisonDistanceIp['kilometre'] ;
        
                // $ula verifi si la user a confirme le lieu de livraison ou pas 
                $ula = UserClass::UserLocalisationKilometre($id_achat);
                if ($ula !== false) {
                    $date_lv = $ula['date_creat'];
                    $distance = $ula['kilometre'];
                    $user_lat = $ula['latitude_user'];
                    $user_lon = $ula['longitude_user'];
                    $magasin_lat = $ula['latitude_boutique'];
                    $magasin_lon = $ula['longitude_boutique'];

                    // calcule du delait de livraison a parti ou le lieu de livraison est confirme 
                    $DelaitLivraison = Livraison::DelaitLivraison($statut, $date_lv);
                } else {
                    $user_lat = $Lc['latitude'];
                    $user_lon = $Lc['longitude'];
                    $magasin_lat = $la['latitude'];
                    $magasin_lon = $la['longitude'];
                    $distance = Livraison::distance($user_lat, $user_lon, $magasin_lat, $magasin_lon);
                }

                // calcule le frais de livraison
                $FraisLivraison = Livraison::FraisLivraison($distance);

                //info du livreur qui doit livre
                $infoLivraison = Livraison::infoLivreur($id_achat);

                //var_dump($distances);
        

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                        Session::logout();
                    }

                    // confirme le lieu de livraison de l'achat
                    if (isset($_POST['confirmeLieuLivraison'])) {
                        $id_achat_slt = htmlspecialchars($_POST['id_achat']);
                        UserClass::UserlieuLivraison($id_achat_slt, $distance, $user_lat, $user_lon, $magasin_lat, $magasin_lon);
                        header('Location: /user/liste_achat');
                    }

                    // confirme la livraison de l'achat
                    if (isset($_POST['confirmeLivraison'])) {
                        $id_achat_clt = htmlspecialchars($_POST['id_achat']);
                        $frais_livraison = htmlspecialchars($_POST['frais_livraison']);
                        $ConfirmeLivraison = UserClass::UserConfirmeLivraison($id_achat_clt, $frais_livraison);
                        header('Location: /user/liste_achat');

                    }

                    // Archive l'achat
                    if (isset($_POST['archive_achats'])) {
                        $id_achat_clt = htmlspecialchars($_POST['id_achat']);
                        $ConfirmeLivraison = UserClass::UserArchiveAchats($id_achat_clt);
                        header('Location: /user/liste_achat');
                    }
                    
                    // annuler l'achat
                     if (isset($_POST['annuler_achat'])) {
                        $id_achat_clt = htmlspecialchars($_POST['id_achat']);
                        $ConfirmeLivraison = UserClass::UserAnnulerAchats($id_achat_clt);
                     }
                    

                }
                ?>
        <section class="card_achat" data-id="<?= $id_achat ?>" data-user_lat="<?= $user_lat ?>"
            data-user_lon="<?= $user_lon ?>" data-magasin_lat="<?= $magasin_lat ?>"
            data-magasin_lon="<?= $magasin_lon ?>" data-magasin_nom="<?= $nomBoutique ?>"
            data-magasin_ville="<?= $magasin_Ville ?>" data-magasin_quartier="<?= $magasin_Quartier ?>"
            data-achat_statut="<?= $statut ?>" data-type_abonnement="<?= $type_abonnement ?>"
            data-id_web="<?= $id_web ?>">
            <section class="blocimg_info">
                <section style="display: flex;">
                    <img class="blocimg_info_img" src="/assets/img_produit/<?= $la['image_p'] ?>  " alt="">
                    <section>
                        <h3><?= $la['nom_produit'] ?></h3>
                        <p>
                            <span>Taille :</span>
                            <?= $la['nom_taille'] ?>
                        </p>
                        <p>
                            <span>Quantité :</span>
                            <?= $la['quantite'] ?>
                        </p>
                        <p>
                            <span>Couleur :</span>
                            <?= $la['nom_colors'] ?>
                        </p>
                        <p>
                            <span>Total :
                            </span>
                            <?= ConvertionSolde::newSolde($la['prix_achat']) . ' ' . $la['devise'] ?>
                        </p>
                    </section>
                </section>
                <a class="linkVoir" href="">
                    Voire</a>
            </section>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto, praesentium a voluptate magnam
                cupiditate voluptatem sed odit quos, neque saepe omnis in ad maiores libero facere assumenda! Nisi,
                dignissimos provident!</p>

            <section class="section_livraison">
                <h4>Parametre de Livraison
                    <span></span>
                </h4>
                <p>Vous êtes à
                    <span>
                        <?= $distance ?>
                        k</span>
                    de la boutique -
                    <?= $magasin_Quartier ?>
                </p>

                <!-- Traitement... Info du livreur qui doit livre  -->
                <?php if ($infoLivraison !== false) {
                            echo "<p>Livraire = " . $infoLivraison['nom_livreur'] . " Tél : " . $infoLivraison['tel_livreur'] . " </p>";
                        } else {
                            echo "<p>Livraire = En traitement... </p>";
                        } ?>
                <!-- Fin -->

                <!-- Frait de livraison html -->
                <p>
                    Frait de Livraison =
                    <?= ConvertionSolde::newSolde($FraisLivraison) ?>
                    fcfa
                </p>
                <!-- Fin -->

                <!-- Block html d'affisage de la carte mamp -->
                <div class="map-container"> </div>
                <!-- Fin -->

                <!-- si $ula = false Block html a affiche si le lieu de livraison n'est pas confirme -->
                <?php if ($ula === false) {
                            ?>
                <div class="commentaire"> Vous pouver Actualisez votre position dans parametre
                    <span>'Actualise ma positions'</span>
                </div>
                <p class="ehekhh">Une fois que vous confirmé le lieu de livraison, il n'est plus possible de lemodifier.
                </p>
                <section class="ddjjjfdmkdmddhi">
                    <button style="font-size: 0.8rem" class='btn-cfrm-lieu submit backVert'
                        data-id="<?= $id_achat ?>">Confirme le lieu de livraison</button>
                </section>
                <form method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                    <input type="hidden" name="id_achat" value="<?= $id_achat ?>">
                    <section style="display: flex; justify-content: space-around; margin-top: 10px;"></section>
                </form>

                <!-- Si le lieu de livraison est confirme -->
                <?php
                        } elseif ($ula !== false) {

                            // si la livraison n'est pas fait
                            if ($statut === 'Traitement') {

                                // Si le delait de livraison n'est pas arrive 
                                if ($DelaitLivraison['statut'] === true) {
                                    ?>
                <div class="commentaire">
                    D'ici
                    <span><?= $DelaitLivraison['date'] ?></span>
                    si vous n'ete toujour pas livre vous pouver annuler l'achat et etre renbource du prix total de
                    <span><?= ConvertionSolde::newSolde($la['prix_achat']) . ' ' . $la['devise'] ?></span>.
                </div>
                <?php
                                } else {
                                    // Si le delait de livraison est arrive ou depasse 
                                    ?>
                <div class="commentaire">Nous somme desole pour le retare de le livraisons pouver annuler l'achat et
                    etre renbource du prix total de
                    <span><?= ConvertionSolde::newSolde($la['prix_achat']) . ' ' . $la['devise'] ?></span>.
                </div>
                <?php
                                }
                                // l'article a ete livre 
                            } elseif ($statut === 'Livre') {
                                ?>
                <div style="color: #048e37ff; margin-top: 5px;" class="commentaire">En cas de problement avec le
                    probleme avec l'article vous pouver contacte le service de livraison.
                </div>
                <?php
                            }


                        } ?>
            </section>

            <!-- block pour confirme le lieu de livraison  -->
            <section class="ddjjjfdmkdmddhi">
                <?php
                        if ($statut === 'Traitement') {
                            ?>
                <button style="width: 80%;" class='btn-livrer submit backVert' data-id="<?= $id_achat ?>"
                    data-frais_livraison="<?= $FraisLivraison ?>">Confirmer la livraison</button>
                <?php
                        } elseif ($statut === 'Livre') {
                            ?>
                <form method="POST"
                    style="margin-top: 10px; display: flex; flex-direction: column; justify-content: center; width: 100%; ">
                    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                    <input type="hidden" name="id_achat" value="<?= $id_achat ?>">
                    <input class="submit backNoir" type="submit" value="Archive l'achat" name="archive_achats">
                    <div style="text-align: center;" class="commentaire">Merci pour votre confiance.
                    </div>

                </form><br>
                <?php
                        }
                        ?>
            </section>
            <!-- fin -->

            <!-- Traitement annuler la livraisons -->

                <?php
                        // si la livraison n'est pas fait
                        if ($statut === 'Traitement') {
                            // si le lieu de livraison est confirme
                            if ($ula !== false) {
                                // affiche le bouton annuler si lieu le delai de livraison est arrive ou depase
                                if ($DelaitLivraison['statut'] === false) {
                                    ?>
                                    <button style="width: 100%; background-color: #181818ff; margin-top: 10px;" class='btn-annuler-achat submit backVert' data-id="<?= $id_achat ?>">Annuler l'achat </button>
                                    <?php
                                }
                            }
                              }
                        ?>
            </form>

            <!-- Popup -->
            <div class="popupOverlay" id="popupOverlay">
                <div class="popupBox" id="popupBox">
                    <h2 style="margin-bottom: 30px; font-size: 1rem; width: 50%;">Confirmer la livraison de cet article
                        ?</h2>
                    <form style="width: 100%;" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        <input type="hidden" name="id_livreur" value="<?= $infoLivraison['id_livraire'] ?>">
                        <input type="hidden" name="id_livraison" value="<?= $infoLivraison['id_livraison'] ?>">
                        <input type="hidden" name="frais_livraison" id="Frais_livraison">
                        <input type="hidden" name="id_achat" id="articleIdInputConfirmer">
                        <section class="popupBoxButton">
                            <button type="submit" class="popupBtn confirmBtn"
                                name="confirmeLivraison">Confirmer</button>
                            <button type="button" class="popupBtn cancelBtn" id="cancelBtn">Annuler</button>
                        </section>
                    </form>
                </div>
            </div>

            <div class="popupOverlay" id="popupLieu">
                <div class="popupBox" id="popupBox">
                    <h2 style="margin-bottom: 30px; font-size: 1rem; width: 50%;">Confirmer le lieu de livraison ?</h2>
                    <form style="width: 100%;" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        <input type="hidden" name="id_achat" id="articleIdInputConfirmerLieu">
                        <section class="popupBoxButton">
                            <button type="submit" class="popupBtn confirmBtn"
                                name="confirmeLieuLivraison">Confirmer</button>
                            <button type="button" class="popupBtn cancelBtn" id="cancelBtnLieu">Annuler</button>
                        </section>
                    </form>
                </div>
            </div>

             <div class="popupOverlay" id="popupAnnulerAchat">
                <div class="popupBox" id="popupBox">
                    <h2 style="margin-bottom: 30px; font-size: 1rem; width: 80%;">Vouler vous annuler l'achat ? <br>Vous pouver egalement contacte le servise de livraison pour plus de detaile sur l'article.</h2>
                    <form style="width: 100%;" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        <input type="hidden" name="id_achat" id="articleIdInputAnnuler">
                        <section class="popupBoxButton">
                            <button type="submit" class="popupBtn confirmBtn"
                                name="annuler_achat">Confirmer</button>
                            <button type="button" class="popupBtn cancelBtn" id="cancelAnnule">Annuler</button>
                        </section>
                    </form>
                </div>
            </div>


        </section>
        <?php
            }
        }
        ?>
        <script>
        const popup = document.getElementById('popupOverlay');
        const popupLieu = document.getElementById('popupLieu');
        const popupAnnulerAchat = document.getElementById('popupAnnulerAchat');
        const popupBox = document.getElementById('popupBox');
        const cancelBtn = document.getElementById('cancelBtn');
        const cancelBtnLieu = document.getElementById('cancelBtnLieu'); 
        const cancelAnnule = document.getElementById('cancelAnnule');
        const articleIdInput = document.getElementById('articleIdInputConfirmer');
        const Frais_livraisons = document.getElementById('Frais_livraison');
        const articleIdInputConfirmerLieu = document.getElementById('articleIdInputConfirmerLieu');
        const articleIdInputAnnuler = document.getElementById('articleIdInputAnnuler');
        const livrerBtns = document.querySelectorAll('.btn-livrer');
        const confirmeLieu = document.querySelectorAll('.btn-cfrm-lieu');
        const annulerAchat = document.querySelectorAll('.btn-annuler-achat');

        // Lorsqu'on clique sur un bouton "Confirme le lieu de livraison"
        confirmeLieu.forEach(cfrl => {

            cfrl.addEventListener('click', () => {
                const id = cfrl.dataset.id;
                popupLieu.style.display = 'block';
                articleIdInputConfirmerLieu.value = id;
                console.log();
            })

        })

        // Lorsqu'on clique sur un bouton "Confirmer la livraison"
        livrerBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const frais_livraison = btn.dataset.frais_livraison;


                articleIdInput.value = id; // stocker l’ID dans le formulaire
                Frais_livraisons.value =
                frais_livraison; // stocker le frais de livraison  dans le formulaire
                popup.style.display = 'block';
                popupBox.classList.remove('closing');
                console.log();
            });
        });

        // losqu'on clic sur le button annuler l'achat

         annulerAchat.forEach(baa => {

            baa.addEventListener('click', () => {
                const id = baa.dataset.id;
                popupAnnulerAchat.style.display = 'block';
                articleIdInputAnnuler.value = id;
                console.log();
            })

        })

        // Fermer le popup
        cancelBtn.addEventListener('click', () => {
            popupBox.classList.add('closing');
            setTimeout(() => popup.style.display = 'none', 100);

        });

        // Fermer le popup de lieu de livraison
        cancelBtnLieu.addEventListener('click', () => {
            popupBox.classList.add('closing');
            setTimeout(() => popupLieu.style.display = 'none', 100);

        });

         // Fermer le popup de annuler l'achat
        cancelAnnule.addEventListener('click', () => {
            popupBox.classList.add('closing');
            setTimeout(() => popupAnnulerAchat.style.display = 'none', 100);

        });
        </script>
        <!-- Script Leaflet -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

        <!-- Script Leaflet Routing Machine (pour afficher la route) -->
        <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const articles = document.querySelectorAll('.card_achat');
            const user_nom = <?= json_encode($UserInfo['nom']) ?>;
            const user_quartier = <?= json_encode($Lc['quartier']) ?>;
            articles.forEach(article => {

                const id = article.dataset.id;
                const user_lat = article.dataset.user_lat;
                const user_lon = article.dataset.user_lon;
                const magasin_lat = article.dataset.magasin_lat;
                const magasin_lon = article.dataset.magasin_lon;
                const magasin_nom = article.dataset.magasin_nom;
                const magasin_ville = article.dataset.magasin_ville;
                const magasin_quartier = article.dataset.magasin_quartier;
                const achat_statut = article.dataset.achat_statut;
                const type_abonnement = article.dataset.type_abonnement;
                const id_web = article.dataset.id_web;
                console.log();

                const magasin_info = {
                    nom: magasin_nom,
                    link: 'nule',
                    quartier: magasin_ville
                };

                const magasin = {
                    lat: magasin_lat,
                    lon: magasin_lon
                };

                const client = {
                    lat: user_lat,
                    lon: user_lon
                };


                if (achat_statut === 'Traitement') {

                    const carte_map = document.createElement('div');
                    carte_map.id = 'map-' + id;
                    carte_map.classList.add('map');
                    article.querySelector('.map-container').appendChild(carte_map);

                    // --- Initialisation de la carte
                    const map = L.map(carte_map.id).setView([magasin.lat, magasin.lon], 13);
                    // --- Fond de carte
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    // --- Marqueurs

                    if (type_abonnement === 'Premium') {
                        const markerMagasin = L.marker([magasin.lat, magasin.lon])
                            .addTo(map)
                            .bindPopup(
                                ` <b> ${magasin_info.nom}</b> <br> ${magasin_info.quartier} <br><a href="/web/${id_web}" target='_blank'>Visite la boutique</a>   `
                            )
                            .openPopup();
                    } else {
                        const markerMagasin = L.marker([magasin.lat, magasin.lon])
                            .addTo(map)
                            .bindPopup(
                                ` <b> ${magasin_info.nom}</b> <br> ${magasin_info.quartier}`
                            )
                            .openPopup();
                    }

                    const markerClient = L.marker([client.lat, client.lon])
                        .addTo(map)
                        .bindPopup(`<b>${user_nom}</b> <br> ${user_quartier}`);


                    L.Routing.control({
                        waypoints: [
                            L.latLng(magasin.lat, magasin.lon),
                            L.latLng(client.lat, client.lon)
                        ],
                        lineOptions: {
                            styles: [{
                                color: 'blue',
                                weight: 5
                            }]
                        },
                        routeWhileDragging: false,
                        draggableWaypoints: false,
                        addWaypoints: false,
                        createMarker: function() {
                            return null;
                        },
                        show: false
                    }).addTo(map);
                }


                // --- Ajuster la vue pour montrer les deux points
                //  map.fitBounds(ligne.getBounds());

            })
        })
        </script>

    </div>


</body>