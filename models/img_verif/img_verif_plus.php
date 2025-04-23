<?php
function img_verif ($bd, $nomArticle, $descriptions_article, $prixArticle, $tailles, $date_livraison, $imgDirection ){
    $maxFileSize = 5 * 1024 * 1024; // 5 Mo
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/JPEG', 'image/JPG', 'image/png', 'image/PNG'];
    $files = $_FILES['images'];
    foreach ($files['tmp_name'] as $index => $tmpName) {
        $originalName = $files['name'][$index];
        $fileType = $files['type'][$index];
        $fileSize = $files['size'][$index];
        $fileError = $files['error'][$index];

        if ($fileError === UPLOAD_ERR_OK){
            // Vérification du type
             if (!in_array($fileType, $allowedTypes))  {
                $erreur = "format";
                continue;
            }
             // Vérification de la taille
             if ($fileSize > $maxFileSize)  {
                $erreur = "taille";
                continue;
            }

             // Nettoyage du nom de fichier
             $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
             $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
             $newName = date('Ymd_His') . '_' . uniqid() . '_' . $safeName . '.' . $extension;

             if (move_uploaded_file($tmpName, $imgDirection . $newName)) {
                $date_creations = time();
                $imgNom = 'null';
                $inser = $bd->prepare("INSERT INTO article ( id_boutique, id_categorie, id_produit, nom, descriptions, tailles, img, prix, date_livraison, date_creations ) VALUES (?,?,?,?,?,?,?,?,?,?)");
                $inser->execute(array($_SESSION["id_boutique"], $_GET["id_categorie"], $_GET["id_produit"], $nomArticle, $descriptions_article, $tailles, $imgNom, $prixArticle, $date_livraison, $date_creations));

                $articleId = $bd->lastInsertId();

                // Enregistrer le nom de l'image dans la table images
                $stmt = $bd->prepare("INSERT INTO images_article (article_id, nom_image) VALUES (?, ?)");
                $stmt->execute([$articleId, $newName]);

                return true;

             }
             
        }

    }

    if(isset($erreur)){
        return  $erreur;
    }
}

 ?>