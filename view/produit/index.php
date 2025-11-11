<?php new html(); ?>

<body>
    <?php 
    new Retoure('/home'); ?>
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
        background-color: #ffffff;
        -webkit-text-size-adjust: 100%;
    }

    /* ===== NAVIGATION FIXE ===== */
    .nav_bare {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        z-index: 1000 !important;
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .retoure {
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .retoure:hover {
        background-color: rgba(255, 255, 255, 1);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .retoure a {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        font-weight: 600;
        color: #000;
    }

    /* ===== BARRE DE MENU EN BAS ===== */
    .menu_barre_bloc {
        position: fixed !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 999 !important;
    }

    /* ===== SECTION IMAGES ===== */
    .images {
        flex: 1;
        padding: 1rem;
        padding-top: 1.5rem;
        animation: fadeIn 0.6s ease-in;
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .main-image {
        width: 100%;
        max-height: 500px;
        height: auto;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s ease;
        object-fit: contain;
        background: #ffffff;
        display: block;
        margin: 0 auto;
    }

    .main-image:hover {
        transform: scale(1.02);
        box-shadow: 0 12px 32px rgba(0,0,0,0.18);
    }

    .thumbnails {
        overflow-x: auto;
        scrollbar-width: thin;
        scrollbar-color: #ccc transparent;
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
        padding: 0.75rem 0;
        scroll-snap-type: x mandatory;
    }

    .thumbnails::-webkit-scrollbar {
        height: 6px;
    }

    .thumbnails::-webkit-scrollbar-track {
        background: transparent;
    }

    .thumbnails::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }

    .thumbnails::-webkit-scrollbar-thumb:hover {
        background: #999;
    }

    .thumb {
        width: 70px;
        height: 70px;
        min-width: 70px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        scroll-snap-align: start;
        background: #f8f9fa;
    }

    .thumb:hover {
        border-color: #000;
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }

    .thumb.active {
        border-color: #000;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.1), 0 4px 12px rgba(0,0,0,0.15);
        transform: scale(1.05);
    }

    /* ===== SECTION DÉTAILS ===== */
    .div_blok {
        padding: 1.5rem 1rem;
        padding-bottom: 2rem;
        animation: fadeInUp 0.6s ease-out;
        background: #ffffff;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section {
        margin-bottom: 1.75rem;
    }

    .section_width {
        width: 100%;
    }

    /* ===== FORMULAIRES ===== */
    select, input[type="number"] {
        padding: 1rem 1.25rem;
        height: auto;
        width: 100%;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 16px; /* Empêcher le zoom sur iOS */
        background: #fff;
        outline: none;
        transition: all 0.3s ease;
        cursor: pointer;
        font-family: inherit;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
    }

    select:focus, input[type="number"]:focus {
        border-color: #000;
        box-shadow: 0 0 0 4px rgba(0,0,0,0.08);
        transform: translateY(-1px);
    }

    input[type="number"] {
        cursor: text;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 1;
        height: auto;
    }

    /* ===== GROUPES DE COULEURS ===== */
    .color-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 0.75rem;
        padding: 0.5rem 0;
    }

    .color-label {
        width: auto;
        margin: 0;
        cursor: pointer;
        transition: transform 0.2s ease;
        position: relative;
    }

    .color-label:hover {
        transform: scale(1.15);
    }

    .color-label:active {
        transform: scale(1.05);
    }

    .color-label span {
        display: inline-block;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 3px solid #e0e0e0;
        vertical-align: middle;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        position: relative;
    }

    .color-label:hover span {
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        border-color: #999;
    }

    .color-label input[type="radio"]:checked + span {
        border-color: #000;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.1), 0 4px 12px rgba(0,0,0,0.2);
        transform: scale(1.1);
    }

    /* ===== PRIX ===== */
    .price {
        font-size: 1.25rem;
        font-weight: 700;
        width: 100%;
        margin: 1.5rem 0;
        color: #000;
        line-height: 1.6;
    }

    .price span {
        display: inline-block;
        margin-right: 0.75rem;
        vertical-align: middle;
    }

    .reduction {
        color: #dc0707;
        font-weight: 600;
        margin-left: 0.5rem;
        font-size: 0.95rem;
    }

    #prix_promo {
        color: #0e9804;
        font-weight: 700;
        font-size: 1.35rem;
        display: block;
        margin-top: 0.5rem;
    }

    /* ===== STOCK ===== */
    #quantite_max {
        font-weight: 600;
        color: #000;
        font-size: 1rem;
        padding: 0.5rem 0;
    }

    /* ===== BOUTONS ===== */
    .submit {
        width: 100%;
        padding: 1.125rem 1.5rem;
        border: none;
        border-radius: 14px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-family: inherit;
        position: relative;
        overflow: hidden;
    }

    .submit::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .submit:hover::before {
        width: 300px;
        height: 300px;
    }

    .backNoir {
        background-color: #1c1c1c;
        color: #fff;
        position: relative;
        z-index: 1;
    }

    .backNoir:hover {
        background-color: #2a2a2a;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }

    .backNoir:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    /* ===== DESCRIPTIONS ===== */
    .descriptions {
        width: 100%;
        height: auto;
        text-align: left;
        font-weight: 400;
        font-size: 0.9rem;
        color: #555;
        line-height: 1.8;
        margin: 0.75rem 0;
    }

    h1.descriptions {
        font-weight: 700;
        font-size: 1.25rem;
        color: #000;
        margin-bottom: 1rem;
        margin-top: 2rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f0f0f0;
    }

    /* ===== LABELS ===== */
    p[for] {
        font-weight: 600;
        color: #000;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: block;
    }

    /* ===== LIENS ===== */
    a {
        color: #000;
        text-decoration: none;
        transition: color 0.2s ease;
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
            padding-top: 55px;
        }

        .nav_bare {
            padding: 0.625rem 0.875rem;
        }

        .retoure {
            width: 36px;
            height: 36px;
        }

        .images {
            padding: 0.75rem;
            padding-top: 1rem;
        }

        .main-image {
            border-radius: 16px;
            max-height: 400px;
        }

        .thumb {
            width: 60px;
            height: 60px;
            min-width: 60px;
        }

        .div_blok {
            padding: 1.25rem 0.75rem;
            padding-bottom: 1.5rem;
        }

        .section {
            margin-bottom: 1.5rem;
        }

        select, input[type="number"] {
            padding: 0.875rem 1rem;
            font-size: 16px;
        }

        .color-group {
            gap: 0.75rem;
        }

        .color-label span {
            width: 40px;
            height: 40px;
        }

        .price {
            font-size: 1.15rem;
            margin: 1.25rem 0;
        }

        #prix_promo {
            font-size: 1.25rem;
        }

        .submit {
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
        }

        .descriptions {
            font-size: 0.85rem;
        }

        h1.descriptions {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 480px) {
        body {
            padding-top: 50px;
        }

        .nav_bare {
            padding: 0.5rem 0.75rem;
        }

        .retoure {
            width: 32px;
            height: 32px;
        }

        .retoure a {
            font-size: 1rem;
        }

        .images {
            padding: 0.5rem;
            padding-top: 0.75rem;
        }

        .main-image {
            border-radius: 14px;
            max-height: 350px;
        }

        .thumbnails {
            gap: 0.625rem;
            margin-top: 1rem;
        }

        .thumb {
            width: 55px;
            height: 55px;
            min-width: 55px;
        }

        .div_blok {
            padding: 1rem 0.5rem;
            padding-bottom: 1.25rem;
        }

        .color-group {
            gap: 0.625rem;
        }

        .color-label span {
            width: 38px;
            height: 38px;
        }

        .price {
            font-size: 1.1rem;
            margin: 1rem 0;
        }

        #prix_promo {
            font-size: 1.2rem;
        }

        .submit {
            padding: 0.875rem 1rem;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .descriptions {
            font-size: 0.8rem;
            line-height: 1.7;
        }

        h1.descriptions {
            font-size: 1.1rem;
            margin-top: 1.5rem;
        }

        select, input[type="number"] {
            padding: 0.75rem 0.875rem;
            font-size: 16px;
        }
    }

    @media (min-width: 1024px) {
        .images {
            padding: 2rem 1.5rem;
            padding-top: 2.5rem;
        }

        .main-image {
            border-radius: 24px;
            max-height: 600px;
        }

        .thumb {
            width: 80px;
            height: 80px;
            min-width: 80px;
        }

        .div_blok {
            padding: 2.5rem 2rem;
            padding-bottom: 3rem;
        }

        .color-label span {
            width: 50px;
            height: 50px;
        }

        .price {
            font-size: 1.4rem;
        }

        #prix_promo {
            font-size: 1.5rem;
        }
    }

    /* ===== ANIMATIONS SUPPLÉMENTAIRES ===== */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }

    .submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        animation: pulse 2s ease-in-out infinite;
    }
