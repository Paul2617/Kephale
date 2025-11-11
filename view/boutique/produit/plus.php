<?php
/**
 * add_product_variants.php (version avec prix global, couleurs en liste, image principale et images supplémentaires)
 */

/* ====== SCHEMA SQL (MySQL) ======

ALTER TABLE products ADD COLUMN global_price DECIMAL(10,2) DEFAULT NULL;
ALTER TABLE products ADD COLUMN main_image VARCHAR(255) DEFAULT NULL;

*/

$dsn = 'mysql:host=localhost;dbname=kephale;charset=utf8mb4';
$dbUser = 'root';
$dbPass = 'root';

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('DB connection error: ' . $e->getMessage());
}

function saveUploadedFile($file, $uploadDir = __DIR__ . '/uploads') {
    if ($file['error'] !== UPLOAD_ERR_OK) return false;
    $allowed = ['image/jpeg','image/png','image/webp'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowed)) return false;

    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $name = bin2hex(random_bytes(8)) . '.' . $ext;
    $target = $uploadDir . '/' . $name;
    if (move_uploaded_file($file['tmp_name'], $target)) return $name;
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $globalPrice = ($_POST['global_price'] !== '') ? floatval($_POST['global_price']) : null;
    $variants = $_POST['variants'] ?? [];

    if ($title === '') {
        $error = 'Le titre est requis.';
    } else {
        $pdo->beginTransaction();
        try {
            // Sauvegarder l'image principale
            $mainImage = null;
            if (!empty($_FILES['main_image']['name'])) {
                $mainImage = saveUploadedFile($_FILES['main_image']);
            }

            $stmt = $pdo->prepare('INSERT INTO products (title, description, global_price, main_image) VALUES (:title, :description, :global_price, :main_image)');
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':global_price' => $globalPrice,
                ':main_image' => $mainImage
            ]);
            $productId = $pdo->lastInsertId();

            $variantCount = count($variants['sku'] ?? []);
            $variantIds = [];
            $vStmt = $pdo->prepare('INSERT INTO variants (product_id, sku, color, size, price, quantity) VALUES (:product_id, :sku, :color, :size, :price, :quantity)');
            for ($i = 0; $i < $variantCount; $i++) {
                $sku = trim($variants['sku'][$i] ?? '');
                $color = trim($variants['color'][$i] ?? '');
                $size = trim($variants['size'][$i] ?? '');
                $price = floatval($variants['price'][$i] ?? 0);
                $quantity = intval($variants['quantity'][$i] ?? 0);
                if ($color === '' && $size === '' && $sku === '') continue;
                $vStmt->execute([
                    ':product_id' => $productId,
                    ':sku' => $sku,
                    ':color' => $color,
                    ':size' => $size,
                    ':price' => $price,
                    ':quantity' => $quantity
                ]);
                $variantIds[] = $pdo->lastInsertId();
            }

            // Images supplémentaires
            if (!empty($_FILES['images']) && is_array($_FILES['images']['name'])) {
                $files = [];
                foreach ($_FILES['images']['name'] as $k => $name) {
                    $files[] = [
                        'name' => $_FILES['images']['name'][$k],
                        'type' => $_FILES['images']['type'][$k],
                        'tmp_name' => $_FILES['images']['tmp_name'][$k],
                        'error' => $_FILES['images']['error'][$k],
                        'size' => $_FILES['images']['size'][$k],
                    ];
                }
                $imgStmt = $pdo->prepare('INSERT INTO images (product_id, variant_id, filename) VALUES (:product_id, :variant_id, :filename)');
                foreach ($files as $idx => $file) {
                    $saved = saveUploadedFile($file);
                    if ($saved) {
                        $variantIndex = $_POST['images_variant'][$idx] ?? null;
                        $variantId = null;
                        if ($variantIndex !== null && $variantIndex !== '' && isset($variantIds[intval($variantIndex)])) {
                            $variantId = $variantIds[intval($variantIndex)];
                        }
                        $imgStmt->execute([
                            ':product_id' => $productId,
                            ':variant_id' => $variantId,
                            ':filename' => $saved
                        ]);
                    }
                }
            }

            $pdo->commit();
            $success = 'Produit ajouté avec succès.';
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = 'Erreur lors de l\'enregistrement: ' . $e->getMessage();
        }
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Ajouter produit avec variantes</title>
  <style>
    body{font-family:Arial;margin:20px}
    .variant{border:1px solid #ddd;padding:10px;margin-bottom:8px;border-radius:6px}
    .row{display:flex;gap:8px}
  </style>
</head>
<body>
  <h2>Ajouter un produit (avec prix global, couleurs en liste, image principale et supplémentaires)</h2>
  <?php if(!empty($error)): ?><div style="color:#a00"><?=htmlspecialchars($error)?></div><?php endif; ?>
  <?php if(!empty($success)): ?><div style="color:green"><?=htmlspecialchars($success)?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" id="productForm">
    <div>
      <label>Titre<br><input name="title" required value="<?=htmlspecialchars($_POST['title'] ?? '')?>"></label>
    </div>
    <div>
      <label>Description<br><textarea name="description" rows="4"><?=htmlspecialchars($_POST['description'] ?? '')?></textarea></label>
    </div>
    <div>
      <label>Prix global (laisser vide si prix par variante)<br><input name="global_price" value="<?=htmlspecialchars($_POST['global_price'] ?? '')?>"></label>
    </div>

    <div>
      <label>Image principale<br><input type="file" name="main_image" accept="image/*"></label>
    </div>

    <h3>Variantes</h3>
    <div id="variantsContainer"></div>
    <button type="button" id="addVariantBtn">+ Ajouter variante</button>

    <h3>Images supplémentaires</h3>
    <div id="imagesContainer"></div>
    <button type="button" id="addImageBtn">+ Ajouter image</button>

    <div style="margin-top:12px">
      <button type="submit">Enregistrer</button>
    </div>
  </form>

  <template id="variantTpl">
    <div class="variant">
      <div style="text-align:right"><button type="button" class="removeVariant">Supprimer</button></div>
      <div class="row">
        <input name="variants[sku][]" placeholder="SKU" />
        <select name="variants[color][]">
          <option value="">Choisir couleur</option>
          <option value="Rouge">Rouge</option>
          <option value="Bleu">Bleu</option>
          <option value="Vert">Vert</option>
          <option value="Noir">Noir</option>
          <option value="Blanc">Blanc</option>
        </select>
        <input name="variants[size][]" placeholder="Taille" />
      </div>
      <div class="row" style="margin-top:6px">
        <input name="variants[price][]" placeholder="Prix variante" />
        <input name="variants[quantity][]" placeholder="Quantité" />
      </div>
    </div>
  </template>

  <template id="imageTpl">
    <div style="margin-bottom:8px">
      <input type="file" name="images[]" accept="image/*" />
      <input type="hidden" name="images_variant[]" value="" class="images_variant">
      <select class="mapVariantSelect">
        <option value="">-- associer à une variante (optionnel) --</option>
      </select>
      <button type="button" class="removeImage">Supprimer</button>
    </div>
  </template>

<script>
const variantsContainer = document.getElementById('variantsContainer');
const addVariantBtn = document.getElementById('addVariantBtn');
const variantTpl = document.getElementById('variantTpl').content;

const imagesContainer = document.getElementById('imagesContainer');
const addImageBtn = document.getElementById('addImageBtn');
const imageTpl = document.getElementById('imageTpl').content;

function refreshImageVariantSelects(){
  const variants = Array.from(variantsContainer.querySelectorAll('.variant'));
  const labels = variants.map((v, idx) => {
    const color = v.querySelector('select[name="variants[color][]"]').value || 'couleur?';
    const size = v.querySelector('input[name="variants[size][]"]').value || 'taille?';
    const sku = v.querySelector('input[name="variants[sku][]"]').value || '';
    const label = sku ? sku + ' — ' + color + ' / ' + size : (color + ' / ' + size);
    return {idx, label};
  });
  imagesContainer.querySelectorAll('.mapVariantSelect').forEach(select => {
    select.innerHTML = '<option value="">-- associer à une variante (optionnel) --</option>';
    labels.forEach(l => {
      const opt = document.createElement('option');
      opt.value = l.idx;
      opt.textContent = l.label;
      select.appendChild(opt);
    });
  });
}

addVariantBtn.addEventListener('click', () => {
  const node = document.importNode(variantTpl, true);
  node.querySelector('.removeVariant').addEventListener('click', e => { e.target.closest('.variant').remove(); refreshImageVariantSelects(); });
  node.querySelectorAll('input,select').forEach(i => i.addEventListener('input', refreshImageVariantSelects));
  variantsContainer.appendChild(node);
  refreshImageVariantSelects();
});

addImageBtn.addEventListener('click', () => {
  const node = document.importNode(imageTpl, true);
  const select = node.querySelector('.mapVariantSelect');
  const hidden = node.querySelector('.images_variant');
  select.addEventListener('change', () => { hidden.value = select.value; });
  node.querySelector('.removeImage').addEventListener('click', e => e.target.closest('div').remove());
  imagesContainer.appendChild(node);
  refreshImageVariantSelects();
});

addVariantBtn.click();
addImageBtn.click();
</script>

</body>
</html>