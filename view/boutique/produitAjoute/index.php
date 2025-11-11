<?php new html(); ?>
<?php
if($ProduitCode !== true){
header('Location: /boutique/produit');
}
use Middleware\SecurityMiddleware;
use Lib\Data;
//use PDO;
$pdo = Data::data();

// Taille max upload (octets) => 5 Mo
define('MAX_FILE_SIZE', 5 * 1024 * 1024);
$allowedMime = ['image/jpeg','image/png','image/gif','image/webp'];
$uploadDir = __DIR__ . '../../../../assets/img_produit/';

// --- Charger catégories / tailles / couleurs -------------------
//$categories = $pdo->query("SELECT id, nom as name FROM categories ORDER BY id")->fetchAll();
//
//$sizes = $pdo->query("SELECT id, categorie, nom AS size_code FROM taille ORDER BY id")->fetchAll();
//$colors = $pdo->query("SELECT id, nom AS color_name FROM colors ORDER BY id")->fetchAll();
//var_dump($colors);
$categories = array(
    // 🧥 Mode
    array("id" => 1, "name" => "Mode"),
    array("id" => 11, "name" => "Homme", "parent_id" => 1),
    array("id" => 12, "name" => "Femme", "parent_id" => 1),
    array("id" => 13, "name" => "Enfant", "parent_id" => 1),
    array("id" => 14, "name" => "Chaussures", "parent_id" => 1),
    array("id" => 15, "name" => "Sacs & Accessoires", "parent_id" => 1),

    // 💻 Électronique
    array("id" => 2, "name" => "Électronique"),
    array("id" => 16, "name" => "Téléphones", "parent_id" => 2),
    array("id" => 17, "name" => "Ordinateurs", "parent_id" => 2),
    array("id" => 18, "name" => "TV & Audio", "parent_id" => 2),
    array("id" => 19, "name" => "Gaming", "parent_id" => 2),

    // 🏡 Maison & Jardin
    array("id" => 3, "name" => "Maison & Jardin"),
    array("id" => 20, "name" => "Mobilier", "parent_id" => 3),
    array("id" => 21, "name" => "Cuisine", "parent_id" => 3),
    array("id" => 22, "name" => "Électroménager", "parent_id" => 3),
    array("id" => 23, "name" => "Bricolage", "parent_id" => 3),

    // 💅 Beauté & Santé
    array("id" => 4, "name" => "Beauté & Santé"),
    array("id" => 24, "name" => "Soins du visage", "parent_id" => 4),
    array("id" => 25, "name" => "Maquillage", "parent_id" => 4),
    array("id" => 26, "name" => "Parfums", "parent_id" => 4),
    array("id" => 27, "name" => "Santé", "parent_id" => 4),

    // 🏋️ Sport & Loisirs
    array("id" => 5, "name" => "Sport & Loisirs"),
    array("id" => 28, "name" => "Fitness", "parent_id" => 5),
    array("id" => 29, "name" => "Vélos", "parent_id" => 5),
    array("id" => 30, "name" => "Camping", "parent_id" => 5),
    array("id" => 31, "name" => "Jeux de plein air", "parent_id" => 5),

    // 👶 Bébé & Enfants
    array("id" => 6, "name" => "Bébé & Enfants"),
    array("id" => 32, "name" => "Jouets", "parent_id" => 6),
    array("id" => 33, "name" => "Puériculture", "parent_id" => 6),
    array("id" => 34, "name" => "Vêtements bébé", "parent_id" => 6),

    // 🚗 Auto & Moto
    array("id" => 7, "name" => "Auto & Moto"),
    array("id" => 35, "name" => "Pièces détachées", "parent_id" => 7),
    array("id" => 36, "name" => "Accessoires voiture", "parent_id" => 7),
    array("id" => 37, "name" => "Équipement moto", "parent_id" => 7),

    // 🍞 Alimentation
    array("id" => 8, "name" => "Alimentation"),
    array("id" => 38, "name" => "Épicerie", "parent_id" => 8),
    array("id" => 39, "name" => "Boissons", "parent_id" => 8),
    array("id" => 40, "name" => "Produits frais", "parent_id" => 8),

    // 📚 Livres
    array("id" => 9, "name" => "Livres"),
    array("id" => 41, "name" => "Romans", "parent_id" => 9),
    array("id" => 42, "name" => "BD & Manga", "parent_id" => 9),
    array("id" => 43, "name" => "Livres scolaires", "parent_id" => 9),

    // 🐶 Animaux
    array("id" => 10, "name" => "Animaux"),
    array("id" => 44, "name" => "Chiens", "parent_id" => 10),
    array("id" => 45, "name" => "Chats", "parent_id" => 10),
    array("id" => 46, "name" => "Oiseaux", "parent_id" => 10),
    array("id" => 47, "name" => "Poissons", "parent_id" => 10),
);

