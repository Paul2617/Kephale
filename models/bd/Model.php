<?php
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
    $rec =  $bd->prepare('SELECT * FROM '.$table.' WHERE '.$colone.' = ? ORDER BY  id DESC ');
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

//Ferifie panier
function panierVerifi ($bd, $id_user, $id_article){
  $rec = $bd->prepare('SELECT * FROM panie WHERE id_user = ? and id_article = ? ');
  $rec->execute(array($id_user, $id_article));
  return $rec->rowCount();
  $rec->closeCursor();
}
//requet inser abonnemnt
function inserabonnemnt($bd){
  $etat = '1';
  $date_transaction = time();
  $date_fin =    $date_transaction + "2592000";
  $stmt = $bd->prepare("INSERT INTO abonnement (id_user, id_offre, date_debut, date_fin, etat) VALUES (?,?,?,?,?)");
  $stmt->execute(array($_SESSION["id"],$_GET["id_abt"],$date_transaction, $date_fin, $etat));

  return true ;
}
// requt boutique type homme

function recherche($bd, $type, $colone, $ORDER_BY){
  $rec = $bd->query("SELECT 
  categorie.id AS categorie_id, 
  categorie.nom AS categorie_nom,
  categorie.img AS categorie_img, 
  categorie.types AS categorie_types, 

  boutique.id AS boutique_id, 
  boutique.nom AS boutique_nom,
  boutique.img AS boutique_img, 
  boutique.pays AS boutique_pays

  FROM categorie INNER JOIN boutique ON categorie.id_boutique = boutique.id WHERE categorie.types LIKE '$type' ORDER BY $colone $ORDER_BY ");


  return $rec;
  $rec->closeCursor();
}

// requt boutique type homme

function rechercheBoutique ($bd, $type, $rech){
  $rec = $bd->query("SELECT 
  categorie.id AS categorie_id, 
  categorie.nom AS categorie_nom,
  categorie.img AS categorie_img, 
  categorie.types AS categorie_types, 

  boutique.id AS boutique_id, 
  boutique.nom AS boutique_nom,
  boutique.img AS boutique_img, 
  boutique.pays AS boutique_pays

  FROM categorie INNER JOIN boutique ON categorie.id_boutique = boutique.id WHERE categorie.types LIKE '$type' and boutique.nom LIKE  '%$rech%'  ORDER BY categorie.id DESC ");


  return $rec;
  $rec->closeCursor();
}
    ?>