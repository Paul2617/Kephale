<?php  
function info_categorie($bd, $id_categorie){
    $stmt = $bd->prepare("SELECT * FROM categorie WHERE id = ? ");
    $stmt->execute([ $id_categorie ]);
    if ($stmt->rowCount() > 0){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $info_stmt["nom"];
        $img = $info_stmt["img"];
        $types = $info_stmt["types"];

        $info = 
        [
            "nom_categorie" =>  $nom ,
            "types_categorie" =>  $types ,
            "img_categorie" =>  $img 
        ];
        return $info;
    }
}

function new_nom_categorie($bd, $new_nom_categorie,  $id_categorie){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE categorie SET nom = ? WHERE id = ? AND id_boutique LIKE ?  ');
    $stmt->execute(array($new_nom_categorie, $id_categorie, $id_boutique));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}

function  new_img_categori_final($bd, $new_img_categori_finale, $id_categorie){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare('UPDATE categorie SET img = ? WHERE id = ?  AND id_boutique LIKE ? ');
    $stmt->execute(array($new_img_categori_finale, $id_categorie, $id_boutique));

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la mise à jour des comptes.");
    }else{
        $stmt->closeCursor();
        header("refresh:1");
        //header ('Location: /Kephale/boutique'  );
    }
}
?>