// Convertir le tableau PHP en JSON pour l'utiliser dans JS
$jsonCategories = json_encode($categories);

$sizes = array(
    array("id" => 1, "categorie" => "Taille", "size_code" => "Taille standard"),

    // 🔹 Tailles standards (universelles)
    array("id" => 2, "categorie" => "Vêtements", "size_code" => "XS"),
    array("id" => 3, "categorie" => "Vêtements", "size_code" => "S"),
    array("id" => 4, "categorie" => "Vêtements", "size_code" => "M"),
    array("id" => 5, "categorie" => "Vêtements", "size_code" => "L"),
    array("id" => 6, "categorie" => "Vêtements", "size_code" => "XL"),
    array("id" => 7, "categorie" => "Vêtements", "size_code" => "XXL"),
    array("id" => 8, "categorie" => "Vêtements", "size_code" => "XXXL"),

    // 🔹 Tailles numériques (Europe)
    array("id" => 9, "categorie" => "Vêtements", "size_code" => "34"),
    array("id" => 10, "categorie" => "Vêtements", "size_code" => "36"),
    array("id" => 11, "categorie" => "Vêtements", "size_code" => "38"),
    array("id" => 12, "categorie" => "Vêtements", "size_code" => "40"),
    array("id" => 13, "categorie" => "Vêtements", "size_code" => "42"),
    array("id" => 14, "categorie" => "Vêtements", "size_code" => "44"),
    array("id" => 15, "categorie" => "Vêtements", "size_code" => "46"),

    // 🔹 Tailles US / UK
    array("id" => 16, "categorie" => "Vêtements", "size_code" => "US XS"),
    array("id" => 17, "categorie" => "Vêtements", "size_code" => "US S"),
    array("id" => 18, "categorie" => "Vêtements", "size_code" => "US M"),
    array("id" => 19, "categorie" => "Vêtements", "size_code" => "US L"),
    array("id" => 20, "categorie" => "Vêtements", "size_code" => "US XL"),
    array("id" => 21, "categorie" => "Vêtements", "size_code" => "UK 8"),
    array("id" => 22, "categorie" => "Vêtements", "size_code" => "UK 10"),
    array("id" => 23, "categorie" => "Vêtements", "size_code" => "UK 12"),
    array("id" => 24, "categorie" => "Vêtements", "size_code" => "UK 14"),

    // 🔹 Tailles de chaussures (EU)
    array("id" => 25, "categorie" => "Chaussures", "size_code" => "35"),
    array("id" => 26, "categorie" => "Chaussures", "size_code" => "36"),
    array("id" => 27, "categorie" => "Chaussures", "size_code" => "37"),
    array("id" => 28, "categorie" => "Chaussures", "size_code" => "38"),
    array("id" => 29, "categorie" => "Chaussures", "size_code" => "39"),
    array("id" => 30, "categorie" => "Chaussures", "size_code" => "40"),
    array("id" => 31, "categorie" => "Chaussures", "size_code" => "41"),
    array("id" => 32, "categorie" => "Chaussures", "size_code" => "42"),
    array("id" => 33, "categorie" => "Chaussures", "size_code" => "43"),
    array("id" => 34, "categorie" => "Chaussures", "size_code" => "44"),
    array("id" => 35, "categorie" => "Chaussures", "size_code" => "45"),
    array("id" => 36, "categorie" => "Chaussures", "size_code" => "46"),
    array("id" => 37, "categorie" => "Chaussures", "size_code" => "47"),

    // 🔹 Tailles de chaussures (US & UK)
    array("id" => 38, "categorie" => "Chaussures", "size_code" => "US 6"),
    array("id" => 39, "categorie" => "Chaussures", "size_code" => "US 7"),
    array("id" => 40, "categorie" => "Chaussures", "size_code" => "US 8"),
    array("id" => 41, "categorie" => "Chaussures", "size_code" => "US 9"),
    array("id" => 42, "categorie" => "Chaussures", "size_code" => "US 10"),
    array("id" => 43, "categorie" => "Chaussures", "size_code" => "US 11"),
    array("id" => 44, "categorie" => "Chaussures", "size_code" => "UK 5"),
    array("id" => 45, "categorie" => "Chaussures", "size_code" => "UK 6"),
    array("id" => 46, "categorie" => "Chaussures", "size_code" => "UK 7"),
    array("id" => 47, "categorie" => "Chaussures", "size_code" => "UK 8"),

    // 🔹 Tailles de sous-vêtements et lingerie
    array("id" => 48, "categorie" => "Sous-vêtements", "size_code" => "85A"),
    array("id" => 49, "categorie" => "Sous-vêtements", "size_code" => "90B"),
    array("id" => 50, "categorie" => "Sous-vêtements", "size_code" => "95C"),
    array("id" => 51, "categorie" => "Sous-vêtements", "size_code" => "100D"),
    array("id" => 52, "categorie" => "Sous-vêtements", "size_code" => "105E"),
    array("id" => 53, "categorie" => "Sous-vêtements", "size_code" => "T1"),
    array("id" => 54, "categorie" => "Sous-vêtements", "size_code" => "T2"),
    array("id" => 55, "categorie" => "Sous-vêtements", "size_code" => "T3"),
    array("id" => 56, "categorie" => "Sous-vêtements", "size_code" => "T4"),

    // 🔹 Tailles enfants
    array("id" => 57, "categorie" => "Bébé & Enfants", "size_code" => "0-3 mois"),
    array("id" => 58, "categorie" => "Bébé & Enfants", "size_code" => "3-6 mois"),
    array("id" => 59, "categorie" => "Bébé & Enfants", "size_code" => "6-9 mois"),
    array("id" => 60, "categorie" => "Bébé & Enfants", "size_code" => "9-12 mois"),
    array("id" => 61, "categorie" => "Bébé & Enfants", "size_code" => "12-18 mois"),
    array("id" => 62, "categorie" => "Bébé & Enfants", "size_code" => "2 ans"),
    array("id" => 63, "categorie" => "Bébé & Enfants", "size_code" => "3 ans"),
    array("id" => 64, "categorie" => "Bébé & Enfants", "size_code" => "4 ans"),
    array("id" => 65, "categorie" => "Bébé & Enfants", "size_code" => "5 ans"),
    array("id" => 66, "categorie" => "Bébé & Enfants", "size_code" => "6 ans"),
    array("id" => 67, "categorie" => "Bébé & Enfants", "size_code" => "8 ans"),
    array("id" => 68, "categorie" => "Bébé & Enfants", "size_code" => "10 ans"),
    array("id" => 69, "categorie" => "Bébé & Enfants", "size_code" => "12 ans"),
    array("id" => 70, "categorie" => "Bébé & Enfants", "size_code" => "14 ans"),
    array("id" => 71, "categorie" => "Bébé & Enfants", "size_code" => "16 ans"),

    // 🔹 Tailles d’articles de sport
    array("id" => 72, "categorie" => "Sport & Loisirs", "size_code" => "Petit"),
    array("id" => 73, "categorie" => "Sport & Loisirs", "size_code" => "Moyen"),
    array("id" => 74, "categorie" => "Sport & Loisirs", "size_code" => "Large"),
    array("id" => 75, "categorie" => "Sport & Loisirs", "size_code" => "Très large"),
    array("id" => 76, "categorie" => "Sport & Loisirs", "size_code" => "Très très large"),
    array("id" => 77, "categorie" => "Sport & Loisirs", "size_code" => "Taille unique"),

    // 🔹 Tailles accessoires / bagagerie
    array("id" => 78, "categorie" => "Accessoires", "size_code" => "Petit"),
    array("id" => 79, "categorie" => "Accessoires", "size_code" => "Moyen"),
    array("id" => 80, "categorie" => "Accessoires", "size_code" => "Grand"),
    array("id" => 81, "categorie" => "Accessoires", "size_code" => "XL")
);

