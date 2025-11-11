CREATE TABLE colors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom TEXT,
    hex_code VARCHAR(100) NOT NULL,
    description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO colors (nom, hex_code, description) VALUES
('Motifs', '#00000001', 'Motifs vêtements'),
('Noir', '#000000', 'Couleur neutre et élégante'),
('Blanc', '#FFFFFF', 'Pureté et minimalisme'),
('Gris', '#808080', 'Neutre et moderne'),
('Gris clair', '#D3D3D3', 'Tonalité douce'),
('Gris foncé', '#404040', 'Élégant et discret'),

('Beige', '#F5F5DC', 'Naturel et chaleureux'),
('Crème', '#FFFDD0', 'Ton doux'),
('Ivoire', '#FFFFF0', 'Couleur claire élégante'),
('Marron', '#8B4513', 'Couleur terre'),
('Chocolat', '#5C3317', 'Brun foncé'),

('Rouge', '#FF0000', 'Passion et énergie'),
('Rouge foncé', '#8B0000', 'Profond et luxueux'),
('Bordeaux', '#800000', 'Classique et élégant'),
('Rose', '#FFC0CB', 'Doux et féminin'),
('Rose clair', '#FFB6C1', 'Tonalité pastel'),
('Rose vif', '#FF69B4', 'Mode et audacieux'),
('Fuchsia', '#FF00FF', 'Coloré et moderne'),

('Orange', '#FFA500', 'Chaleureux et dynamique'),
('Orange clair', '#FFD580', 'Ton doux'),
('Saumon', '#FA8072', 'Rose orangé'),
('Corail', '#FF7F50', 'Populaire en été'),
('Pêche', '#FFE5B4', 'Ton pastel'),

('Jaune', '#FFFF00', 'Éclatant et joyeux'),
('Jaune clair', '#FFFACD', 'Pastel doux'),
('Or', '#FFD700', 'Luxueux'),
('Moutarde', '#FFDB58', 'Tendance vintage'),

('Vert', '#008000', 'Naturel et équilibré'),
('Vert clair', '#90EE90', 'Doux et apaisant'),
('Vert foncé', '#006400', 'Élégant et profond'),
('Vert menthe', '#98FB98', 'Frais et doux'),
('Vert olive', '#808000', 'Nature et style'),
('Vert fluo', '#7FFF00', 'Couleur sportive'),
('Vert sapin', '#01796F', 'Tonalité naturelle'),

('Bleu', '#0000FF', 'Confiance et stabilité'),
('Bleu clair', '#ADD8E6', 'Apaisant'),
('Bleu ciel', '#87CEEB', 'Ton frais'),
('Bleu roi', '#4169E1', 'Classique et vibrant'),
('Bleu marine', '#000080', 'Élégant et sérieux'),
('Bleu turquoise', '#40E0D0', 'Tendance plage'),
('Bleu pétrole', '#005F6A', 'Moderne et profond'),

('Violet', '#800080', 'Mystérieux et chic'),
('Violet clair', '#D8BFD8', 'Pastel doux'),
('Lavande', '#E6E6FA', 'Couleur douce et apaisante'),
('Lilas', '#C8A2C8', 'Couleur romantique'),
('Prune', '#70193D', 'Sombre et raffiné'),

('Doré', '#DAA520', 'Ton luxe'),
('Argenté', '#C0C0C0', 'Métallique neutre'),
('Cuivré', '#B87333', 'Chaleureux et chic'),
('Bronze', '#CD7F32', 'Métallique brun'),

('Bleu gris', '#6699CC', 'Moderne et élégant'),
('Bleu jean', '#5D8AA8', 'Casual et tendance'),
('Bleu canard', '#0A516D', 'Tonalité profonde'),

('Vert d’eau', '#ADDFAD', 'Tonalité pastel'),
('Vert anis', '#B5E61D', 'Vif et frais'),
('Turquoise clair', '#AFEEEE', 'Apaisant'),

('Rouge brique', '#B22222', 'Tonalité terre'),
('Terracotta', '#E2725B', 'Tendance déco'),
('Sable', '#C2B280', 'Naturel et doux'),

('Blanc cassé', '#FAF9F6', 'Neutre élégant'),
('Gris perle', '#C0C0C0', 'Ton clair brillant'),
('Bleu pastel', '#AEC6CF', 'Doux et apaisant'),
('Vert pastel', '#77DD77', 'Tonalité douce'),
('Jaune pastel', '#FFF8DC', 'Clair et lumineux'),
('Rose pastel', '#FFD1DC', 'Couleur tendre'),
('Lavande pastel', '#E6E6FA', 'Détente et sérénité'),

('Bleu nuit', '#191970', 'Sombre et chic'),
('Bleu ardoise', '#6A5ACD', 'Moderne et élégant'),
('Rouge cerise', '#DE3163', 'Éclatant et tendance'),
('Rouge rubis', '#9B111E', 'Luxueux'),
('Rouge orangé', '#FF4500', 'Énergique'),

('Vert forêt', '#228B22', 'Naturel profond'),
('Vert kaki', '#C3B091', 'Militaire et mode'),
('Gris anthracite', '#2F4F4F', 'Sombre et design'),
('Blanc neige', '#FFFAFA', 'Pur et lumineux');
