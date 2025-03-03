<?php 

function listeProduit($bd){
    $produit = recRowCount($bd, 'produit','id_categorie', $_GET["id_categorie"]);
    if($produit >= 1){
    return recTableIdBoucle($bd, 'produit','id_categorie', $_GET["id_categorie"]);
}else{
    return null;
}

}

?>