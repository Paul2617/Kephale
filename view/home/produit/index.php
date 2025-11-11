<?php new html(); ?>
<body>
    <?php ; new Retoure('/home'); ?>
            <div class="bloc_fix_parame" >
            <div class="bolkForme">
                <form class="form_pad" method="POST" enctype="multipart/form-data">
                    <p class='formTexte' style='margin-top: 17px;'>Tailles disponibles </p>
                    <section style="width: 100%;" class="bloc_taille">
                         <div class="form-element">
                        <input type="radio" name="options[]" value="X" id="X">
                        <label for="X">
                            <div class="title">X</div>
                        </label>
                    </div>
                       <div class="form-element">
                        <input type="radio" name="options[]" value="XL" id="XL">
                        <label for="XL">
                            <div class="title">XL</div>
                        </label>
                    </div>
                       <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">XXL</div>
                        </label>
                    </div>
                        <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">XXXL</div>
                        </label>
                    </div>
                        <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">L</div>
                        </label>
                    </div>
                        <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">M</div>
                        </label>
                    </div>
                        <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">LM</div>
                        </label>
                    </div>
                        <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">N</div>
                        </label>
                    </div>
                        <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">NL</div>
                        </label>
                    </div>
                        <div class="form-element">
                        <input type="radio" name="options[]" value="XXL" id="XXL" >
                        <label for="XXL">
                            <div class="title">ML</div>
                        </label>
                    </div>
                    </section>
                    <p style='margin-top: -20px;' class='formTexte'>Quantité</p>
      
                <input style='width: 20%; z-index: 1; ' type="number" name="quantite" value="1" required>
                <div class="footer">
                    <input class="boutton_inputee" type="submit" name='panier' value="Ajouter au panier"  >
                     <input class="boutton_inputee" type="submit"  name="achetes"value="Achetes" required> 
                </div>
                </form>
            </div>

        </div>
     <div class="image-gallery">
            <img src="/assets/img_article/24025457_250909_164438.jpg" />
            <img src="/assets/img_article/24025457_250909_164438.jpg" />
            <img src="/assets/img_article/24025457_250909_164438.jpg" />
        </div>
        <div class="articles" >
            <div class="div">
      <div class="title">Mange</div>
            <div class="descriptions">quam labore nobis corrupti. Temporibus velit dolores error atque sed amet eius assumenda nisi est accusantium.Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere at dolore fuga recusandae consectetur quisquam labore nobis corrupti. Temporibus velit dolores error atque sed amet eius assumenda nisi est accusantium.Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere at dolore fuga recusandae consectetur quisquam labore nobis corrupti. Temporibus velit dolores error atque sed amet eius assumenda nisi est accusantium.</div>
            <div class="texte">La livraison est à seulement <span>200 FCFA</span> par kilomètre.</div>
            </div>
        </div>

        <div style=" margin-bottom: 50rem;"></div>
</body>
<script>
    window.addEventListener("load", function() {
    const scrollLimit = 55;
    // ajuste selon ton besoin

    // Scroll automatique au chargement
    window.scrollTo(0, scrollLimit);

    // Empêcher de descendre au-delà de ce niveau
    window.addEventListener("scroll", function() {
        if (window.scrollY < scrollLimit) {
            window.scrollTo(0, scrollLimit);
        }
    });


const v = document.getElementById('vid');
const btn = document.getElementById('unmuteBtn');

// Sur mobile, le son nécessite une interaction de l’utilisateur
btn.addEventListener('click', () => {
    v.muted = false;
    v.play().catch(() => {}); // tente de relancer si nécessaire
    btn.style.display = 'none';
});
});

</script>

