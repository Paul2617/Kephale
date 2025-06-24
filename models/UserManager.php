<?php





function infoachat ($bd) {
    $infoachat = $bd->prepare("SELECT * FROM liste_achat WHERE id_user = ? AND etat_livraison LIKE 'non' ");
    $infoachat->execute([$_SESSION["id"]]);
    if ($infoachat->rowCount() > 0 ){
        return $infoachat->rowCount();
    }else{
        return false ;
    }
}
    ?>