<?php 
require_once ('../models/bd/Model.php');

function listBoutiqueType ($bd, $type, $colone, $ORDER_BY){
    $recherche = recherche($bd, $type, $colone, $ORDER_BY);
    if ($recherche->rowCount() > 0){
        return $recherche->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return 'null';
    }
}
function listeProduit($bd, $id_categorie){
    $rec =  $bd->prepare('SELECT * FROM produit WHERE id_categorie = ? LIMIT 3 ');
    $rec->execute(array($id_categorie));
    if($rec->rowCount() > 0){
        return  $rec->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return 'null';
    }
    $rec->closeCursor();
}

function listBoutique($bd, $type, $rech){
    $rechercheBoutique = rechercheBoutique ($bd, $type, $rech);

    if($rechercheBoutique->rowCount() > 0){
        return  $rechercheBoutique->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return 'null';
    }
}

?>