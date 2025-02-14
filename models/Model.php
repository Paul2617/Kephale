<?php
  // requet de tout une table
   function recTable ( $bd, $table){
    $rec =  $bd->prepare(' SELECT * FROM '.$table.' ORDER BY id desc ');
    $rec->execute();
    $data = $rec->fetch(PDO::FETCH_ASSOC);

    return  $data;
    $rec->closeCursor();
}

  // requet table en fonction de id
function recTableId ($bd, $table, $id){
    $rec =  $bd->prepare('SELECT * FROM '.$table.' WHERE id = ?');
    $rec->execute(array($id));
    $data = $rec->fetch(PDO::FETCH_ASSOC);

    return  $data;
    $rec->closeCursor();
}
    ?>