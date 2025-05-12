<?php  

function info_psa($bd) {
    $id_boutique = $_SESSION["id_boutique"];
    $stmts = $bd->prepare("SELECT * FROM psa WHERE id_boutique = ? ");
    $stmts->execute([ $id_boutique ]);
    $rowCount = $stmts->rowCount() ;
    if ( $rowCount > 0){
    $info_stmt = $stmts->fetch(PDO::FETCH_ASSOC);
    $client = 'client';
    $boutique = 'boutique';
    $etat = $info_stmt["etat"]; 
    return  $etat ;
    }else{
    return false;
    }
}
function inser_new_psa($bd,$new_psa ){

    $stmt = $bd->prepare('UPDATE psa SET etat = ? WHERE id_boutique = ? ');
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

            ?>