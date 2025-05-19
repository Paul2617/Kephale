<?php  
function info_produit($bd, $id_produit, $id_categorie){
    $stmt = $bd->prepare("SELECT * FROM produit WHERE id = ? ");
    $stmt->execute([ $id_produit ]);
    if ($stmt->rowCount() > 0){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $info_stmt["nom"];
        $img = $info_stmt["img"];
        $types = $info_stmt["types"];

        $info = 
        [
            "nom_produit" =>  $nom ,
            "types_produit" =>  $types ,
            "img_produit" =>  $img 
        ];
        return $info;
    }
}

function new_nom_produit($bd, $new_nom_produit,  $id_produit){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE produit SET nom = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($new_nom_produit, $id_produit, $id_boutique ));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}

function new_types_produit($bd, $new_types_produit,  $id_produit){
 $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE produit SET types = ? WHERE id = ? AND id_boutique LIKE ? ');
    $stmt->execute(array($new_types_produit, $id_produit,  $id_boutique ));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}

function  new_img_produit_final($bd, $new_img_produit_finale, $id_produit){
$id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE produit SET img = ? WHERE id = ? AND id_boutique LIKE ?');
    $stmt->execute(array($new_img_produit_finale, $id_produit, $id_boutique ));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}
?>