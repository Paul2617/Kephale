<?php
function liste_achat($bd){
    $liste_achat = $bd->prepare("SELECT * FROM liste_achat WHERE id_user = ? AND user LIKE 'oui'  ORDER BY etat_livraison DESC ");
    $liste_achat->execute(array($_SESSION["id"]));
    if ($liste_achat->rowCount() > 0 ){
        return $liste_achat->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return null;
    }
}
?>