<?php  
if(isset($_GET['page'])){
    $page = htmlspecialchars ($_GET['page']);
if($page === 'categorie' ){
    require_once ('../controleur/modifie/modifie_categorie.php');
    require_once ('../controleur/supprimer/supprime_categorie.php');
}elseif($page === 'produit' ){
require_once ('../controleur/modifie/modifie_produit.php');
require_once ('../controleur/supprimer/supprime_produit.php');
}elseif($page === 'article'){
require_once ('../controleur/modifie/modifie_article.php');
}
}
?>