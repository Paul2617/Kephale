<?php
if (isset($_SESSION["algo"])) {
    $_SESSION["algo"]++;
} else {
    $_SESSION["algo"] = 0;
}

//setcookie($nom_COOKIE, $valeur, $expiration);
//$expiration = time() + (30 * 24 * 60 * 60); // 30 jours

// determine le jour actuel
$joure = date('l');
$day_of_week_fr = [
    'Sunday' => 'Dimanche',
    'Monday' => 'Lundi',
    'Tuesday' => 'Mardi',
    'Wednesday' => 'Mercredi',
    'Thursday' => 'Jeudi',
    'Friday' => 'Vendredi',
    'Saturday' => 'Samedi',
];
$joure_actuel = $day_of_week_fr[$joure];
// determine l'heur actuel
$heur_actuel = date('H');
// sexe usere
$heur_actuel = date('H');
if ($infoUser["sexe"] === "homme") {
    $sexe = "Homme";
} elseif ($infoUser["sexe"] === "femme") {
    $sexe = "Femme";
} elseif ($infoUser["sexe"] === "enfant") {
    $sexe = "Enfant";
}

if($_SESSION["algo"] <= 5){
    $type = 'boutique';
    $table = 'boutique';
    $ORDER_BY = ' ORDER BY  boutique.id DESC';
}elseif($_SESSION["algo"] <= 10){
    $type = 'boutique';
    $table = 'boutique';
    $ORDER_BY = ' ORDER BY  boutique.id ASC';
}elseif($_SESSION["algo"] <= 15){
    $type = 'boutique';
    $table = 'boutique';
    $ORDER_BY = ' ORDER BY  boutique.nom DESC';
}elseif($_SESSION["algo"] <= 20){
    $table = 'categorie';
    $type = 'categorie';
    $ORDER_BY = ' ORDER BY  categorie.id ASC';
}elseif($_SESSION["algo"] <= 25){
    $table = 'categorie';
    $type = 'categorie';
    $ORDER_BY = ' ORDER BY  categorie.id DESC';
}elseif($_SESSION["algo"] <= 30){
    $table = 'categorie';
    $type = 'categorie';
    $ORDER_BY = ' ORDER BY  categorie.nom DESC';
}elseif($_SESSION["algo"] <= 35){
    $table = 'article';
    $type = 'article';
    $ORDER_BY = ' ORDER BY  article.date_creations DESC';
    $type_sexe =  $sexe ;
}elseif($_SESSION["algo"] <= 40){
    $table = 'article';
    $type = 'article';
    $ORDER_BY = ' ORDER BY  article.date_creations ASC';
}elseif($_SESSION["algo"] <= 45){
    $table = 'article';
    $type = 'article';
    $ORDER_BY = ' ORDER BY  article.date_creations DESC';
}else{
    $_SESSION["algo"] = 0;
    header("Refresh: 0");
}

if($table === 'boutique' ){
    $sql_Q = "SELECT  boutique.id as boutique_id, boutique.id_user, boutique.nom, boutique.img, boutique.pays, user.nom as user_nom, user.img as user_img  FROM boutique 
    INNER JOIN user ON boutique.id_user = user.id  INNER JOIN abonnement ON boutique.id_user = abonnement.id_user WHERE abonnement.etat LIKE '1' ".$ORDER_BY ;

    $stmt = $bd->prepare("$sql_Q");
    $stmt->execute(array());
    require_once "../views/recherche/boutique.php";
}elseif($table === 'categorie') {

    $sql_Q = "SELECT  categorie.id as id, categorie.id_boutique, categorie.nom, categorie.img, categorie.types, boutique.id_user as id_user   FROM categorie 
    INNER JOIN boutique ON boutique.id = categorie.id_boutique  INNER JOIN abonnement ON boutique.id_user = abonnement.id_user WHERE abonnement.etat LIKE '1' ".$ORDER_BY ;
    
    $stmt = $bd->prepare("$sql_Q");
    $stmt->execute(array());
    require_once "../views/recherche/categorie.php";

}elseif($table === 'article') {
    if(isset($type_sexe)){
        $sql_Q = "SELECT  article.id as id, article.id_boutique, article.id_categorie, article.id_produit, article.nom, article.img, article.prix, boutique.id_user as id_user, categorie.types   FROM article 
        INNER JOIN boutique ON boutique.id = article.id_boutique INNER JOIN categorie ON categorie.id = article.id_categorie INNER JOIN abonnement ON boutique.id_user = abonnement.id_user WHERE abonnement.etat LIKE '1' AND categorie.types LIKE '$type_sexe' ".$ORDER_BY ;
    }else{
        $sql_Q = "SELECT  article.id as id, article.id_boutique, article.id_categorie, article.id_produit, article.nom, article.img, article.prix, boutique.id_user as id_user, categorie.types   FROM article 
        INNER JOIN boutique ON boutique.id = article.id_boutique INNER JOIN categorie ON categorie.id = article.id_categorie INNER JOIN abonnement ON boutique.id_user = abonnement.id_user WHERE abonnement.etat LIKE '1' ".$ORDER_BY ;    
    }
    $stmt = $bd->prepare("$sql_Q");
     $stmt->execute(array());
     require_once "../views/recherche/article.php";

}
?>