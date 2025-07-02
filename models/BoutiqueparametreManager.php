<?php  

function info_psa($bd) {
    $id_boutique = $_SESSION["id_boutique"];
    $stmts = $bd->prepare("SELECT psa FROM boutique WHERE id = ? ");
    $stmts->execute([ $id_boutique ]);
    $rowCount = $stmts->rowCount() ;
    if ( $rowCount > 0){
    $info_stmt = $stmts->fetch(PDO::FETCH_ASSOC);
    $client = 'client';
    $boutique = 'boutique';
    $etat = $info_stmt["psa"]; 
    return  $etat ;
    }else{
    return false;
    }
}
function inser_new_psa($bd,$new_psa ){

    $stmt = $bd->prepare('UPDATE boutique SET psa = ? WHERE id = ? ');
    $stmt->execute(array($new_psa, $_SESSION["id_boutique"]));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
    }
}

function info_boutique ($bd){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare("SELECT * FROM boutique WHERE id = ? ");
    $stmt->execute([ $id_boutique ]);
    if ($stmt->rowCount() > 0){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $info_stmt["nom"];
        $img = $info_stmt["img"];
        $pays = $info_stmt["pays"];

        $info = 
        [
            "nom_boutique" =>  $nom ,
            "img_boutique" =>  $img ,
            "pays_boutique" =>  $pays 
        ];
        return $info ;
    }
}

function local_boutique ($bd){
    $id_boutique = $_SESSION["id_boutique"];
     $local = 'boutique';
    $stmt = $bd->prepare("SELECT adresse FROM localisations WHERE id_boutique = ? AND local LIKE 'boutique' ");
    $stmt->execute([ $id_boutique ]);
    if ($stmt->rowCount() === 1){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $adresse = $info_stmt["adresse"];
        return $adresse ;
    }else{
         return false;
    }
}
            ?>