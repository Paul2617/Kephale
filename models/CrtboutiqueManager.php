<?php
function ajouteBoutique($bd, $nomBoutique, $imgNom, $paye){
    $soldeBoutique = '0';
    $inser = $bd->prepare("INSERT INTO boutique ( id_user, nom, img, pays, solde ) VALUES (?,?,?,?,?)");
    $inser->execute(array($_SESSION["id"], $nomBoutique, $imgNom, $paye, $soldeBoutique));
    $Id_boutique = $bd->lastInsertId();

    if(isset ($_POST["id_abt"])){
        // si la boutique est paient on fait rien
    }else{
        $etat = "1";
        $inser_psa = $bd->prepare("INSERT INTO psa ( id_boutique, etat ) VALUES (?,?)");
        $inser_psa->execute(array($Id_boutique, $etat ));
    }
    return true ;
}
?>