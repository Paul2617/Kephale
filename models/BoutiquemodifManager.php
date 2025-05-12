<?php  
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


function new_nom_boutque($bd, $new_nom_boutque){

   $stmt = $bd->prepare('UPDATE boutique SET nom = ? WHERE id = ? ');
   $stmt->execute(array($new_nom_boutque, $_SESSION["id_boutique"]));

   if ($stmt->rowCount() === 0) {
    throw new Exception("Échec de la mise à jour des comptes.");
}else{
    $stmt->closeCursor();
    header("refresh:1");
}
}

function new_img_boutque_final($bd, $new_img_boutque_finale){

    $stmt = $bd->prepare('UPDATE boutique SET img = ? WHERE id = ? ');
    $stmt->execute(array($new_img_boutque_finale, $_SESSION["id_boutique"]));
 
    if ($stmt->rowCount() === 0) {
     throw new Exception("Échec de la mise à jour des comptes.");
 }else{
     $stmt->closeCursor();
     header("refresh:1");
 }
}
?>