-- Créer la base
CREATE DATABASE IF NOT EXISTS ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ecommerce;

-- 1. Table des catégories
CREATE TABLE categories (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    parent_id BIGINT DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES categories(id)
);

-- 2. Table des marques
CREATE TABLE marques (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- 3. Table des vendeurs
CREATE TABLE vendeurs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    statut ENUM('actif', 'suspendu') DEFAULT 'actif'
);

-- 4. Table des clients
CREATE TABLE clients (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 5. Table des articles
CREATE TABLE articles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    ancien_prix DECIMAL(10, 2),
    en_stock BOOLEAN DEFAULT TRUE,
    quantite_stock INT DEFAULT 0,

    categorie_id BIGINT,
    marque_id BIGINT,
    vendeur_id BIGINT,

    rating DECIMAL(2, 1),
    nb_avis INT DEFAULT 0,

    statut ENUM('brouillon', 'publie', 'archive') DEFAULT 'brouillon',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_mise_a_jour DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (categorie_id) REFERENCES categories(id),
    FOREIGN KEY (marque_id) REFERENCES marques(id),
    FOREIGN KEY (vendeur_id) REFERENCES vendeurs(id)
);

-- 6. Table des images d’articles
CREATE TABLE images_articles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    article_id BIGINT,
    url_image VARCHAR(500),
    ordre INT DEFAULT 1,
    FOREIGN KEY (article_id) REFERENCES articles(id)
);

-- 7. Table des avis clients
CREATE TABLE avis (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    article_id BIGINT,
    client_id BIGINT,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    date_avis DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

-- 8. Table des attributs personnalisés (ex: taille, couleur)
CREATE TABLE attributs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- 9. Valeurs des attributs (ex: M, L, Rouge)
CREATE TABLE valeurs_attributs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    attribut_id BIGINT,
    valeur VARCHAR(100),
    FOREIGN KEY (attribut_id) REFERENCES attributs(id)
);

-- 10. Association des articles avec les attributs
CREATE TABLE articles_attributs (
    article_id BIGINT,
    valeur_attribut_id BIGINT,
    PRIMARY KEY (article_id, valeur_attribut_id),
    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (valeur_attribut_id) REFERENCES valeurs_attributs(id)
);

-- 11. Table des paniers
CREATE TABLE paniers (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    client_id BIGINT,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

-- 12. Lignes de panier
CREATE TABLE lignes_panier (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    panier_id BIGINT,
    article_id BIGINT,
    quantite INT DEFAULT 1,
    FOREIGN KEY (panier_id) REFERENCES paniers(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
);

-- 13. Table des commandes
CREATE TABLE commandes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    client_id BIGINT,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en_attente', 'expedie', 'livre', 'annule') DEFAULT 'en_attente',
    montant_total DECIMAL(10, 2),
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

-- 14. Lignes de commande
CREATE TABLE lignes_commande (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    commande_id BIGINT,
    article_id BIGINT,
    quantite INT,
    prix_unitaire DECIMAL(10, 2),
    FOREIGN KEY (commande_id) REFERENCES commandes(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
);
