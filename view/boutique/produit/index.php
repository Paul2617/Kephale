<?php new html(); ?>
<?php

?>

<body>
    <?php ;
     $previous_url = $_SERVER['HTTP_REFERER'];
    new Retoure('/boutique'); ?>
    <style>
    .section {
        margin-right: 5px;
    }

    .divPlusPlus {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;

    }

    .divPlusPlus select {
        padding-left: 0px;
        width: 45%;
        margin-bottom: 5px;

    }

    .Suprimerfd {
        margin-top: 10px;
        background-color: brown;
    }

    .variant-stock {
        width: 45%;
        margin-right: 5px;
    }

    .variant-price {
        width: 45%;
        margin-right: 5px;
    }
    </style>
    <div class="div_blok">
        <?php
        if($ProduitCode === true){
            ?>
        <div style=" display: flex; width: 100%; justify-content: right;  margin-bottom: 10px;">
            <a class="a" href="/boutique/produitAjoute">Ajouter un produit</a>
        </div>
        <?php
        }else{
             ?>
        <div style=" display: flex; width: 100%; justify-content: right;  margin-bottom: 10px;">
            <a style="background-color: red; " class="a" >Limite de produit atteinte</a>
        </div>
        <?php
        }
          ?>

        <h1 style="font-size: 1rem; margin-bottom: 10px; ">Liste des Produits</h1>
        <?php
            if($ListeProduit !== false){

                foreach($ListeProduit as $ListeProduits){
                   $produit_id = $ListeProduits['produit_id'];                
                 ?>
        <div class="div display_flex">
            <div class="display_flex_justifi">
                <section style="display: flex;">
                    <img class="user_img" src="/assets/img_produit/<?= $ListeProduits['image_url']?>" alt="">
                    <section>
                        <h1 class="user_nom"><?= $ListeProduits['name']?></h1>
                        <div style="display: flex;">
                            <section class="section">
                                <a href="/boutique/produitEdite/<?= $produit_id?>">
                                    <p>Editer</p>
                                </a>
                            </section>
                            <section class="section">
                                <a href="/produit/<?= $produit_id?>">
                                    <p>Voir</p>
                                </a>
                            </section>
                            <section class="sectionSuprimer">
                                <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                            </section>
                        </div>
            </div>
            </section>
            </section>
        </div>

        <?php
                }
            }
                ?>



    </div>



    <script>
    // Options (injectées depuis PHP)
    const sizes = <?= json_encode($sizes) ?>; // [{id, size_code},...]
    const colors = <?= json_encode($colors) ?>; // [{id, color_name},...]

    function createSelect(options, className) {
        const sel = document.createElement('select');
        sel.className = className;
        options.forEach(opt => {
            const o = document.createElement('option');
            o.value = opt.id;
            o.textContent = opt.categorie + " " + opt.size_code ?? opt.color_name ?? opt.name;
            sel.appendChild(o);
        });
        return sel;
    }

    function createSelectColore(options, className) {
        const sel = document.createElement('select');
        sel.className = className;
        options.forEach(opt => {
            const o = document.createElement('option');
            o.value = opt.id;
            o.textContent = opt.categorie ?? opt.color_name ?? opt.name;
            sel.appendChild(o);
        });
        return sel;
    }

    function addVariant(defaults = {}) {
        const container = document.getElementById('variantsContainer');
        const row = document.createElement('div');
        row.className = 'div variant-row divPlusPlus';

        const selSize = createSelect(sizes, 'variant-size');
        if (defaults.size) selSize.value = defaults.size;


        const selColor = createSelectColore(colors, 'variant-color');
        if (defaults.color) selColor.value = defaults.color;

        const inpStock = document.createElement('input');
        inpStock.type = 'number';
        inpStock.className = 'variant-stock';
        inpStock.min = 0;
        inpStock.placeholder = 'Stock';
        inpStock.value = defaults.stock ?? 0;

        const inpPrice = document.createElement('input');
        inpPrice.type = 'number';
        inpPrice.step = '0';
        inpPrice.className = 'variant-price';
        inpPrice.placeholder = 'Prix (FCFA)';
        inpPrice.value = defaults.price ?? 0;

        const btnRemove = document.createElement('button');
        btnRemove.type = 'button';
        btnRemove.className = 'Suprimerfd';
        btnRemove.textContent = 'Supprimer';
        btnRemove.onclick = () => row.remove();

        row.appendChild(selSize);
        row.appendChild(selColor);
        row.appendChild(inpStock);
        row.appendChild(inpPrice);
        row.appendChild(btnRemove);

        container.appendChild(row);
    }

    // Collecte les variantes dans un tableau d'objets
    function collectVariants() {
        const rows = document.querySelectorAll('.variant-row');
        const arr = [];
        rows.forEach((r) => {
            const size = r.querySelector('.variant-size').value;
            const color = r.querySelector('.variant-color').value;
            const stock = r.querySelector('.variant-stock').value;
            const price = r.querySelector('.variant-price').value;
            if (size && color) {
                arr.push({
                    size: parseInt(size, 10),
                    color: parseInt(color, 10),
                    stock: parseInt(stock || 0, 10),
                    price: parseInt(price || 0)
                });
            }
        });
        return arr;
    }

    // Avant envoi, remplir le hidden variants_json
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const variants = collectVariants();
        if (variants.length === 0) {
            e.preventDefault();
            alert('Ajoute au moins une variante.');
            return false;
        }
        document.getElementById('variants_json').value = JSON.stringify(variants);
        // laisser la soumission continue (multipart/form-data pour images)
    });

    // Par défaut, ajouter 1 variante prête à remplir
    addVariant();
    const btn = document.getElementById("toggleBtn");
    const div = document.getElementById("maDiv");

    btn.addEventListener("click", () => {
        if (div.style.display === "none" || div.style.display === "") {
            div.style.display = "block";
            btn.textContent = "Masquer";
        } else {
            div.style.display = "none";
            btn.textContent = "Créer un produit";
        }
    });
    </script>

    <div style="margin-top: 10rem;"></div>

    <?php new html_nav_bar(""); ?>
</body>