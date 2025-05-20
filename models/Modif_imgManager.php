<?php  

function recupeTousLesImg ($bd, $id_article ){
   $id_boutique = $_SESSION["id_boutique"];
   $stmt = $bd->prepare("SELECT * FROM images_article WHERE article_id = ? AND id_boutique LIKE ? ");
   $stmt->execute([ $id_article,  $id_boutique ]);
    if ($stmt->rowCount() > 0){
         $info_img = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $info_img ;
    }else{
        return null ;
    }
}

function recupeUneImg ($bd, $id_article ){
   $id_boutique = $_SESSION["id_boutique"];
   $stmt = $bd->prepare("SELECT nom_image FROM images_article WHERE article_id = ? AND id_boutique LIKE ? LIMIT 1");
   $stmt->execute([ $id_article,  $id_boutique ]);
    if ($stmt->rowCount() > 0){
         $info_img = $stmt->fetch(PDO::FETCH_ASSOC);
         $img =   $info_img ["nom_image"];
         return $img ;
    }else{
        return 'logo.png';
    }
}

function supprimeImg($bd,  $id_imgs ,$id_article ){
    $id_boutique = $_SESSION["id_boutique"];
    $stmt = $bd->prepare("DELETE FROM images_article WHERE id = ? AND id_boutique LIKE ? AND   article_id LIKE ?");
    if($stmt->execute(array($id_imgs, $id_boutique, $id_article )))
      header("refresh:1");
}
?>