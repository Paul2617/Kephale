<?php


function infoBoutique($bd) {

    $stmt = $bd->prepare("SELECT * FROM boutique WHERE id = ?  ");
    $stmt->execute([$_SESSION["id_boutique"]]);
    $resulte_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resulte_stmt ;
}
// recupere les informations des categori
function infoCategorie($bd) {
    $categori = recRowCount($bd, 'categorie','id_boutique', $_SESSION["id_boutique"]);
    if($categori >= 1){
        return recTableIdBoucle($bd, 'categorie','id_boutique', $_SESSION["id_boutique"]);

    }else{
        return null;
    }
}
// info vante
function infovante ($bd) {
    $infoachat = $bd->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND etat_livraison LIKE 'non' ");
    $infoachat->execute([$_SESSION["id_boutique"]]);
    if ($infoachat->rowCount() > 0 ){
        return $infoachat->rowCount();
    }else{
        return false ;
    }
}
function verifidaite_boutique($bd) {
    $date_transaction = time();
    $id_boutique = $_SESSION["id_boutique"];
    $stmt_s = $bd->prepare("SELECT solde FROM boutique WHERE id = ? ");
    $stmt_s->execute([$id_boutique]);
    $resulte_stmt_s = $stmt_s->fetch(PDO::FETCH_ASSOC);
    $solde_boutique = $resulte_stmt_s["solde"];
    $non = 'non';
    $stmt = $bd->prepare("SELECT * FROM boutique_reste WHERE id_boutique = ? AND etat LIKE '$non' LIMIT 1 ");
    $stmt->execute([$id_boutique]);
    if ($stmt->rowCount() > 0 ){
    if($solde_boutique > 0){

        $resulte_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_boutique_reste = $resulte_stmt["id"];
        $montant = $resulte_stmt["montant"];

        $stmt_b = $bd->prepare("SELECT * FROM boutique_verse WHERE id_boutique_reste = ? ");
        $stmt_b->execute([$id_boutique_reste]);
        if ($stmt_b->rowCount() > 0 ){
            $stmt_b2= $bd->prepare("SELECT SUM(montant) AS total_montant FROM boutique_verse WHERE id_boutique_reste = ? ");
            $stmt_b2->execute([$id_boutique_reste]);
            $resulte_stmt_b2 = $stmt_b2->fetch(PDO::FETCH_ASSOC);
            $total_montant = $resulte_stmt_b2['total_montant'];
            $reste_montan = $montant - $total_montant;
            // si le solde de la boutique est sufisant pour tout renbour
            if($solde_boutique >= $reste_montan ){
                // retire le montant dans la boutique
                $stmt = $bd->prepare('UPDATE boutique SET solde = solde - ? WHERE id = ? ');
                $stmt->execute(array($reste_montan, $id_boutique));
                // insere montant retire 
                $stmt = $bd->prepare("INSERT INTO boutique_verse ( id_boutique_reste, montant, date_envoy) VALUES (?,?,?)");
                $stmt->execute(array( $id_boutique_reste ,$reste_montan, $date_transaction));
                // valide la fin de la dete 
                $etat = 'oui';
                $stmt = $bd->prepare('UPDATE boutique_reste SET etat = ? WHERE id = ? ');
                $stmt->execute(array($etat, $id_boutique_reste) );

                if ($stmt->rowCount() === 0) {
                    throw new Exception("Échec de la mise à jour des comptes.");
                }else{
                    $stmt->closeCursor();
                    header("refresh:1");
                }
            }else{
                // insere montant retire 
                $stmt = $bd->prepare("INSERT INTO boutique_verse ( id_boutique_reste, montant, date_envoy) VALUES (?,?,?)");
                $stmt->execute(array( $id_boutique_reste ,$solde_boutique, $date_transaction));

                // retire le montant dans la boutique
                $soldeb = 0;
                $stmt = $bd->prepare('UPDATE boutique SET solde = ? WHERE id = ? ');
                $stmt->execute(array($soldeb, $id_boutique));

                if ($stmt->rowCount() === 0) {
                    throw new Exception("Échec de la mise à jour des comptes.");
                }else{
                    $stmt->closeCursor();
                    header("refresh:1");
                }
            }

        }else{
            // si rien na ete verce et que le quonte n'est pas vide

            if($solde_boutique >= $montant ){
                 // retire le montant dans la boutique
                 $stmt = $bd->prepare('UPDATE boutique SET solde = solde - ? WHERE id = ? ');
                 $stmt->execute(array($montant, $id_boutique));
                 // insere montant retire 
                $stmt = $bd->prepare("INSERT INTO boutique_verse ( id_boutique_reste, montant, date_envoy) VALUES (?,?,?)");
                $stmt->execute(array( $id_boutique_reste ,$montant, $date_transaction));
                // valide la fin de la dete 
                $etat = 'oui';
                $stmt = $bd->prepare('UPDATE boutique_reste SET etat = ? WHERE id = ? ');
                $stmt->execute(array($etat, $id_boutique_reste) );

                if ($stmt->rowCount() === 0) {
                    throw new Exception("Échec de la mise à jour des comptes.");
                }else{
                    $stmt->closeCursor();
                    header("refresh:1");
                }

            }else{
                 // insere montant retire 
                 $stmt = $bd->prepare("INSERT INTO boutique_verse ( id_boutique_reste, montant, date_envoy) VALUES (?,?,?)");
                 $stmt->execute(array( $id_boutique_reste ,$solde_boutique, $date_transaction));
 
                 // retire le montant dans la boutique
                 $soldeb = 0;
                 $stmt = $bd->prepare('UPDATE boutique SET solde = ? WHERE id = ? ');
                 $stmt->execute(array($soldeb, $id_boutique));
 
                 if ($stmt->rowCount() === 0) {
                     throw new Exception("Échec de la mise à jour des comptes.");
                 }else{
                     $stmt->closeCursor();
                     header("refresh:1");
                 }
            }
        }
    }
}
}
?>