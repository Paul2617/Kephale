<?php new html(); ?>
<body>
    <img id="img_primsipael" style="" class="img plusdjjs" src="/assets/img_home/restaut.jpg" alt="">
    <h1>restaurant</h1>

    <div style=" margin-bottom: 50rem;"></div>
    <?php new html_nav_bar('restaurant'); ?>
</body>


<script>
// Valeur de scroll initiale
const scrollLimit = 47;
// ajuste selon ton besoin

// Scroll automatique au chargement
window.scrollTo(0, scrollLimit);

// Empêcher de descendre au-delà de ce niveau
window.addEventListener("scroll", function () {
if (window.scrollY < scrollLimit) {
window.scrollTo(0, scrollLimit);
}
});
</script>