</style>
    <div class="images">
        <?php
        $imgPrincipale = null;
        foreach ($produit['images'] as $img) {
            $imgPrincipale = $img['image']; break;
        }
        ?>
         <img id="mainImage" class="main-image" src="/assets/img_produit/<?= htmlspecialchars($imgPrincipale ?? $produit['images'][0]['image']) ?>" alt="">

        <div class="thumbnails">
            <?php 
            $first = true;
            foreach ($produit['images'] as $img): 
                $activeClass = $first ? 'active' : '';
            ?>
                <img src="/assets/img_produit/<?= htmlspecialchars($img['image']) ?>" 
                     class="thumb <?= $activeClass ?>" 
                     onclick="changeImage(this.src, this)">
            <?php 
                $first = false;
            endforeach; 
            ?>
        </div>
    </div>
     
    <div class='div_blok'>
            <form  method="POST" enctype="multipart/form-data">

        <section class='section section_width'>
                <div style="display: flex; width: 100%; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                    <section style="flex: 1; min-width: 200px;">
                        <p for="taille">Les tailles disponibles</p>
                        <select name="tailleSelect" id="taille" onchange="updateCouleurs()">
                            <option value="">Choisir une taille</option>
                            <?php foreach ($taille_couleurs as $taille => $couleurs): ?>
                                <option value="<?= htmlspecialchars($taille) ?>"><?= htmlspecialchars($taille) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </section>
                    <section style="width: 120px; min-width: 100px;">
                        <p for="quantite">Quantité :</p>
                        <input type="number" placeholder="Qté" value="1" min="1" name="quantiteSelect">
                    </section>
                </div>
                <div id="couleurs"></div>
        <input type="hidden" id="variant_id" name="variant_id">

                <div>
                  <p class="price">Prix : 
                    <span style=" <?php if($prix_promo > 0 ){echo'text-decoration: line-through; color:#dc0707ff;';} ?>" id="prix"></span>
                      <span id="reduction" class="reduction"></span>
                    <span id="prix_promo" style="color:#0e9804ff; font-weight:bold;"></span> 
                    </p>
                  <p>Stock disponible : <span id="quantite_max">-</span></p>
                </div>
        
        </section>
        <input onclick="ajouterAuPanier()" class="submit backNoir" type="submit" value="Acheter" name="acheter"> 
        <input class="submit backNoir" type="submit" value="Ajouter au panier" name="ajouteAuPanier"> 
            </form>
            <div style="margin-top: 2rem;"></div>
            <h1 class="descriptions">Descriptions</h1>
            <p class="descriptions"><?=$produit['description']?></p>
        </div>

        </section>




