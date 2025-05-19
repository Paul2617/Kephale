<?php  
function info_user ($bd){
    $id_user = $_SESSION["id"];
    $stmt = $bd->prepare("SELECT * FROM user WHERE id = ? ");
    $stmt->execute([ $id_user ]);
    if ($stmt->rowCount() > 0){
        $info_stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $info_stmt["nom"];
        $img = $info_stmt["img"];
        $tel = $info_stmt["tel"];
        $sexe = $info_stmt["sexe"];
if($sexe === 'homme'){
    $sex = 'Homme';
}elseif($sexe === 'femme'){
    $sex = 'Femme';
}else{
    $sex = 'Enfant';
}
        $info = 
        [
            "nom_user" =>  $nom ,
            "img_user" =>  $img ,
            "tel_user" =>  $tel ,
            "sexe_user" =>  $sex 
        ];
        return $info ;
    }
}

?>