$colors = array(
    array("id" => 1, "color_name" => "Motifs"),
    array("id" => 2, "color_name" => "Noir"),
    array("id" => 3, "color_name" => "Blanc"),
    array("id" => 4, "color_name" => "Gris"),
    array("id" => 5, "color_name" => "Gris clair"),
    array("id" => 6, "color_name" => "Gris foncé"),
    array("id" => 7, "color_name" => "Beige"),
    array("id" => 8, "color_name" => "Crème"),
    array("id" => 9, "color_name" => "Ivoire"),
    array("id" => 10, "color_name" => "Marron"),
    array("id" => 11, "color_name" => "Chocolat"),
    array("id" => 12, "color_name" => "Rouge"),
    array("id" => 13, "color_name" => "Rouge foncé"),
    array("id" => 14, "color_name" => "Bordeaux"),
    array("id" => 15, "color_name" => "Rose"),
    array("id" => 16, "color_name" => "Rose clair"),
    array("id" => 17, "color_name" => "Rose vif"),
    array("id" => 18, "color_name" => "Fuchsia"),
    array("id" => 19, "color_name" => "Orange"),
    array("id" => 20, "color_name" => "Orange clair"),
    array("id" => 21, "color_name" => "Saumon"),
    array("id" => 22, "color_name" => "Corail"),
    array("id" => 23, "color_name" => "Pêche"),
    array("id" => 24, "color_name" => "Jaune"),
    array("id" => 25, "color_name" => "Jaune clair"),
    array("id" => 26, "color_name" => "Or"),
    array("id" => 27, "color_name" => "Moutarde"),
    array("id" => 28, "color_name" => "Vert"),
    array("id" => 29, "color_name" => "Vert clair"),
    array("id" => 30, "color_name" => "Vert foncé"),
    array("id" => 31, "color_name" => "Vert menthe"),
    array("id" => 32, "color_name" => "Vert olive"),
    array("id" => 33, "color_name" => "Vert fluo"),
    array("id" => 34, "color_name" => "Vert sapin"),
    array("id" => 35, "color_name" => "Bleu"),
    array("id" => 36, "color_name" => "Bleu clair"),
    array("id" => 37, "color_name" => "Bleu ciel"),
    array("id" => 38, "color_name" => "Bleu roi"),
    array("id" => 39, "color_name" => "Bleu marine"),
    array("id" => 40, "color_name" => "Bleu turquoise"),
    array("id" => 41, "color_name" => "Bleu pétrole"),
    array("id" => 42, "color_name" => "Violet"),
    array("id" => 43, "color_name" => "Violet clair"),
    array("id" => 44, "color_name" => "Lavande"),
    array("id" => 45, "color_name" => "Lilas"),
    array("id" => 46, "color_name" => "Prune"),
    array("id" => 47, "color_name" => "Doré"),
    array("id" => 48, "color_name" => "Argenté"),
    array("id" => 49, "color_name" => "Cuivré"),
    array("id" => 50, "color_name" => "Bronze"),
    array("id" => 51, "color_name" => "Bleu gris"),
    array("id" => 52, "color_name" => "Bleu jean"),
    array("id" => 53, "color_name" => "Bleu canard"),
    array("id" => 54, "color_name" => "Vert d’eau"),
    array("id" => 55, "color_name" => "Vert anis"),
    array("id" => 56, "color_name" => "Turquoise clair"),
    array("id" => 57, "color_name" => "Rouge brique"),
    array("id" => 58, "color_name" => "Terracotta"),
    array("id" => 59, "color_name" => "Sable"),
    array("id" => 60, "color_name" => "Blanc cassé"),
    array("id" => 61, "color_name" => "Gris perle"),
    array("id" => 62, "color_name" => "Bleu pastel"),
    array("id" => 63, "color_name" => "Vert pastel"),
    array("id" => 64, "color_name" => "Jaune pastel"),
    array("id" => 65, "color_name" => "Rose pastel"),
    array("id" => 66, "color_name" => "Lavande pastel"),
    array("id" => 67, "color_name" => "Bleu nuit"),
    array("id" => 68, "color_name" => "Bleu ardoise"),
    array("id" => 69, "color_name" => "Rouge cerise"),
    array("id" => 70, "color_name" => "Rouge rubis"),
    array("id" => 71, "color_name" => "Rouge orangé"),
    array("id" => 72, "color_name" => "Vert forêt"),
    array("id" => 73, "color_name" => "Vert kaki"),
    array("id" => 74, "color_name" => "Gris anthracite"),
    array("id" => 75, "color_name" => "Blanc neige")
);

