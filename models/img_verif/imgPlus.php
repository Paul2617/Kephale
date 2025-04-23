<?php
function img_verif ($bd, $nomArticle, $descriptions_article, $prixArticle, $tailles, $date_livraison, $imgDirection ){

}

$maxFileSize   = 5 * 1024 * 1024; // 5 Mo
$files = $_FILES['images']['name'];
$totalFiles = count($_FILES['images']['name']);


$i = 0;
$date = time();


foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
    if ($_FILES['images']['error'][$index] === 0){
        $originalName = basename($_FILES['images']['name'][$index]);
        $img_name = pathinfo($_FILES["images"]["name"][$index], PATHINFO_FILENAME);
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $newFileName = $date . '_' . uniqid() .'_'.$img_name .'.' . $extension;
        $img_autorise = ['jpg', 'jpeg', 'png', 'PNG', 'JPG', 'JPEG'];
        $fileSize = $_FILES['images']['size'][$index];
        if (in_array($extension, $img_autorise)) {
            if ( $maxFileSize > $fileSize) {
                    $trur = true;
                    // Enregistrer le nom de l'image dans la table images
            }else{
                $erreur = "La taille de votre image dépasse 5 Mo. ";
                continue;
            }
        }else{
            $erreur = "Veuiller utiliser une image au format jpeg, jpg ou png";
            continue;
        }
    }

}
if(isset($trur)){
    $date_creations = time();
    $imgNom = 'null';
    $inser = $bd->prepare("INSERT INTO article ( id_boutique, id_categorie, id_produit, nom, descriptions, tailles, img, prix, date_livraison, date_creations ) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $inser->execute(array($_SESSION["id_boutique"], $_GET["id_categorie"], $_GET["id_produit"], $nomArticle, $descriptions_article, $tailles, $imgNom, $prixArticle, $date_livraison, $date_creations));
    
    $articleId = $bd->lastInsertId();
    }

if(isset($articleId)){
  
    foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
        $originalName = basename($_FILES['images']['name'][$index]);
        $img_name = pathinfo($_FILES["images"]["name"][$index], PATHINFO_FILENAME);
         // Mettre en minuscules
        $img_name = mb_strtolower($img_name, 'UTF-8');

         // Supprimer les espaces (espaces, tabulations, retours à la ligne)
        $img_name = preg_replace('/\s+/', '', $img_name);

         // Supprimer les chiffres et les caractères spéciaux (garde uniquement a–z)
        $img_name = preg_replace('/[^a-z]/', '', $img_name);

        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $newFileName = $date . '_' . uniqid() .'_'.$img_name .'.' . $extension;
        $imgDirection = "asset/img_article/";
        if (move_uploaded_file($tmpName, $imgDirection . $newFileName))  {
            $stmt = $bd->prepare("INSERT INTO images_article (article_id, nom_image) VALUES (?, ?)");
            if($stmt->execute([$articleId, $newFileName])){
                header ('Location: /Kephale/article&id_categorie='.$_GET["id_categorie"].'&id_produit='.$_GET["id_produit"] );
            }
        }
    }

}
  
?>
