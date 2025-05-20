<?php  
$id_produit = htmlspecialchars($_GET["id_produit"]) ;
$id_categorie = htmlspecialchars($_GET["id_categorie"]) ;
$id_article = htmlspecialchars($_GET["id_article"]) ;
 $recupeUneImg = recupeUneImg ($bd, $id_article );
 $recupeTousLesImg = recupeTousLesImg ($bd, $id_article );


 if(isset($_POST["supprimer"])){
    $id_imgs = $_POST["id_imgs"];
    $nom_img = $_POST["nom_img"];
    $img_direction = '../public/asset/img_article/';
    $img_suprime = $img_direction . $nom_img;
    if (file_exists($img_suprime))
        unlink($img_suprime);
        supprimeImg($bd,  $id_imgs ,$id_article);
 }
$maxFileSize   = 5 * 1024 * 1024; // 5 Mo
$i = 0;
$date = time();
 if(isset($_POST["ajouter"])){
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
             $id_boutique = $_SESSION["id_boutique"];
            $stmt = $bd->prepare("INSERT INTO images_article (article_id, id_boutique, nom_image) VALUES (?,?,?)");
            if($stmt->execute([$id_article, $id_boutique, $newFileName])){
               header("refresh:1");
            }
        }
    }
  }
 }

?>