<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche d'articles</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1>Recherche d'articles</h1>
    
    <input type="text" id="searchInput" placeholder="Rechercher un article...">
    <button onclick="searchArticles()">Rechercher</button>
    
    <div id="resultsContainer"></div>
    
    <script>
            const searchTerm = document.getElementById('searchInput');

        function searchArticles(query = '') {
            axios.post('search_articles.php', { recherche: query })
                .then(function(response) {
                    displayResults(response.data);
                })
                .catch(function(error) {
                    console.error('Erreur:', error);
                    document.getElementById('resultsContainer').innerHTML = 
                        '<p>Une erreur est survenue lors de la recherche.</p>';
                });
        }
        
        function displayResults(articles) {
            const container = document.getElementById('resultsContainer');
            
            if (articles.length === 0) {
                container.innerHTML = '<p>Aucun article trouvé.</p>';
                return;
            }
            
            let html = '<div class="articles-grid">';
            
            articles.forEach(article => {
                html += `
                    <div class="article-card">
                        <img src="${article.image}" alt="${article.nom}" style="max-width: 200px;">
                        <h3>${article.nom}</h3>
                        <p>Prix: ${article.prix} €</p>
                        <p>${article.description}</p>
                    </div>
                `;
            });
            
            html += '</div>';
            container.innerHTML = html;
        }

      input.addEventListener('keyup', () => {
      const val = input.value.trim();
      fetchArticles(val);
    });

        // Charger tous les articles au démarrage
        window.onload = searchArticles;
    </script>
    
    <style>
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .article-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</body>
</html>




    <a href="" class='sskddjdj' >
                <img class="lvgkdjshjgh_img" src="public/asset/_img_page/${article.image}" alt="">
                <section>
                    <h1>${article.nom}</h1>
                    <p>${article.description}</p>
                    <h2>${article.prix} FCFA</h2>
                </section>
            </a>












# Recherche en Temps Réel avec Axios et PHP

Voici une implémentation complète pour une recherche en temps réel qui se déclenche à chaque frappe au clavier, avec gestion du délai pour éviter les requêtes excessives.

## 1. HTML/JavaScript (Frontend)

```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche en temps réel</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .article-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        #searchInput {
            padding: 10px;
            width: 300px;
            font-size: 16px;
        }
        .loading {
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Recherche d'articles en temps réel</h1>
    
    <input type="text" id="searchInput" placeholder="Tapez pour rechercher...">
    <div id="loadingIndicator" class="loading" style="display: none;">Recherche en cours...</div>
    
    <div id="resultsContainer"></div>
    
    <script>
        let timeoutId;
        
        document.getElementById('searchInput').addEventListener('input', function() {
            // Annule la requête précédente si elle n'a pas encore été envoyée
            clearTimeout(timeoutId);
            
            // Affiche l'indicateur de chargement
            document.getElementById('loadingIndicator').style.display = 'block';
            
            // Attend 300ms après la dernière frappe pour envoyer la requête
            timeoutId = setTimeout(() => {
                const searchTerm = this.value.trim();
                searchArticles(searchTerm);
            }, 300);
        });
        
        function searchArticles(searchTerm) {
            axios.post('search_realtime.php', { search: searchTerm })
                .then(function(response) {
                    displayResults(response.data);
                })
                .catch(function(error) {
                    console.error('Erreur:', error);
                    document.getElementById('resultsContainer').innerHTML = 
                        '<p>Une erreur est survenue lors de la recherche.</p>';
                })
                .finally(function() {
                    // Cache l'indicateur de chargement une fois la requête terminée
                    document.getElementById('loadingIndicator').style.display = 'none';
                });
        }
        
        function displayResults(articles) {
            const container = document.getElementById('resultsContainer');
            
            if (!articles || articles.length === 0) {
                container.innerHTML = '<p>Aucun article trouvé.</p>';
                return;
            }
            
            const html = `
                <div class="articles-grid">
                    ${articles.map(article => `
                        <div class="article-card">
                            <img src="${article.image || 'images/default.jpg'}" 
                                 alt="${article.nom}" 
                                 style="max-width: 200px;">
                            <h3>${article.nom}</h3>
                            <p>Prix: ${formatPrice(article.prix)}</p>
                            <p>${article.description || 'Pas de description disponible'}</p>
                        </div>
                    `).join('')}
                </div>
            `;
            
            container.innerHTML = html;
        }
        
        function formatPrice(price) {
            return price !== undefined 
                ? new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price)
                : 'Prix non disponible';
        }
        
        // Charger tous les articles au démarrage
        window.onload = function() {
            searchArticles('');
        };
    </script>
</body>
</html>
```

## 2. PHP (Backend - search_realtime.php)

```php
<?php
header('Content-Type: application/json');

// Configuration de la base de données
$dbHost = 'localhost';
$dbName = 'votre_base_de_donnees';
$dbUser = 'utilisateur';
$dbPass = 'motdepasse';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Récupération du terme de recherche
    $searchTerm = isset($_POST['search']) ? trim($_POST['search']) : '';
    
    // Construction de la requête
    $query = "SELECT id, nom, description, prix, image FROM articles";
    $params = [];
    
    if (!empty($searchTerm)) {
        $query .= " WHERE nom LIKE :search OR description LIKE :search";
        $params[':search'] = '%' . $searchTerm . '%';
    }
    
    // Limite les résultats pour les performances
    $query .= " LIMIT 50";
    
    // Exécution de la requête
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatage des résultats
    $formattedResults = array_map(function($article) {
        return [
            'id' => $article['id'],
            'nom' => $article['nom'],
            'description' => $article['description'],
            'prix' => $article['prix'],
            'image' => $article['image']
        ];
    }, $articles);
    
    echo json_encode($formattedResults);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de base de données: ' . $e->getMessage()]);
}
?>
```


    const input = document.getElementById('searchInput');
    const results = document.getElementById('results');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const erreur = document.getElementById('resdults');

          let timeoutId;
        
        document.getElementById('searchInput').addEventListener('input', function() {
            // Annule la requête précédente si elle n'a pas encore été envoyée
            clearTimeout(timeoutId);
            
            // Affiche l'indicateur de chargement
            document.getElementById('loadingIndicator').style.display = 'block';
            
            // Attend 300ms après la dernière frappe pour envoyer la requête
            timeoutId = setTimeout(() => {
                const val = this.value.trim();
                fetchArticles(val);
            }, 300);
        });


    function fetchArticles(val = '') {
      axios.post('../Kephale/controleur/api_article.php', { recherche: val })
        .then(res => {
          const data = res.data;
          displayResults(res.data);
        }
             ).catch(function(error) {
                    console.error('Erreur:', error);
                    erreur.innerHTML = 
                        '<p>Une erreur est survenue lors de la recherche.</p>';
                });
    
    }

    function displayResults(articles){
           if (articles.length === 0) {
                erreur.innerHTML = '<p>Aucun article trouvé.</p>';
                return;
            }

            for(article of articles){
                const nom = article.nom;
             results.innerHTML += `<a href="" class='sskddjdj'> <img class="lvgkdjshjgh_img" src="public/asset/img_article/${article.nom_image}" alt="">   <section>
                    <h1>${article.nom}</h1>
                    <p>${article.descriptions}</p>
                    <h2>${article.prix} FCFA</h2>
                </section></a>`            
            }

       //  loadingIndicator.innerHTML += `<div class="articles-grid">${articles.map(article => `${article.nom}`).join('')}</div>`;

    }

    // Charger tous les articles au démarrage
        window.onload = function() {
            fetchArticles('');
        };