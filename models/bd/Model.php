<?php
require_once ('../models/bd/Cntbd.php');
$Cntbd = new Cntbd();
$bd = $Cntbd->bd();
// count() pour compt
  // requet de tout une table
   function recTable ( $bd, $table){
    $rec =  $bd->prepare(' SELECT * FROM '.$table.' ORDER BY id  ');
    $rec->execute();
    return  $rec->fetchAll(PDO::FETCH_ASSOC);
    $rec->closeCursor();
}

  // requet table en fonction de id
function recTableId ($bd, $table, $colone, $id){
    $rec =  $bd->prepare('SELECT * FROM '.$table.' WHERE '.$colone.' = ? ');
    $rec->execute(array($id));
    return  $rec->fetch(PDO::FETCH_ASSOC);
    $rec->closeCursor();
}

  // requet table en fonction de id
  function recTableIdBoucle ($bd, $table, $colone, $id){
    $rec =  $bd->prepare('SELECT * FROM '.$table.' WHERE '.$colone.' = ? ');
    $rec->execute(array($id));
    return  $rec->fetchAll(PDO::FETCH_ASSOC);
    $rec->closeCursor();
}

//requet ferif numero
function recRowCount($bd, $table, $colone, $id){
  $rec = $bd->prepare('SELECT * FROM '.$table.' WHERE '.$colone.' = ?');
  $rec->execute(array($id));
  return $rec->rowCount();
  $rec->closeCursor();
}
//requet inser abonnemnt
function inserabonnemnt($bd){
  $etat = '1';
  $date_transaction = time();
  $date_fin =    $date_transaction + "2592000";
  $stmt = $bd->prepare("INSERT INTO abonnement (id_user, id_offre, date_debut, date_fin, etat) VALUES (?,?,?,?,?)");
  $stmt->execute(array($_SESSION["id"],$_GET["id_abt"],$date_transaction, $date_fin, $etat ));
  return true ;
}

    ?>