<div style=" margin-top: 7rem;" ></div>
</body>


<script>
const variantes = <?= json_encode($taille_couleurs) ?>;
const prix_globals = <?= $produit['prix_global'] ?>;
const prix_promo_global = <?= isset($prix_promo ) ? (int) $prix_promo : 'null' ?>;
const devise = <?=  (string) "'".$produit['devise']."'"  ?>;
   
if(prix_promo_global > 0){
    const montantReduction = prix_globals * (prix_promo_global / 100);
    const prixFinal = prix_globals - montantReduction;
    document.getElementById('prix').innerText = formatPrix(prix_globals) + ' ' + devise ;
    document.getElementById('reduction').innerText = '(-' + prix_promo_global + '%)';
    document.getElementById('prix_promo').innerText = formatPrix(prixFinal) + ' ' + devise;
}else{
    document.getElementById('prix').innerText = formatPrix(prix_globals) + ' ' + devise ;
}


function changeImage(src, element) {
    document.getElementById('mainImage').src = src;
    // Retirer la classe active de toutes les miniatures
    document.querySelectorAll('.thumb').forEach(thumb => {
        thumb.classList.remove('active');
    });
    // Ajouter la classe active à la miniature cliquée
    if (element) {
        element.classList.add('active');
    }
}

function formatPrix(p) {
    return new Intl.NumberFormat('fr-FR').format(p);
}
function updateCouleurs() {
    const taille = document.getElementById('taille').value;
    const container = document.getElementById('couleurs');
    container.innerHTML = '';

    // Réinitialise le prix et le stock
    document.getElementById('quantite_max').innerText = '-';
    document.getElementById('variant_id').value = '';

    if (!taille || !variantes[taille]) return;

    const groupe = document.createElement('div');
    groupe.className = 'color-group';

    variantes[taille].forEach((v, index) => {
        const label = document.createElement('label');
        label.className = 'color-label';
        label.style.cursor = 'pointer';
        label.title = v.couleur + ' (' + v.quantite + ' dispo)';

        // input de type radio
        const input = document.createElement('input');
        input.type = 'radio';
        input.name = 'idProductVariants';
        input.value = v.id;
        input.id = 'couleur_' + v.id;
        input.style.display = 'none';
        input.onclick = () => selectVariant(v);

        // couleur visuelle du bouton
        const span = document.createElement('span');
        span.style.backgroundColor = v.code;
        span.style.display = 'inline-block';
        span.style.width = '30px';
        span.style.height = '30px';
        span.style.borderRadius = '50%';
        span.style.border = '2px solid #ccc';
        span.style.verticalAlign = 'middle';

        // effet de sélection
        input.addEventListener('change', () => {
            document.querySelectorAll('.color-group span').forEach(s => s.style.borderColor = '#ccc');
            span.style.borderColor = '#000';
        });

        label.appendChild(input);
        label.appendChild(span);
        groupe.appendChild(label);
    });

    container.appendChild(groupe);
}


