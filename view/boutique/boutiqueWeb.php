<?php new html(); ?>

<body>
    <div class=' nav_bare'>
        <section class='nav_bare_logo'>
            <img style='width: 30px;  height: 30px; object-fit: cover; border-radius: 100%; margin-right: 5px; '
                src="/assets/img_boutique_profile/24025457_250909_164438.jpg" alt="">
            <h2 class="user_nom" style="font-size: 0.8rem;">Képhale </h2>

        </section>
        <form method="POST" enctype="multipart/form-data" style="width: 70%;">
            <input style=" background: rgba(255, 255, 255, 0); " type="text" name='new_recherche'
                placeholder="Rechercher..." />
        </form>

    </div>

    <img class="img" src="/assets/img_boutique_profile/24025457_250909_164438.jpg" alt="">

    <div class="div_blok">

        <div class="div display_flex">
            <div class="display_flex_justifi">
                <section style="display: flex; align-items: center;">
                    <img style="border-radius: 100%;" class="user_img" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                    <section>
                        <h1 class="user_nom">Paul Koné</h1>
                        <p>Kalabon koura </p>

                    </section>
                </section>
            </div>
            <a href="/boutique/parametre">
                <img class="icon_edite" src="/public/icons/parametres.svg" alt="">
            </a>
        </div>

        <div class="blokinfoBoutique bloc_scrole_menu" style="height: 50px; ">
            <section class="scrole">
                <form style="margin-right: 20px;" method="POST" enctype="multipart/form-data">
                    <input style="color: #1D71B8;" type="submit" value="Homme" name="copie">
                </form>
                <form style="margin-right: 20px;" method="POST" enctype="multipart/form-data">
                    <input type="submit" value="Femme" name="copie">
                </form>
                <form style="margin-right: 20px;" method="POST" enctype="multipart/form-data">
                    <input type="submit" value="Enfant" name="copie">
                </form>
                <form style="margin-right: 20px;" method="POST" enctype="multipart/form-data">
                    <input type="submit" value="Electronique" name="copie">
                </form>
                <form style="margin-right: 20px;" method="POST" enctype="multipart/form-data">
                    <input type="submit" value="Cosmetique" name="copie">
                </form>
            </section>

        </div>
 <div style=" margin-bottom: 2rem;"></div>
    </div>
      <div class="articles">

            <div class="article">
                <img class="img" src="/assets/img_article/24025457_250909_164438.jpg" alt="Article image" />
                <div class="content">
                    <div class="description">
                        <?= 'lorem '?>
                    </div>
                    <div class="prix">10.0000<p> FCFA</p>
                    </div>
                    <div class="footer">
                        <span class="icon"><img class="iconcertifie" src="/assets/icons/certifie.svg" /></span>
                        <a class="a" href="">Voir</a>
                    </div>
                </div>
            </div>

            <div class="article">
                <img class="img" src="/assets/img_article/24025457_250909_164438.jpg" alt="Article image" />
                <div class="content">
                    <div class="description">
                        <?= 'lorem '?>
                    </div>
                    <div class="prix">10.0000<p> FCFA</p>
                    </div>
                    <div class="footer">
                        <span class="icon"><img class="iconcertifie" src="/assets/icons/certifie.svg" /></span>
                        <a class="a" href="">Voir</a>
                    </div>
                </div>
            </div>


            <div class="article">
                <img class="img" src="/assets/img_article/24025457_250909_164438.jpg" alt="Article image" />
                <div class="content">
                    <div class="description">
                        <?= 'lorem '?>
                    </div>
                    <div class="prix">10.0000<p> FCFA</p>
                    </div>
                    <div class="footer">
                        <span class="icon"><img class="iconcertifie" src="/assets/icons/certifie.svg" /></span>
                        <a class="a" href="">Voir</a>
                    </div>
                </div>
            </div>



            <div class="article">
                <img class="img" src="/assets/img_article/24025457_250909_164438.jpg" alt="Article image" />
                <div class="content">
                    <div class="description">
                        <?= 'lorem '?>
                    </div>
                    <div class="prix">10.0000<p> FCFA</p>
                    </div>
                    <div class="footer">
                        <span class="icon"><img class="iconcertifie" src="/assets/icons/certifie.svg" /></span>
                        <a class="a" href="">Voir</a>
                    </div>
                </div>
            </div>





        </div>
    <div style=" margin-bottom: 3rem;"></div>
    <?php new html_nav_bar(''); ?>


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