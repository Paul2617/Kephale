<?php new html();  
?>
<body>
    <style>
        /* ===== STYLES GLOBAUX ===== */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            padding-top: 60px; /* Espace pour la nav_bare fixe */
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            /* Empêcher le zoom sur focus input sur iOS */
            -webkit-text-size-adjust: 100%;
        }

        /* ===== NAVIGATION ===== */
        .nav_bare {
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* ===== BARRE DE MENU EN BAS ===== */
        .menu_barre_bloc {
            position: fixed !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 999;
        }

        .nav_bare_logo img {
            transition: transform 0.3s ease;
        }

        .nav_bare_logo img:hover {
            transform: scale(1.1);
        }

        /* ===== IMAGE PRINCIPALE ===== */
        .img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
            display: block;
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* ===== SECTION SCROLLABLE (CATÉGORIES) ===== */
        .bloc_scrole_menu {
            width: 100%;
            padding: 1rem 0;
            background: #f8f9fa;
            margin: 1rem 0;
        }

        .scrole {
            display: flex;
            align-items: center;
            overflow-x: auto;
            overflow-y: hidden;
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: #ccc transparent;
            padding: 0.5rem 1rem;
            gap: 0.75rem;
        }

        .scrole::-webkit-scrollbar {
            height: 6px;
        }

        .scrole::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrole::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .scrole::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        .slider {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #000;
            min-width: 100px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            scroll-snap-align: start;
        }

        .slider:hover {
            transform: translateY(-5px);
            opacity: 0.9;
        }

        .slider:active {
            transform: translateY(-2px);
        }

        .slider_img {
            width: 100px;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .slider:hover .slider_img {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: scale(1.05);
        }

        .slider p {
            margin-top: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: #000;
            text-align: center;
        }

        /* ===== CHAMP DE RECHERCHE ===== */
        #search {
            width: 100%;
            max-width: 500px;
            padding: 0.875rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 16px; /* 16px minimum pour empêcher le zoom sur iOS */
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
        }

        #search:focus {
            border-color: #333;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.1);
            /* Maintenir la position fixe des éléments */
            position: relative;
            z-index: 1;
        }

        #search::placeholder {
            color: #999;
        }

        /* ===== GRILLE DE PRODUITS ===== */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
            padding: 1rem;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== CARTES PRODUITS ===== */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }

        .card:active {
            transform: translateY(-4px);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 0.75rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content p {
            margin: 0 0 0.5rem;
            color: #666;
            font-size: 0.7rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.4;
        }

        .card-content h3 {
            color: #000;
            font-size: 0.85rem;
            font-weight: 600;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .prices {
            font-weight: 700;
            color: #000;
            font-size: 1rem;
            margin: 0.5rem 0;
        }

        /* ===== BOUTON ACHETER ===== */
        .btn-buy {
            display: inline-block;
            background: #1c1c1c;
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            text-decoration: none;
            margin-top: auto;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-buy:hover {
            background: #373737;
            transform: scale(1.02);
        }

        .btn-buy:active {
            transform: scale(0.98);
        }

        /* ===== LIENS EN NOIR ===== */
        a {
            color: #000;
            text-decoration: none;
        }

        a:visited {
            color: #000;
        }

        a:hover {
            color: #333;
        }

        a:active {
            color: #000;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            body {
                padding-top: 50px; /* Ajustement pour mobile */
            }
            
            .nav_bare {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
            }
            
            .grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
                gap: 0.75rem;
                padding: 0.75rem;
            }

            .card img {
                height: 180px;
            }

            .slider {
                min-width: 90px;
            }

            .slider_img {
                width: 90px;
                height: 120px;
            }

            .img {
                max-height: 250px;
            }

            #search {
                max-width: 100%;
                padding: 0.75rem 1rem;
                font-size: 16px; /* Empêcher le zoom sur iOS */
            }
        }

        @media (max-width: 480px) {
            .grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 0.5rem;
                padding: 0.5rem;
            }

            .card img {
                height: 160px;
            }

            .card-content {
                padding: 0.5rem;
            }

            .card-content h3 {
                font-size: 0.75rem;
            }

            .card-content p {
                font-size: 0.65rem;
            }

            .prices {
                font-size: 0.9rem;
            }

            .btn-buy {
                padding: 0.6rem 1rem;
                font-size: 0.75rem;
            }

            .slider {
                min-width: 80px;
            }

            .slider_img {
                width: 80px;
                height: 110px;
            }

            .slider p {
                font-size: 0.7rem;
            }
        }

        @media (min-width: 1024px) {
            .grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 1.25rem;
                padding: 1.5rem;
            }

            .card img {
                height: 220px;
            }
        }

        /* ===== ANIMATION DE CHARGEMENT ===== */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .card.loading {
            animation: pulse 1.5s ease-in-out infinite;
        }
    </style>
        <div class=' nav_bare'>
        <section class='nav_bare_logo'>
            <img style='width: 30px;  height: 30px;' src="/assets/icons/home.svg" alt="">

        </section>
            <!-- 
        <svg class="icon-theme" viewBox="0 0 24 24" width="24" height="24" onclick="toggleTheme()">
            <path
                d="M12 4V2M12 22v-2M4.93 4.93l-1.41-1.41M19.07 19.07l-1.41-1.41M2 12H4m16 0h2M4.93 19.07l-1.41 1.41M19.07 4.93l-1.41 1.41"
                fill="none" stroke="currentColor" stroke-width="2" />
            <circle cx="12" cy="12" r="5" fill="currentColor" />
        </svg>
        -->
    </div>
 <img class="img" src="/assets/img_home/Cosmétique.jpg" alt="">

    <!--  
    <div class="video-wrap">
        <video class="video_source" id="vid" autoplay loop muted playsinline preload="auto" poster="poster.jpg"
            style="width:100%; height:auto;">
            <source src="/assets/vidios.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la vidéo HTML5.
        </video>
        <button class="unmute" id="unmuteBtn">Activer le son</button>
    </div>
