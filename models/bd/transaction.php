<?php

function transactionAbonnement($bd, $montant){
        // Retirer le montant dans user
        $stmt = $bd->prepare('UPDATE user SET solde = solde - ? WHERE id = ? ');
        $stmt->execute(array($montant, $_SESSION["id"]));

        // Ajoute le montant sur le compte kephale
        $idkephale = "1";
        $stmt = $bd->prepare("UPDATE kephale SET solde = solde + ? WHERE id = ? ");
        $stmt->execute(array($montant, $idkephale));

        // Ajoute a la liste de transictions
        $motif = 'Abonnement';
        $date_transaction= time();

        $stmt = $bd->prepare("INSERT INTO transactions (id_deduit, id_ajout, montant, motif, date_transaction ) VALUES (?,?,?,?,?)");
        $stmt->execute(array($_SESSION["id"],  $idkephale, $montant, $motif , $date_transaction));
        // Ajoute a la liste de transictions
        $etat = "1";
        $date_fin =    $date_transaction + "2592000";
        $stmt = $bd->prepare("INSERT INTO abonnement (id_user, id_offre, date_debut, date_fin, etat) VALUES (?,?,?,?,?)");
        $stmt->execute(array($_SESSION["id"],$_GET["id_abt"],$date_transaction, $date_fin, $etat ));
        
       
        if ($stmt->rowCount() === 0) {
            throw new Exception("Échec de la mise à jour des comptes.");
        }else{
            return true ;
        }
        $stmt->closeCursor();
}
?>