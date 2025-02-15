<?php
require_once ('../models/Cntbd.php');
$Cntbd = new Cntbd();
$bd = $Cntbd->bd();

// count() pour compt
  // requet de tout une table
   function recTable ( $bd, $table){
    $rec =  $bd->prepare(' SELECT * FROM '.$table.' ORDER BY id desc ');
    $rec->execute();
    return  $rec->fetchAll(PDO::FETCH_ASSOC);
    $rec->closeCursor();
}

  // requet table en fonction de id
function recTableId ($bd, $table, $id){
    $rec =  $bd->prepare('SELECT * FROM '.$table.' WHERE id = ?');
    $rec->execute(array($id));
    return  $rec->fetchAll(PDO::FETCH_ASSOC);;
    $rec->closeCursor();
}

    ?>