function selectVariant(v) {
    document.getElementById('variant_id').value = v.id;
    const prixPromo = v.prix_promo ?? prix_promo_global;
    
      if(prixPromo === 0){
           // si la variante a un prix > 0, on affiche son prix
   if (v.prix !== null && v.prix !== undefined && v.prix > 0) {
        document.getElementById('prix').innerText = formatPrix( v.prix ) + ' ' + devise;
    } else {
        document.getElementById('prix').innerText = formatPrix(prix_globals) + ' ' + devise ;
    }

    }else{
        const elReduction = document.getElementById('reduction');
        if (v.prix !== null && v.prix !== undefined && v.prix > 0){
            const montantReduction = v.prix * (prixPromo / 100);
            // Calcul du prix final
            const prixFinal = v.prix - montantReduction;
            document.getElementById('prix').innerText = formatPrix( v.prix ) + ' ' + devise;
            elReduction.innerText = '(-' + prixPromo + '%)';
            document.getElementById('prix_promo').innerText = formatPrix( prixFinal ) + ' ' + devise;
        }else{
             const montantReduction = prix_globals * (prixPromo / 100);
            // Calcul du prix final
            const prixFinal = prix_globals - montantReduction;
            document.getElementById('prix').innerText = formatPrix( prix_globals ) + ' ' + devise;
            elReduction.innerText = '(-' + prixPromo + '%)';
            document.getElementById('prix_promo').innerText = formatPrix( prixFinal ) + ' ' + devise;
        }
    console.log(prixPromo);

    }
    
     // On met toujours à jour la quantité, même si prix = 0
    document.getElementById('quantite_max').innerText = v.quantite ?? '-';
}

function ajouterAuPanier() {
    const idVariante = document.getElementById('variant_id').value;
    if (!idVariante) {
        alert('Veuillez choisir une taille et une couleur avant d’achater.');
        return;
    }
}

    // Maintenir les positions fixes lors de l'ouverture du clavier
    const navBare = document.querySelector('.nav_bare');
    const menuBarreBloc = document.querySelector('.menu_barre_bloc');
    const selectElements = document.querySelectorAll('select');
    const numberInputs = document.querySelectorAll('input[type="number"]');
    
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
    
    // Écouter les événements de focus/blur sur les inputs
    selectElements.forEach(select => {
        select.addEventListener('focus', function() {
            maintainFixedPositions();
            setTimeout(maintainFixedPositions, 100);
        });
        
        select.addEventListener('blur', function() {
            maintainFixedPositions();
        });
    });
    
    numberInputs.forEach(input => {
        input.addEventListener('focus', function() {
            maintainFixedPositions();
            setTimeout(maintainFixedPositions, 100);
        });
        
        input.addEventListener('blur', function() {
            maintainFixedPositions();
        });
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



