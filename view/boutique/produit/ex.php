<?php new html(); ?>
<?php

// --- CONFIG ----------------------------------------------------
$DSN = "mysql:host=localhost;dbname=kephale;charset=utf8mb4";
//$DSN = "mysql:host=sql100.infinityfree.com;dbname=if0_39688167_kephale;charset=utf8mb4";


//$pdo = new PDO("mysql:host=localhost;dbname=kephale;charset=utf8", "root", "root");
// Taille max upload (octets) => 5 Mo
define('MAX_FILE_SIZE', 5 * 1024 * 1024);
$allowedMime = ['image/jpeg','image/png','image/gif','image/webp'];
$uploadDir = __DIR__ . '../../../../assets/img_produit/';

// --- CSRF token ------------------------------------------------
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// --- PDO connexion ---------------------------------------------
try {
    $pdo = new PDO($DSN, 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    die("Erreur DB: " . $e->getMessage());
}

// --- Charger catégories / tailles / couleurs -------------------
$categories = $pdo->query("SELECT id, name FROM categories ORDER BY id")->fetchAll();
$sizes = $pdo->query("SELECT id, categorie, nom AS size_code FROM taille ORDER BY id")->fetchAll();
$colors = $pdo->query("SELECT id, nom AS color_name FROM colors ORDER BY id")->fetchAll();

// --- Traitement POST -------------------------------------------
$errors = [];
$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF
   // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
   //     $errors[] = "Jeton CSRF invalide.";
  //  }

    // Champs de base
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);
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

    // Si ok, procéder (transaction + uploads)
    if (empty($errors)) {
        // Créer dossier uploads si nécessaire
       //  if (!is_dir($uploadDir)) {
        //     if (!mkdir($uploadDir, 0777, true)) {
         //        $errors[] = "Impossible de créer le dossier d'upload.";
         //    }
        // }
    }

    if (empty($errors)) {
        $movedFiles = []; // liste pour cleanup en cas d'erreur
      
            $pdo->beginTransaction();

            // 1) Insérer le produit
            $stmt = $pdo->prepare("INSERT INTO products (name, description, category_id) VALUES (?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['description'], $_POST['category_id']]);
            $product_id = $pdo->lastInsertId();

            // 2) Insérer variantes
            $stmtVar = $pdo->prepare("INSERT INTO product_variants (product_id, size_id, color_id, stock_qty, price) VALUES (?, ?, ?, ?, ?)");
            foreach ($variants as $v) {
                $stmtVar->execute([
                    $product_id,
                    (int)$v['size'],
                    (int)$v['color'],
                    (int)$v['price'],
                    (int)$v['stock']
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

                    $stmtImg->execute([$product_id, $mainFilename, 's']);
                }
            }

            // Tout OK => commit
            $pdo->commit();
            $messages[] = "Produit créé avec succès ! (ID: $product_id)";
 /* try {
        } catch (Exception $e) {
            // rollback + suppression fichiers déplacés
            if ($pdo->inTransaction()) $pdo->rollBack();
            foreach ($movedFiles as $f) {
                if (file_exists($f)) @unlink($f);
            }
            $errors[] = "Échec : " . $e->getMessage();
        }
        */
    }
}
?>

<body>

    <?php if(!empty($errors)): ?>
    <div class="errors">
        <ul><?php foreach($errors as $err) echo "<li>" . htmlspecialchars($err) . "</li>"; ?></ul>
    </div>
    <?php endif; ?>

    <?php if(!empty($messages)): ?>
    <div class="messages">
        <ul><?php foreach($messages as $m) echo "<li>" . htmlspecialchars($m) . "</li>"; ?></ul>
    </div>
    <?php endif; ?>
    <?php ; new Retoure('/boutique'); ?>
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
        <div style=" display: flex; width: 100%; justify-content: right;  margin-bottom: 10px;">
            <button id="toggleBtn">Ajouter un produit</button>
        </div>
        <div style=" display: none; width: 100%;" class=' display_flex' id="maDiv">
            <div class='div'>
                <form id="productForm" method="POST" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="csrf_token" value="<?=htmlspecialchars($_SESSION['csrf_token'])?>">
                    <!-- Le JSON des variantes sera placé ici juste avant envoi -->
                    <input type="hidden" name="variants_json" id="variants_json">
                    <p class='formTexte'>Nom du Produit</p>
                    <input type="text" name="name" id="name" placeholder="Nom du Produit" required>
                    <p class='formTexte'>Description</p>
                    <textarea class="doldkdmslls" name="description" id="description" placeholder="Descriptions..."
                        rows="3"
                        required><?php if (isset($descriptions_article)) {echo $descriptions_article;} ?></textarea>

                    <p class='formTexte'>Catégorie</p>
                    <section>
                        <select class="form_input_ddj" id="category" name="category_id" required>
                            <option value="">Sélectionne</option>
                            <?php foreach($categories as $c): ?>
                            <option value="<?=$c['id']?>"><?=htmlspecialchars($c['name'])?></option>
                            <?php endforeach; ?>
                        </select>
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

        <h1 style="font-size: 1rem; margin-bottom: 10px; ">Liste des Produits</h1>

        <div class="div display_flex">
            <div class="display_flex_justifi">
                <section style="display: flex;">
                    <img class="user_img" src="/assets/img_profil/24025457_250909_164438.jpg" alt="">
                    <section>
                        <h1 class="user_nom">Kephalé</h1>
                        <div style="display: flex;">
                            <section class="section">
                                <a href="/boutique/editerProduit/3/4">
                                    <p>Editer</p>
                                </a>
                            </section>
                            <section class="section">
                                <a href="/boutique/article/3/4">
                                    <p>Ajoute les articles</p>
                                </a>
                            </section>
                            <section class="sectionSuprimer">
                                <img class="iconSuprimer" src="/assets/icons/supprimer.png" alt="">
                            </section>
                        </div>

                    </section>
                </section>
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
    </script>
    <script>
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