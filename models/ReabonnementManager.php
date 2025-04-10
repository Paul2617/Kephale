<?php
// recuper le montant de l'abonnelent
function recAbonnement($bd){
    $listeAbnnt = recTableId($bd, 'abonnement','id_user', $_SESSION["id"]);
    $listeAbnnt ["id_offre"];
    $infoOffre = recTableId($bd, 'offre','id', $listeAbnnt ["id_offre"]);
    $montant = $infoOffre ["montant"];
    return $montant;
}

function verifi_code_et_solde($bd, $password_user_encode, $montant_abt){
    $id = $_SESSION["id"];
    $rec = $bd->prepare("SELECT * FROM user WHERE code = ? AND id LIKE '$id' ");
    $rec->execute(array($password_user_encode));
    //verifie si le code est bon
    if($rec->rowCount() === 1){
        $result =  $rec->fetch(PDO::FETCH_ASSOC);
        $solde_user = $result['solde'];
        // verifie si le sode est bon
        if($solde_user >= $montant_abt){
            return 'ok';
        }else{
            return 'solde';
        }
    }else{
        return 'null';
    }
}

function transactions($bd, $montant_abt){
    $id = $_SESSION["id"];
    $new_date = time();
    $new_fin_adnt =    $new_date + "2592000";

    // Retirer de montant du compte de utilisateur
    $stmt = $bd->prepare("UPDATE user SET solde = solde - ? WHERE id = ? ");
    if($stmt->execute(array($montant_abt, $id))){
            // Ajoute le montant sur le compte de kephale
            $id_kephale = "2025777333";
            $stmt = $bd->prepare("UPDATE kephale SET solde = solde + ? WHERE api = ? ");
            if($stmt->execute(array($montant_abt, $id_kephale))){
                $inser_date = $bd->prepare("UPDATE abonnement SET date_debut = ?, date_fin = ? WHERE id_user = ? ");
                if($inser_date->execute(array($new_date, $new_fin_adnt, $id))){
                    $motif = 'Abonnement';
                    $date_transaction = time();
                    $stmt = $bd->prepare("INSERT INTO transactions (id_deduit, id_ajout, montant, motif, date_transaction ) VALUES (?,?,?,?,?)");
                    $stmt->execute(array($_SESSION["id"],  $id_kephale, $montant_abt, $motif , $date_transaction));
                     return 'ok';
                     $stmt->closeCursor();
                }
            }
           
    }

  
}
?>