// --- Traitement POST -------------------------------------------
$errors = [];
$messages = [];
//$category_id = $_POST['category_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF
    if ($_SESSION['csrf_token'] == !$_POST['csrf_token']) {
                header('Location: /inscription');
            }
    // Champs de base
    $name = SecurityMiddleware::sanitizeInput(trim($_POST['name']) ?? '');
    $description = SecurityMiddleware::sanitizeInput(trim($_POST['description']) ?? '');
    $prix_global = SecurityMiddleware::sanitizeInput((int)($_POST['prix_global'] ?? 0));
    $category_id = SecurityMiddleware::sanitizeInput((int)($_POST['category_id'] ?? 0));
    $variants_json = $_POST['variants_json'] ?? '';

    if ($name === '') $errors[] = "Le nom du produit est requis.";
    if ($category_id <= 0) $errors[] = "Sélectionne une catégorie.";
    if (empty($variants_json)) $errors[] = "Ajoute au moins une variante.";

    // Décoder variantes
    $variants = json_decode($variants_json, true);
    if (!is_array($variants) || count($variants) === 0) {
        $errors[] = "Format des variantes invalide.";
    }

    // Validation variante : structure + doublons
    $seenCombos = [];
    if (empty($errors)) {
        foreach ($variants as $i => $v) {
            $size = isset($v['size']) ? (int)$v['size'] : 0;
            $color = isset($v['color']) ? (int)$v['color'] : 0;
            $stock = isset($v['stock']) ? (int)$v['stock'] : null;
            $price = isset($v['price']) ? (int)$v['price'] : null;

            if ($size <= 0 || $color <= 0) {
                $errors[] = "Variante #" . ($i+1) . " : taille ou couleur invalide.";
                break;
            }
            if ($stock === null || $stock < 0) {
                $errors[] = "Variante #" . ($i+1) . " : stock invalide.";
                break;
            }
            if ($price === null || $price < 0) {
                $errors[] = "Variante #" . ($i+1) . " : prix invalide.";
                break;
            }

            $key = $size . ':' . $color;
            if (isset($seenCombos[$key])) {
                $errors[] = "Doublon de variante détecté (taille+couleur).";
                break;
            }
            $seenCombos[$key] = true;
        }
    }

    // Si ok, procéder ( transaction + uploads )

    if (empty($errors)) {
 try {

        $movedFiles = []; // liste pour cleanup en cas d'erreur
      
            $pdo->beginTransaction();

            // 1) Insérer le produit
            $stmt = $pdo->prepare("INSERT INTO products (id_boutique, name, description, category_id, price) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_SESSION['id_boutique'], $name, $description,  $category_id, $prix_global]);
            $product_id = $pdo->lastInsertId();

            // 2) Insérer variantes
            $stmtVar = $pdo->prepare("INSERT INTO product_variants (product_id, size_id, color_id, stock_qty, price) VALUES (?, ?, ?, ?, ?)");
            foreach ($variants as $v) {
                $stmtVar->execute([
                    $product_id,
                    (int)$v['size'],
                    (int)$v['color'],
                    (int)$v['stock'],
                    (int)$v['price']
                ]);
            }

            // 3) Gérer image principale (obligatoire)
            
            if (!isset($_FILES['main_image']) || !is_uploaded_file($_FILES['main_image']['tmp_name'])) {
                throw new Exception(message: "Image principale manquante.");
            }
            $main = $_FILES['main_image'];
            if ($main['size'] > MAX_FILE_SIZE) throw new Exception("Image principale trop lourde (>5MB).");
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $main['tmp_name']);
            finfo_close($finfo);
            if (!in_array($mime, $allowedMime)) throw new Exception("Type d'image principale non autorisé.");

            // Générer nom sûr
            $ext = pathinfo($main['name'], PATHINFO_EXTENSION);
            $mainFilename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
            $mainTarget = $uploadDir . $mainFilename;
            if (!move_uploaded_file($main['tmp_name'], $mainTarget)) {
                throw new Exception("Impossible d'enregistrer l'image principale.");
            }
                
            $movedFiles[] = $mainTarget;

            // Insérer en DB
            $img_ordre_p = 'p';
            $img_ordre_s = 's';
            $stmtImg = $pdo->prepare("INSERT INTO product_images (product_id, img, img_ordre) VALUES (?, ?, ?)");
            $stmtImg->execute([$product_id, $mainFilename, $img_ordre_p ]);
            
            // 4) Gérer images supplémentaires (optionnel)
            if (isset($_FILES['extra_images']) && !empty($_FILES['extra_images']['name'][0])) {
                $countExtra = count($_FILES['extra_images']['name']);
                for ($i=0; $i < $countExtra; $i++) {
                    if (!is_uploaded_file($_FILES['extra_images']['tmp_name'][$i])) continue;

                    $size_i = $_FILES['extra_images']['size'][$i];
                    if ($size_i > MAX_FILE_SIZE) throw new Exception("Une image supplémentaire dépasse 5MB.");

                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_i = finfo_file($finfo, $_FILES['extra_images']['tmp_name'][$i]);
                    finfo_close($finfo);
                    if (!in_array($mime_i, $allowedMime)) throw new Exception("Type d'une image supplémentaire non autorisé.");

                    $ext_i = pathinfo($_FILES['extra_images']['name'][$i], PATHINFO_EXTENSION);
                    $fileName_i = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext_i;
                    $target_i = $uploadDir . $fileName_i;

                    if (!move_uploaded_file($_FILES['extra_images']['tmp_name'][$i], $target_i)) {
                        throw new Exception("Impossible d'enregistrer une image supplémentaire.");
                    }
                    $movedFiles[] = $target_i;

                    $stmtImg->execute([$product_id, $fileName_i, 's']);
                }
            }

            // Tout OK => commit
            $pdo->commit();
            $messages[] = "Produit créé avec succès !";
        } catch (Exception $e) {
            // rollback + suppression fichiers déplacés
            if ($pdo->inTransaction()) $pdo->rollBack();
            foreach ($movedFiles as $f) {
                if (file_exists($f)) @unlink($f);
            }
            $errors[] = "Échec : " . $e->getMessage();
        }
    }
}


