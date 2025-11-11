<?php ; new html(); ?>

<body>
    <style>
:root{
--bg:#0f1724;
--card:#0b1220;
--muted:#9aa4b2;
--accent1:#7c3aed; /* purple */
--accent2:#06b6d4; /* teal */
--glass: rgba(255,255,255,0.04);
--glass-2: rgba(255,255,255,0.02);
--success:#10b981;
}
*{box-sizing:border-box}
body{
margin:0; font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
background: #06151fff ;
color:#e6eef8; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;
padding:48px 24px;
}
.container{max-width:1100px;margin:0 auto}
header{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:32px}
.brand{display:flex;gap:12px;align-items:center}
.logo{width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--accent1),var(--accent2));display:flex;align-items:center;justify-content:center;font-weight:800;color:white}
h1{font-size:20px;margin:0}
p.lead{margin:0;color:var(--muted)}

.switch{display:flex;gap:8px;align-items:center;background:var(--glass);padding:6px;border-radius:999px}
.switch button{background:transparent;border:0;color:var(--muted);padding:8px 12px;border-radius:999px;cursor:pointer}
.switch button.active{background:linear-gradient(90deg,var(--accent1),var(--accent2));color:white;box-shadow:0 6px 18px rgba(124,58,237,0.18)}

/* Pricing grid */
.grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
@media (max-width:1000px){.grid{grid-template-columns:repeat(2,1fr)}}
@media (max-width:560px){.grid{grid-template-columns:1fr}}

.card{ margin-bottom: 15px; background: #061826;padding:20px;border-radius:14px;box-shadow:0 6px 30px rgba(2,6,23,0.6);border:1px solid rgba(255,255,255,0.03);position:relative;overflow:hidden}
.ribbon{position:absolute;top:14px;right:-42px;transform:rotate(25deg);background:linear-gradient(90deg,var(--accent2),var(--accent1));padding:6px 72px;color:white;font-weight:700;font-size:12px;box-shadow:0 6px 18px rgba(7,18,36,0.6)}

.card h3{margin:0 0 6px 0;font-size:18px}
.price{font-size:28px;font-weight:700;margin:8px 0}
.period{font-size:12px;color:var(--muted)}
.features{margin:14px 0 18px 0;color:var(--muted);line-height:1.6}
.cta{display:flex;gap:8px}
.btn{flex:1;padding:10px 12px;border-radius:10px;border:0;cursor:pointer;font-weight:700}
.btn.primary{background:linear-gradient(90deg,var(--accent1),var(--accent2));color:white;box-shadow:0 10px 30px rgba(124,58,237,0.14)}
.btn.ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--muted)}

.small{font-size:13px;color:var(--muted)}

/* special styles */
.starter{border:1px solid rgba(255,255,255,0.02)}
.popular{transform:scale(1.04);border:1px solid rgba(124,58,237,0.18)}

/* foot */
footer{margin-top:28px;color:var(--muted);font-size:13px;text-align:center}

/* badges */
.badge{display:inline-flex;align-items:center;gap:8px;padding:6px 10px;border-radius:999px;font-weight:600;font-size:12px}
.badge.free{background:rgba(16,185,129,0.12);color:var(--success);border:1px solid rgba(16,185,129,0.14)}

/* list */
ul.features-list{list-style:none;padding:0;margin:0}
ul.features-list li{ font-size: 0.8rem; display:flex;gap:10px;align-items:flex-start;margin-bottom:5px}
ul.features-list svg{flex:0 0 18px;margin-top:3px}

    </style>
    <?php ; new Retoure('/offre'); ?>

     <!-- 
    <div style=" margin-bottom: 3rem;"></div>

    <div class='div_blok'>
 Premium 
        <section class='section'>
            <h1 style="font-size: 1rem;">Abonnement Starter (Débutant)</h1>
            <p>Idéal pour : les petits vendeurs qui débutent</p>
                <h3>15.000 FCFA / mois</h3>
            <div style=" margin-bottom: 1.5rem;"></div>
             <a class='a_linc_botton' href="/user/paiement/Standare">15.000 FCFA / Mois</a>
            <div style=" margin-bottom: 1rem;"></div>
        </section>
    </div>
    
    <div style=" margin-bottom: 2rem;"></div>
    -->
    <div class="container">
<section class="card starter">
<div class="badge free">Gratuit</div>
<h3>Starter</h3>
<div class="price">0 Fcfa <span class="period">/ mois</span></div>
<p class="small">Idéal pour tester la plateforme et vendre quelques produits.</p>
<ul class="features-list features">
<li>- Jusqu'à 10 produits</li>
<li>- 1 image par produit</li>
<li>- Commission: 10%</li>
</ul>
<div class="cta">
<a href="/offre/paiement/Starter" class="btn primary">S'abonner</a>
</div>
</section>

<section class="card">
<h3>Standard</h3>
<div class="price">5 000 Fcfa <span class="period">/ mois</span></div>
<p class="small">Pour les vendeurs réguliers qui veulent plus de visibilité.</p>
<ul class="features-list features">
<li>- Jusqu'à 50 produits</li>
<li>- Images illimitées</li>
<li>- Commission: 7%</li>
<li>- Assistance prioritaire</li>
</ul>
<div class="cta">
<a href="/offre/paiement/Standard" class="btn primary">S'abonner</a>
<a href="#" class="btn ghost">Contact</a>
</div>
</section>

<section class="card popular">
<div class="ribbon">Le plus choisi</div>
<h3>Pro</h3>
<div class="price">10 000 Fcfa <span class="period">/ mois</span></div>
<p class="small">Pour boutiques et petites marques qui veulent performer.</p>
<ul class="features-list features">
<li>- Produits illimités</li>
<li>- Commission: 5%</li>
<li>- Mises en avant automatiques</li>
<li>- Ventes à l'étranger en provenance du Mali.</li>
<li>- PayPal comme mode de paiement.</li>
</ul>
<div class="cta">
<a href="/offre/paiement/Pro" class="btn primary">S'abonner</a>
<a href="#" class="btn ghost">Contact</a>
</div>
</section>

<section class="card">
<h3>Premium</h3>
<div class="price">25 000 Fcfa <span class="period">/ mois</span></div>
<p class="small">Solutions sur-mesure pour grandes boutiques et marques.</p>
<ul class="features-list features">
<li>- Produits illimités + multi-boutiques</li>
<li>- Commission: 3%</li>
<li>- Page boutique publiable</li>
<li>- Assistance dédiée 24/7</li>
<li>- Ventes à l'étranger en provenance du Mali.</li>
<li>- PayPal comme mode de paiement.</li>
</ul>
<div class="cta">
<a href="/offre/paiement/Premium" class="btn primary">Démo</a>
<a href="#" class="btn ghost">Contact</a>
</div>
</section>

</div>
</main>

<footer>
Prix affichés en FCFA. Les tarifs annuels proposent l'équivalent de 10 mois (2 mois off). Les commissions s'appliquent sur chaque vente.
</footer>
</div>
</body>