<?php ; new html(); ?>

<body>
    <?php ; new Retoure('/boutique/produit'); ?>
    <div style=" margin-bottom: 3rem;"></div>

    <div class='div_blok'>
        <section class='section section_width'>
            <div style=" display: flex; width: 100%; justify-content: right; ">
                <button id="toggleBtns">Modifier les images</button>
            </div>
            <div id="maDivd" style="display: none; margin-top: 10px;  ">
                <div class="bolckImgArticleedite">
                    <section class="bolckImgArticleSp">
                        <img class="img_articleSp" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                        <section class="sectionSuprimer">
                            <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                        </section>
                    </section>

                    <section class="bolckImgArticleSp">
                        <img class="img_articleSp" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                        <section class="sectionSuprimer">
                            <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                        </section>
                    </section>

                    <section class="bolckImgArticleSp">
                        <img class="img_articleSp" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                        <section class="sectionSuprimer">
                            <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                        </section>
                    </section>

                    <section class="bolckImgArticleSp">
                        <img class="img_articleSp" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                        <section class="sectionSuprimer">
                            <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                        </section>
                    </section>

                    <section class="bolckImgArticleSp">
                        <img class="img_articleSp" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                        <section class="sectionSuprimer">
                            <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                        </section>
                    </section>


                    <section class="bolckImgArticleSp">
                        <img class="img_articleSp" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                        <section class="sectionSuprimer">
                            <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                        </section>
                    </section>

                    <section class="bolckImgArticleSp">
                        <img class="img_articleSp" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                        <section class="sectionSuprimer">
                            <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                        </section>
                    </section>

                </div>
            </div>

        </section>
    </div>


    <div class='div_blok'>
        <section class='section section_width'>
            <form method="POST" enctype="multipart/form-data">
                <section class='section'>
                    <input type="file" id="file" name="images[]" multiple>
                    <label for="file">
                        <img src="/assets/icons/home.svg" alt="">
                        <h2>Sélectionne plus d'image </h2>
                    </label>
                </section>
                <input style="margin-top: -20px; margin-bottom: 20px;" class="submit" type="submit"
                    value="Ajouter la sélectionne" name="new_img">



                <p class='formTexte'>Nom de l'article</p>
                <section style=" display: flex; justify-content: space-between;">
                    <input style="width: 60%;" type="text" name="nom" value="Nom de l'article" required>
                    <input class="submit" type="submit" value="Modifier" name="new_nom">
                </section>

                <p class='formTexte'>Prix de l'article</p>
                <section style=" display: flex; justify-content: space-between;">
                    <input style="width: 60%;" type="number" name="telephone" value="10000" required>
                    <input class="submit" type="submit" value="Modifier" name="new_telephone">
                </section>
                <p class='formTexte'>Quantite disponible</p>
                <section style=" display: flex; justify-content: space-between;">
                    <input style="width: 60%;" type="number" name="telephone" value="20" required>
                    <input class="submit" type="submit" value="Modifier" name="new_telephone">
                </section>
                <p class='formTexte'>Descriptions de l'article</p>
                <section style=" display: flex; justify-content: space-between;">
                    <textarea style="width: 70%;" class="doldkdmslls" name="descriptions_article"
                        placeholder="Descriptions..." rows="2" required>Descriptions de l'article</textarea>
                    <input class="submit" type="submit" value="Modifier" name="new_telephone">
                </section>

                <p class='formTexte'>Tailles disponibles : <span>S, L, XXL</span> </p>
                <section style=" display: flex; justify-content: space-between;">
                    <?php
                         require_once "../html/taille/taille_vetement.php";

                ?>
                    <input class="submit" type="submit" value="Modifier" name="new_sex">
                </section>

            </form>
        </section>
    </div>
    <div style=" margin-bottom: 10rem;"></div>
    <script>
    const btn = document.getElementById("toggleBtns");
    const div = document.getElementById("maDivd");

    btn.addEventListener("click", () => {
        if (div.style.display === "none" || div.style.display === "") {
            div.style.display = "block";
            btn.textContent = "Masquer";
        } else {
            div.style.display = "none";
            btn.textContent = "Modifier les images";
        }
    });
    </script>
    <?php new html_nav_bar(info: ''); ?>
</body>