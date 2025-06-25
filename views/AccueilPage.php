<?php ?>
<div class='nav_bare'>
    <section class="bloc_nave">

    <section class='bloc_logo'>
        <p class='bloc_logo_p'>Kephalé</p>
    </section>

    <section class='forme_recherche' >
        <input class='input_reche' type="text"  id="searchInput" placeholder="Rechercher..." >
        <button class='button_reche' type=""><img class="img_reche" src="public/asset/home_svg/loupe.svg" alt=""></button>
    </section>
    </section>

</div>
<div style="padding-top: 60px;" ></div>
<div id="contenu" class="bloc_scrole_menu">

        <section class="scrole">
        <a class="slider" href="/Kephale/listeboutique&rc=Homme">
            <img class="slider_img" src="public/asset/_img_page/Homme.jpg" alt="">
            <p>Hommes</p>
        </a>

        <a class="slider" href="/Kephale/listeboutique&rc=Femme">
        <img class="slider_img" src="public/asset/_img_page/Femme.jpg" alt="">
        <p>Femmes</p>
        </a>

        <a class="slider" href="/Kephale/listeboutique&rc=Enfant">
        <img class="slider_img" src="public/asset/_img_page/Enfant.jpg" alt="">
        <p>Enfants</p>
        </a>

        <a class="slider" href="/Kephale/listeboutique&rc=Électronique">
        <img class="slider_img" src="public/asset/_img_page/Électronique.jpg" alt="">
        <p>Électroniques</p>
        </a>

        <a class="slider" href="">
        <img class="slider_img" src="public/asset/_img_page/Cosmétique.jpg" alt="">
        <p>Cosmétiques</p>
        </a>
    
          <a class="slider" href="">
        <img class="slider_img" src="public/asset/_img_page/Restaurant.jpg" alt="">
        <p>Restosr</p>
        </a>

        </section>
    </div>

    <div  class='dkdddjk'>
<h1>Nouveaux Articles</h1>
    </div>

    <section id="contenuTrois" class="bloc_scrole_menu">
           <div class="scrole" id="new_article"></div>
    </section>

   <div  id="resdults"></div>

    <div class='lvgkdjshjgh'>
          <div class="eelllfllekkf" id="articles"></div>
    </div>

<script src="js/liste_new_articles_home/fetchNewArticle.js" ></script>
<script src="js/liste_article_home/fetchArticles.js" ></script>

  <script>
    const input = document.getElementById('searchInput');
    const contenu = document.getElementById('contenu');
    const contenuDeux = document.getElementById('contenuDeux');
    const contenuTrois = document.getElementById('contenuTrois');

    input.addEventListener('input', () => {
      contenu.style.display = input.value.length > 0 ? 'none' : 'block';
      contenuDeux.style.display = input.value.length > 0 ? 'none' : 'block';
      contenuTrois.style.display = input.value.length > 0 ? 'none' : 'block';
    });
  </script>