<?php  

if(isset($_GET['id_produit'])){
    $id_produit = htmlspecialchars ($_GET['id_produit']);
}
if(isset($_GET['id_categorie'])){
    $id_categorie = htmlspecialchars ($_GET['id_categorie']);
}
if(isset($_GET['id_article'])){
    $id_article = htmlspecialchars ($_GET['id_article']);
}

// modifie l'article ou supprimer touts les element de la categorie
// info de la categorie
    $info_article = info_article($bd, $id_article, $id_produit, $id_categorie);

    $nom_article = $info_article['nom_article'];
    $descriptions_article = $info_article['descriptions_article'];
    $tailles_article = $info_article['tailles_article'];
    $prix_article = str_replace(' ', '',  $info_article['prix_article']);
    $date_livraison_article = str_replace(' ', '', $info_article['date_livraison_article']) ;
    $img_article = $info_article['img_article'];
    $types_produit = $info_article['types_produit'];
    $etatAbonnement = $info_article['etatAbonnement'];

    if($etatAbonnement !== 'G'){
         if($date_livraison_article !== '0'){

            $info_date_livraison_article = [
            "432000" =>  '5',
            "864000" =>  '10',
            "1296000" =>  '15',
            "1728000" =>  '20',
                                 ];
         }
         if($date_livraison_article !== '0'){
         $jour = $info_date_livraison_article [$date_livraison_article];
         }

    }

        $taille = str_replace(' ', '+', $tailles_article);
        $blocle = explode('+',$taille);
        $i = 0;

if(isset($_POST['modifie_article']) AND !empty($_POST['modifie_article'])){

    //modifie le nom de l'article
if(isset($_POST['new_nom_article']) AND !empty($_POST['new_nom_article'])){
$new_nom_article = htmlspecialchars ($_POST['new_nom_article']);
if($new_nom_article !== $nom_article){
    new_nom_article($bd, $id_article, $new_nom_article );
}
}
    //modifie le prix de l'article
if(isset($_POST['new_prix_article']) AND !empty($_POST['new_prix_article'])){

$new_prix_articles = htmlspecialchars ($_POST['new_prix_article']);

$new_prix_article = str_replace(' ', '', $new_prix_articles);
if($new_prix_article !== $prix_article){
    new_prix_article($bd, $id_article, $new_prix_article );
}
}

    //modifie le description de l'article
if(isset($_POST['new_descriptions_article']) AND !empty($_POST['new_descriptions_article'])){
$new_descriptions_article = htmlspecialchars ($_POST['new_descriptions_article']);
if($new_descriptions_article !== $descriptions_article){
    new_descriptions_article($bd, $id_article, $new_descriptions_article );
}
}
    
//modifie le description la date livraison article
if(isset($_POST['new_delais']) AND !empty($_POST['new_delais'])){
    $new_delais = htmlspecialchars ($_POST['new_delais']);
    $new_delais = str_replace(' ', '', $new_delais);
    if($new_delais !== $date_livraison_article){
        new_delais($bd, $id_article, $new_delais );
    }
}

if(isset($_POST['options']) AND !empty($_POST['options'])){
    $options = $_POST['options'];
    $selectedOptions = implode(' ', $options);
    $new_tailles = str_replace(' ', '+', $selectedOptions);
    if($new_tailles !==   $tailles_article ){
    new_tailles($bd, $id_article, $new_tailles );
    }
}
}