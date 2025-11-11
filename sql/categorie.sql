CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    parent_id INT DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categories (nom, description) VALUES
('Mode', 'Vêtements et accessoires de mode'),
('Électronique', 'Appareils électroniques et gadgets'),
('Maison & Jardin', 'Articles pour la maison et le jardin'),
('Beauté & Santé', 'Produits cosmétiques et soins personnels'),
('Sport & Loisirs', 'Articles de sport et de plein air'),
('Bébé & Enfants', 'Produits pour bébé et enfants'),
('Auto & Moto', 'Accessoires automobiles et motos'),
('Alimentation', 'Produits alimentaires et boissons'),
('Livres', 'Livres et magazines'),
('Animaux', 'Produits pour animaux domestiques');

SET @mode_id = (SELECT id FROM categories WHERE nom = 'Mode');

INSERT INTO categories (nom, description, parent_id) VALUES
('Homme', 'Mode masculine', @mode_id),
('Femme', 'Mode féminine', @mode_id),
('Enfant', 'Mode pour enfants', @mode_id),
('Chaussures', 'Chaussures de tous types', @mode_id),
('Sacs & Accessoires', 'Sacs, ceintures, bijoux...', @mode_id);

SET @elec_id = (SELECT id FROM categories WHERE nom = 'Électronique');

INSERT INTO categories (nom, description, parent_id) VALUES
('Téléphones', 'Smartphones et accessoires', @elec_id),
('Ordinateurs', 'PC, laptops et périphériques', @elec_id),
('TV & Audio', 'Télévisions, casques, enceintes...', @elec_id),
('Gaming', 'Consoles et accessoires de jeux vidéo', @elec_id);

SET @elec_id = (SELECT id FROM categories WHERE nom = 'Électronique');

INSERT INTO categories (nom, description, parent_id) VALUES
('Téléphones', 'Smartphones et accessoires', @elec_id),
('Ordinateurs', 'PC, laptops et périphériques', @elec_id),
('TV & Audio', 'Télévisions, casques, enceintes...', @elec_id),
('Gaming', 'Consoles et accessoires de jeux vidéo', @elec_id);

SET @maison_id = (SELECT id FROM categories WHERE nom = 'Maison & Jardin');

INSERT INTO categories (nom, description, parent_id) VALUES
('Mobilier', 'Meubles et décoration', @maison_id),
('Cuisine', 'Ustensiles et appareils de cuisine', @maison_id),
('Électroménager', 'Appareils pour la maison', @maison_id),
('Bricolage', 'Outils et matériaux de construction', @maison_id);

SET @beaute_id = (SELECT id FROM categories WHERE nom = 'Beauté & Santé');

INSERT INTO categories (nom, description, parent_id) VALUES
('Soins du visage', 'Crèmes, masques, nettoyants...', @beaute_id),
('Maquillage', 'Produits de maquillage', @beaute_id),
('Parfums', 'Parfums et eaux de toilette', @beaute_id),
('Santé', 'Produits de bien-être et santé', @beaute_id);

SET @sport_id = (SELECT id FROM categories WHERE nom = 'Sport & Loisirs');

INSERT INTO categories (nom, description, parent_id) VALUES
('Fitness', 'Équipements et vêtements de sport', @sport_id),
('Vélos', 'Bicyclette et accessoires', @sport_id),
('Camping', 'Équipement de camping et randonnée', @sport_id),
('Jeux de plein air', 'Articles de loisir extérieur', @sport_id);

SET @bebe_id = (SELECT id FROM categories WHERE nom = 'Bébé & Enfants');

INSERT INTO categories (nom, description, parent_id) VALUES
('Jouets', 'Jeux et jouets', @bebe_id),
('Puériculture', 'Produits pour les nourrissons', @bebe_id),
('Vêtements bébé', 'Habits pour nourrissons et enfants', @bebe_id);

SET @auto_id = (SELECT id FROM categories WHERE nom = 'Auto & Moto');

INSERT INTO categories (nom, description, parent_id) VALUES
('Pièces détachées', 'Pièces et composants pour véhicules', @auto_id),
('Accessoires voiture', 'Produits pour l’entretien automobile', @auto_id),
('Équipement moto', 'Casques et équipements motards', @auto_id);

SET @alim_id = (SELECT id FROM categories WHERE nom = 'Alimentation');

INSERT INTO categories (nom, description, parent_id) VALUES
('Épicerie', 'Produits secs et conserves', @alim_id),
('Boissons', 'Eaux, jus, sodas, alcools', @alim_id),
('Produits frais', 'Lait, viande, légumes...', @alim_id);

SET @anim_id = (SELECT id FROM categories WHERE nom = 'Animaux');

INSERT INTO categories (nom, description, parent_id) VALUES
('Chiens', 'Produits pour chiens', @anim_id),
('Chats', 'Produits pour chats', @anim_id),
('Oiseaux', 'Produits pour oiseaux domestiques', @anim_id),
('Poissons', 'Aquariums et accessoires', @anim_id);