-->
    <div id="contenu" class="bloc_scrole_menu">
        <section class="scrole">
            <a class="slider" href="">
                <img class="slider_img" src="/assets/img_home/Homme.jpg" alt="">
                <p>Hommes</p>
            </a>

            <a class="slider" href="">
                <img class="slider_img" src="/assets/img_home/Femme.jpg" alt="">
                <p>Femmes</p>
            </a>

            <a class="slider" href="">
                <img class="slider_img" src="/assets/img_home/Enfant.jpg" alt="">
                <p>Enfants</p>
            </a>

            <a class="slider" href="">
                <img class="slider_img" src="/assets/img_home/Électronique.jpg" alt="">
                <p>Électroniques</p>
            </a>

            <a class="slider" href="">
                <img class="slider_img" src="/assets/img_home/Cosmétique.jpg" alt="">
                <p>Cosmétiques</p>
            </a>

        </section>
    </div>
    <div style="margin: 1rem 1.25rem 1.5rem;">
        <input id="search" type="text" placeholder="Rechercher un produit..." />
    </div>

      <!-- PRODUITS -->
  <section class="grid" id="fruitBody">
  </section>

    <div style=" margin-bottom: 5rem;"></div>
    <?php new html_nav_bar('home'); ?>
</body>

<script>

   const input = document.getElementById('search');
    const tbody = document.getElementById('fruitBody');
    const url = <?= json_encode($url_actuelle) ?>;
    const produit = <?= json_encode($produit) ?>;
    function formatPrix(p) {
    return new Intl.NumberFormat('fr-FR').format(p);
}
  function afficherProduit(liste) {
    tbody.innerHTML = '';
    if(liste.length === 0){
        tbody.innerHTML = '<tr><td colspan="3">Aucun fruit trouvé 🍂</td></tr>';
        return;
    }
    liste.forEach(produits => {
        tbody.innerHTML +=`

            <div class="card" data-category="chaussures">
      <img src="/assets/img_produit/${produits.image}" alt="Produit 1">
      <div class="card-content">
        <p>${ produits.descriptions}</p>
        <h3>${ produits.nom}</h3>
        <h2 class="prices">${ formatPrix(produits.prix) } FCFA</h2>
        <a style="text-decoration: none; color: #fff;" href="/produit/${ produits.id}" class="btn-buy">Acheter</a>
      </div>
    </div>
        `;
    });
}
    // Chargement initial
    afficherProduit(produit);

 // 🔹 Recherche fluide avec AJAX
let timer;
input.addEventListener('keyup', () => {
    clearTimeout(timer);
    timer = setTimeout(async () => {
        const search = encodeURIComponent(input.value);
        const res = await fetch(url + `/produit/produit.php?search=${search}`);
        const data = await res.json();
        afficherProduit(data);
    }, 300);
});

/*

    window.addEventListener("load", function() {
    const scrollLimit = 47;
    // ajuste selon ton besoin 47

    // Scroll automatique au chargement
    window.scrollTo(0, scrollLimit);

    // Empêcher de descendre au-delà de ce niveau
    window.addEventListener("scroll", function() {
        if (window.scrollY < scrollLimit) {
            window.scrollTo(0, scrollLimit);
        }
    });

});*/

    // Maintenir les positions fixes lors de l'ouverture du clavier
    const navBare = document.querySelector('.nav_bare');
    const menuBarreBloc = document.querySelector('.menu_barre_bloc');
    
    // Sauvegarder les positions initiales
    let initialViewportHeight = window.innerHeight;
    
    // Fonction pour maintenir les positions fixes
    function maintainFixedPositions() {
        if (navBare) {
            navBare.style.position = 'fixed';
            navBare.style.top = '0';
            navBare.style.left = '0';
            navBare.style.right = '0';
        }
        
        if (menuBarreBloc) {
            menuBarreBloc.style.position = 'fixed';
            menuBarreBloc.style.bottom = '0';
            menuBarreBloc.style.left = '0';
            menuBarreBloc.style.right = '0';
        }
    }
    
    // Écouter les événements de focus/blur sur l'input
    input.addEventListener('focus', function() {
        maintainFixedPositions();
        // Forcer le recalcul des positions
        setTimeout(maintainFixedPositions, 100);
    });
    
    input.addEventListener('blur', function() {
        maintainFixedPositions();
    });
    
    // Écouter les changements de taille de viewport (clavier mobile)
    window.addEventListener('resize', function() {
        maintainFixedPositions();
    });
    
    // Écouter les changements d'orientation
    window.addEventListener('orientationchange', function() {
        setTimeout(maintainFixedPositions, 200);
    });
    
    // Maintenir les positions au chargement
    maintainFixedPositions();

</script>