?>

<body>
    <?php
    use Middleware\Page_precedant;
    $page_p = Page_precedant::page_p();
    new Retoure($page_p); ?>
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
        height: 55px;
        margin-bottom: 5px;
        font-size: 0.8rem;

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
        <div style=" display: flex; width: 100%; justify-content: right;  margin-bottom: 10px;">
            <a class="a" id="toggleBtn">Ajouter un produit</a>
        </div>
        <?php if(!empty($errors)): ?>
        <div class="errors">
            <ul style="color: #c82302ff; font-size: 0.8rem; margin-bottom: 10px;">
                <?php foreach($errors as $err) echo "<li>" . htmlspecialchars($err) . "</li>"; ?></ul>
        </div>
        <?php endif; ?>

        <?php if(!empty($messages)): ?>
        <div class="messages">
            <ul style="color: #68c802ff; font-size: 0.8rem; margin-bottom: 10px;">
                <?php foreach($messages as $m) echo "<li>" . htmlspecialchars($m) . "</li>"; ?></ul>
        </div>
        <?php endif; ?>
        <div class=' display_flex'>
            <div class='div'>
                <form id="productForm" method="POST" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= $csrfToken  ?>">
                    <!-- Le JSON des variantes sera placé ici juste avant envoi -->
                    <input type="hidden" name="variants_json" id="variants_json">
                    <p class='formTexte'>Nom du Produit</p>
                    <input type="text" name="name" id="name" placeholder="Nom du Produit"
                        value="<?php if (isset($name)) {echo $name;} ?>" required>
                    <p class='formTexte'>Description</p>
                    <textarea class="doldkdmslls" name="description" id="description" placeholder="Descriptions..."
                        rows="3" required><?php if (isset($description)) {echo $description;} ?></textarea>
                    <p class='formTexte'>Prix global </p>
                    <input type="number" name="prix_global" id="prix_global" placeholder="Prix global">
                    <p class='formTexte'>Catégorie</p>
                    <section>
                        <select style="height: 55px; font-size: 0.8rem; width: 50%;" id="categorieParent">
                            <option value="">Catégorie principale </option>
                        </select>

                        <select style="height: 55px; font-size: 0.8rem; width: 40%;" name="category_id" id="categorieEnfant">
                            <option value="">Sous-catégorie</option>
                        </select>

                        <script>
