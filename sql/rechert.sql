--  1. Rechercher des articles par mot-clé (dans le titre ou description)
SELECT * FROM articles
WHERE statut = 'publie'
  AND (titre LIKE '%samsung%' OR description LIKE '%samsung%');

-- 2. Rechercher avec plusieurs filtres dynamiques (prix, catégorie, marque, stock)
SELECT * FROM articles
WHERE statut = 'publie'
  AND (titre LIKE '%laptop%' OR description LIKE '%laptop%')
  AND categorie_id = 3             -- exemple : Catégorie = "Informatique"
  AND marque_id = 5                -- exemple : Marque = "HP"
  AND prix BETWEEN 500 AND 1500    -- filtre prix
  AND en_stock = TRUE;

-- 3. Tri par prix croissant
ORDER BY prix ASC
ORDER BY rating DESC
ORDER BY date_creation DESC
-- Tri aléatoire (pour suggestions mélangées) Coûteux sur grandes tables
ORDER BY RAND()
LIMIT 20;

-- 4. Requête complète avec tous les filtres combinés

SELECT a.*, c.nom AS categorie, m.nom AS marque
FROM articles a
LEFT JOIN categories c ON a.categorie_id = c.id
LEFT JOIN marques m ON a.marque_id = m.id
WHERE a.statut = 'publie'
  AND (a.titre LIKE '%chaussure%' OR a.description LIKE '%chaussure%')
  AND (a.categorie_id = 2 OR 2 IS NULL)        -- NULL = ignorer le filtre
  AND (a.marque_id = 4 OR 4 IS NULL)
  AND (a.prix BETWEEN 50 AND 200 OR (50 IS NULL AND 200 IS NULL))
  AND a.en_stock = TRUE
ORDER BY a.rating DESC
LIMIT 20;
--  Ce modèle te permet d’insérer dynamiquement les valeurs ou NULL si un filtre n’est pas appliqué.

-- 5. Produits avec promotions uniquement (prix < ancien_prix)
SELECT * FROM articles
WHERE statut = 'publie'
  AND ancien_prix IS NOT NULL
  AND prix < ancien_prix;
-- 6. Articles populaires (avec beaucoup d’avis)
SELECT * FROM articles
WHERE statut = 'publie'
ORDER BY nb_avis DESC
LIMIT 20;

-- 7. Rechercher par attributs (ex : taille = M, couleur = Rouge)
SELECT a.*
FROM articles a
JOIN articles_attributs aa ON a.id = aa.article_id
JOIN valeurs_attributs va ON aa.valeur_attribut_id = va.id
JOIN attributs at ON va.attribut_id = at.id
WHERE a.statut = 'publie'
  AND ((at.nom = 'taille' AND va.valeur = 'M') 
       OR (at.nom = 'couleur' AND va.valeur = 'Rouge'))
GROUP BY a.id
HAVING COUNT(DISTINCT at.nom) = 2;

--  1. Recherche Full-Text MySQL (rapide, plus précise que LIKE)
-- A. Ajouter un index FULLTEXT :
ALTER TABLE articles
ADD FULLTEXT(titre, description);
-- MySQL Full-Text fonctionne en InnoDB depuis MySQL 5.6+ (UTF8MB4 recommandé)

--B. Requête MATCH ... AGAINST (en mode naturel) :
SELECT *
FROM articles
WHERE statut = 'publie'
  AND MATCH(titre, description) AGAINST('+iphone -étui' IN NATURAL LANGUAGE MODE);
-- Résultat : recherche “iphone” mais exclut “étui”
-- Très utile pour recherches par mots clés + filtres

-- C. Mode booléen (plus puissant) 
SELECT *
FROM articles
WHERE MATCH(titre, description)
      AGAINST('+samsung +(galaxy note)' IN BOOLEAN MODE);
--  +mot = doit contenir
--  -mot = doit exclure
--  () = groupe de mots
--  "..." = correspondance exacte

-- D. Combiner avec d’autres filtres :
SELECT *
FROM articles
WHERE statut = 'publie'
  AND en_stock = TRUE
  AND prix BETWEEN 100 AND 1000
  AND MATCH(titre, description) AGAINST('+laptop +hp' IN BOOLEAN MODE)
ORDER BY rating DESC
LIMIT 20;
-- 2. Requête Elasticsearch-like en SQL (manuellement simulée)
-- Évidemment, MySQL ≠ Elasticsearch, mais tu peux simuler un comportement “à la Elastic” avec des scores de pertinence pondérés.
-- Exemple : Recherche pondérée sur titre, description, et marque
SELECT a.*,
       (
         (MATCH(a.titre) AGAINST('laptop') * 3) +
         (MATCH(a.description) AGAINST('laptop') * 1.5) +
         (MATCH(m.nom) AGAINST('laptop') * 1)
       ) AS score_pertinence
FROM articles a
JOIN marques m ON a.marque_id = m.id
WHERE a.statut = 'publie'
  AND MATCH(a.titre, a.description) AGAINST('laptop')
ORDER BY score_pertinence DESC
LIMIT 20;
-- Ce genre de “scoring custom” imite le ranking d’un moteur comme Elasticsearch.