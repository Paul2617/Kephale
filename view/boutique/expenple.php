<?php new html(); ?>

<body>
        <div class=' nav_bare' style=" justify-content: flex-end;">
        <section class='nav_bare_logo' >
           <a href="/boutique/parametre">
                <img class="icon_edite" src="/assets/icons/parametres.svg" alt="">
            </a>
        </section>


    </div>
    <img class="img"  src="/assets/img_boutique_profile/<?= $img_profile?>" alt="">

    <div class="div_blok">

        <div class="div display_flex">
            <div class="display_flex_justifi">
                <section style="display: flex;">
                    <section>
                        <h1 class="user_nom"><?= $nom_boutique   ?></h1>
                        <section class="section">
                        <p>Solde: <?= $balance_.' '. $devise?></p>
                        </section>
                    </section>
                    <section style="margin-left: 10px;" >
                        <p>Offre<span>  <?= $type_abonnement?></span> </p>
                        <p style="font-size: 0.5rem;" >Valable jusqu'au <?= $fin?></p>
                        <p style="font-size: 0.6rem;"></p>
                        <p style="width: 100%; font-size: 0.6rem; <?php  if($jour_restant >= 5){ echo "color: #68c802ff;";}else{echo "color: #c82302ff;";} ?> " > <span>  <?= $jour_restant?> jrs restants </span></p>
                    </section>
                </section>
            </div>
        </div>

        <div class="blokinfoBoutique">
       
            <section class="section">
                <a href="">Statistique</a>
            </section>
             <section class="section">
                 <a  class="notificationLink" href="">
                 <img class="icon_edite" src="/assets/icons/transfer.svg" alt="">
                 <div class="notification" >10</div>
                 </a>
            </section>
            <section class="section">
                <a  class="notificationLink" href="">
                 <img class="icon_edite" src="/assets/icons/panier.svg" alt="">
                 <div class="notification" >10</div>
                 </a>
            </section>
             <section class="section">
                <a  class="notificationLink" href="/boutique/web/1">
                 <img class="icon_edite" src="/assets/icons/home.svg" alt="">
                 </a>
            </section>
        </div>

        <section class="display_flex_blok">
            <a class="link_liste" href="/boutique/produit">Mes Produits</a>
            <a class="link_liste" href="/boutique/produit">Collection</a>
            <div style=" margin-bottom: 2rem;"></div>
            <form method="POST" enctype="multipart/form-data">
                <input class="red" type="submit" value="Déconnexion" name="deconnexion">
            </form>
        </section>

    </div>
<div style=" margin-bottom: 10rem;"></div>
    <?php new html_nav_bar('plus'); ?>


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