// Charger les catégories depuis PHP
const categories = <?php echo $jsonCategories; ?>;

// Sélectionner les éléments HTML
const selectParent = document.getElementById("categorieParent");
const selectEnfant = document.getElementById("categorieEnfant");

// Filtrer les catégories principales (celles sans parent_id)
const parents = categories.filter(c => !c.parent_id);

// Remplir la liste principale
parents.forEach(cat => {
    const opt = document.createElement("option");
    opt.value = cat.id;
    opt.textContent = cat.name;
    selectParent.appendChild(opt);
console.log(cat);


});

// Événement : quand on change la catégorie principale
selectParent.addEventListener("change", () => {
    const parentId = selectParent.value;
    selectEnfant.innerHTML = '<option value="">Sous-catégorie</option>';

    // Filtrer les sous-catégories du parent sélectionné
    const sousCats = categories.filter(c => c.parent_id == parentId);

    console.log(sousCats);
    // Remplir la seconde liste
    sousCats.forEach(sub => {
        const opt = document.createElement("option");
        opt.value = sub.id;
        opt.textContent = sub.name;
        selectEnfant.appendChild(opt);
    });
});
</script>
                    </section>

                    <p class='formTexte'>Variantes (taille + couleur + stock + prix)</p>
                    <div id="variantsContainer"></div>
                    <button type="button" class="btn" onclick="addVariant()">➕ Ajouter variante</button>

                    <div style="display: flex; justify-content: space-around;">
                        <section class='section'>
                            <input type="file" id="file_principale" name="main_image" accept="image/*" required>
                            <label for="file_principale">
                                <img style="width: 40px;" src="/assets/icons/home.svg" alt="">
                                <h2 style="font-size: 0.6rem;">Ajouter une image principale</h2>
                            </label>
                        </section>

                        <section class='section'>
                            <input type="file" id="file" name="extra_images[]" accept="image/*" multiple>
                            <label for="file">
                                <img style="width: 40px;" src="/assets/icons/home.svg" alt="">
                                <h2 style="font-size: 0.6rem;">Images supplémentaires </h2>
                            </label>
                        </section>
                    </div>
                    <button type="submit" class="btn">Enregistrer</button>
                </form>
            </div>

        </div>

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
        inpStock.value = defaults.stock ?? 1;

        const inpPrice = document.createElement('input');
        inpPrice.type = 'number';
        inpPrice.step = '0';
        inpPrice.className = 'variant-price';
        inpPrice.placeholder = 'Prix ';
        //inpPrice.value = defaults.price ?? 0;

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
    </script>

    <div style="margin-top: 5rem;"></div>

    <?php new html_nav_bar(""); ?>
</body>