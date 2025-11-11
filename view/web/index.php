<?php new html(); ?>

<body>


        <?php ;
    use Middleware\Page_precedant;
    $page_p = Page_precedant::page_p();
    new Retoure($page_p ); ?>
<style>
   
    body {
      font-family: 'Poppins', sans-serif;
      background: #f9fafc;
      color: #333;
      margin: 0;
      padding: 0;
    }

    header {
      background: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
       padding: 3rem 1rem 1rem 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .boutique-info {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 10px;
    }

    .boutique-info img {
      width: 65px;
      height: 65px;
      border-radius: 50%;
      border: 2px solid #eee;
      object-fit: cover;
    }

    .boutique-info h2 {
      margin: 0;
      font-size: 1.3rem;
      color: #252525ff;
    }

    .boutique-info small {
      color: #777;
    }

    .actions a {
      text-decoration: none;
      background: #2d6cdf;
      color: white;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 0.9rem;
      transition: background 0.2s ease;
    }

    .actions a:hover {
      background: #174ab0;
    }

    .filters {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin: 1.5rem auto;
      flex-wrap: wrap;
    }

    select, input[type="text"] {
      padding: 10px 14px;
      border: 1px solid #ddd;
      border-radius: 8px;
      outline: none;
      font-size: 1rem;
      background: white;
    }

    input[type="text"]:focus, select:focus {
      border-color: #2d6cdf;
      box-shadow: 0 0 8px rgba(45,108,223,0.2);
    }

    .stats {
      text-align: center;
      margin-bottom: 1rem;
      color: #555;
      font-weight: 500;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
      gap: 10px;
      padding: 1.5rem 0.7rem;
    }

    .card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      overflow: hidden;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    }

    .card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .card-content {
      padding: 0.3rem 0.6rem;
    }

    .card-content h3 {
      color: #1b1b1dff;
      font-size: 0.8rem;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 1; /* Limite à 2 lignes */
      -webkit-box-orient: vertical;
    }

    .card-content p {
      margin: 0 0 5px;
      color: #555;
      font-size: 0.6rem;
       overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 1; /* Limite à 2 lignes */
      -webkit-box-orient: vertical;
    }

    .prices {
      font-weight: bold;
      color: #1d1d1dff;
      font-size: 1.0rem;
    }

    .btn-buy {
      display: inline-block;
      background: #1d1d1dff;
      color: white;
      padding: 10px 19px;
      border-radius: 8px;
      text-decoration: none;
      margin-top: 10px;
      margin-bottom: 10px;
      transition: background 0.2s ease;
    }

    .btn-buy:hover {
      background: #393939ff;
    }

    footer {
      text-align: center;
      color: #aaa;
      padding: 1rem 0;
      font-size: 0.8rem;
      margin-top: 2rem;
    }

</style>
<!-- HEADER -->
  <header>
    <div class="boutique-info">
      <img src="/assets/img_boutique_profile/<?= $web_boutique_user['img'] ?>" alt="Logo Boutique">
      <div>
        <h2 style="margin-bottom: -7px;" ><?= $web_boutique_user['nom'] ?></h2>
        <small>Propriétaire : <b><?= $web_boutique_user['user_nom'] ?></b></small><br>
       <!-- <small>Ventes totales : <b id="sales-count">328</b></small> -->
      </div>
    </div>
    <div class="actions">
        <small ><b style="color: #146836;" id="sales-count">0</b> vts</small>
       <!-- <a href="#">Ajouter un produit</a> -->
    </div>
  </header>
  <!-- FILTRES -->

  <div class="filters">
    <input type="text" id="search" placeholder="Rechercher un produit...">
    <select style="margin: 10px 160px; " id="category">
      <option value="all">Toutes les catégories</option>
      <?php 
      
  foreach($produit as $produits){
    ?>
    <option value="<?= $produits['categori'] ?>"><?= $produits['categori'] ?></option>
     <?php 
  }
     ?>
    </select>
  </div>

  <p class="stats">Affichage de <span id="product-count">0</span> produits</p>

  <!-- PRODUITS -->
  <section class="grid" id="product-list">

  <?php 
  use Middleware\ConvertionSolde;
  foreach($produit as $produits){
   $prix =  ConvertionSolde::newSolde($produits['prix']);
     ?>
       <div class="card" data-category="<?= $produits['categori'] ?>">
      <img src="/assets/img_produit/<?= $produits['image']?>" alt="Produit 1">
      <div class="card-content">
        <h3><?= $produits['nom']?></h3>
        <p><?= $produits['descriptions']?></p>
        <h2 class="prices"><?=  $prix.' '.$produits['devise'] ?></h2>
        <a href="/produit/<?= $produits['id']?>" class="btn-buy">Acheter</a>
      </div>
    </div>
    <?php 
  }
  ?>
  </section>

  <footer>
    © 2025 Kephale Mali - Boutique de <?= $web_boutique_user['user_nom'] ?>.
  </footer>
  <div style="margin-bottom: 7rem;" ></div>
 
  <script>
    // Recherche + Filtrage
    const searchInput = document.getElementById('search');
    const categorySelect = document.getElementById('category');
    const products = document.querySelectorAll('.card');
    const productCount = document.getElementById('product-count');

    function filterProducts() {
      const term = searchInput.value.toLowerCase();
      const cat = categorySelect.value;
      let visibleCount = 0;

      products.forEach(p => {
        const text = p.innerText.toLowerCase();
        const matchesSearch = text.includes(term);
        const matchesCategory = cat === 'all' || p.dataset.category === cat;
        const visible = matchesSearch && matchesCategory;
        p.style.display = visible ? '' : 'none';
        if (visible) visibleCount++;
      });

      productCount.textContent = visibleCount;
    }

    searchInput.addEventListener('keyup', filterProducts);
    categorySelect.addEventListener('change', filterProducts);
    window.onload = filterProducts;


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
  </Script>
</body>
