<?php 
$uuid = new generate_uuid();
$inscription = new inscription();
$uuid_32 = $uuid->generateUUIDv4();
$uuid_5 = $uuid->generateShortSlug($uuid_32);
$valideNumereau = $inscription->valideNumereau($numerau_user);
if($valideNumereau !== false){

     $erreur = $valideNumereau;

}else{

if($uuid_32 !== null AND $uuid_5 !== null  ){
$enregistrement = $inscription->enregistrement($uuid_5, $uuid_32, $nom_user, $numerau_user, $password_user, $sexe, $imgNom);

if($enregistrement === true){
 if($imgNom !== 'logo.png'){
  if(move_uploaded_file($_FILES["img_demande"]["tmp_name"], $imgDirection)){
        header ('Location: /Kephale/connection');
    }
 }else{
         header ('Location: /Kephale/connection');
 }
}
}

}





?>