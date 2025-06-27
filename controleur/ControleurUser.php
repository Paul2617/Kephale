<?php
//$_SESSION = array();
//session_destroy();

//voir la session est id_user est declare
if(isset($_SESSION["id"])){
    //Inporte le doc dans model pour tout les recquet de la basse de done
        require_once ('../models/solde_affiche/solde.php');
        //recupere les info de ulitilisteur
        // bodie lafissage du solde
       $userSolde = solde ($infoUsers["solde"]) ;
}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/connection'  );
}





if (isset($_POST["recherche"]) and !empty($_POST["recherche"])) {
    $_SESSION["recherche"] = $_POST["recherche"];
    $mots = trim($_POST["recherche"]);
    $mots_cles = htmlspecialchars($mots, ENT_QUOTES, 'UTF-8');
    // Séparer la recherche par mots
    $search_term = explode(' ', $mots_cles);
    $conditions = [];
    foreach ($search_term as $mot) {
        // Ajouter une condition LIKE pour chaque mot
        $conditions[] = "boutique.nom LIKE  '%$mot%'";
    };

    $dhhd = " AND abonnement.etat LIKE '1'";

    $sql_Q = "SELECT  boutique.id as boutique_id, boutique.id_user, boutique.nom, boutique.img, boutique.pays, user.nom as user_nom, user.img as user_img  FROM boutique 
    INNER JOIN user ON boutique.id_user = user.id  INNER JOIN abonnement ON boutique.id_user = abonnement.id_user WHERE 
        " .implode(' AND ', $conditions,);

    $sql  = $sql_Q . $dhhd;
}




// recherche en fonction de la boutique
if(isset($sql)){
    $stmt = $bd->query($sql);

    if($stmt->rowCount() >= 1){
        $info = 'boutique';
    }else{
         // recherhe fait en fonctions du nom de l'article dans la table article
    if(isset($_SESSION["recherche"])){
        $mots = trim($_SESSION["recherche"]);
    }else{
        $mots = trim($_POST["recherche"]);
    }
    $mots_cles = htmlspecialchars($mots, ENT_QUOTES, 'UTF-8');
    // Séparer la recherche par mots
    $condition = [];
    foreach ($search_term as $mot) {
        // Ajouter une condition LIKE pour chaque mot
        $condition[] = " article.nom LIKE  '%$mot%'";
    };
    $idd = implode(' AND ', $condition)." GROUP BY  article.id";
    $sql_Q2 = "SELECT * FROM article WHERE ".$idd;

    $stmt = $bd->prepare("$sql_Q2");
    $stmt->execute(array());
    if($stmt->rowCount() >= 1){
        $info = 'article';
    }else{
                  // recherche fait dans le groupe des article table produit
                  if(isset($_SESSION["recherche"])){
                    $mots = trim($_SESSION["recherche"]);
                }else{
                    $mots = trim($_POST["recherche"]);
                }
            $mots_cles = htmlspecialchars($mots, ENT_QUOTES, 'UTF-8');
            // Séparer la recherche par mots
            $condition = [];
            foreach ($search_term as $mot) {
                // Ajouter une condition LIKE pour chaque mot
                $condition[] = " produit.nom LIKE  '%$mot%'";
            };
            $idd = implode(' AND ', $condition)." GROUP BY  id";
        
        $sql_Q3 = "SELECT * FROM produit WHERE ".$idd;
        
        $stmt = $bd->prepare("$sql_Q3");
        $stmt->execute(array());
        if($stmt->rowCount() >= 1){
            $info = 'produit';
        }else{
            
            // recherhe fait dans la liste des categorie
if(isset($_SESSION["recherche"])){
    $mots = trim($_SESSION["recherche"]);
}else{
    $mots = trim($_POST["recherche"]);
}
    $mots_cles = htmlspecialchars($mots, ENT_QUOTES, 'UTF-8');
    // Séparer la recherche par mots
    $condition = [];
    foreach ($search_term as $mot) {
        // Ajouter une condition LIKE pour chaque mot
        $condition[] = " categorie.types LIKE  '%$mot%'";
    };
    $idd = implode(' AND ', $condition);

$sql_Q = "SELECT * FROM categorie WHERE ".$idd;
$stmt = $bd->prepare("$sql_Q");
$stmt->execute(array());
if($stmt->rowCount() >= 1){
    $info = 'categorie';
}


        }
    }
    }
}

    $infoachat = infoachat ($bd);

    if($infoachat !== false){
        $achat_efect = $infoachat;
    }
?>