<?php

//inporte la transactions
require_once ('../models/bd/transaction.php');

function info_abonnement ($bd){
  return recTableId($bd, 'offre', 'id', $_GET["id_abt"]);
}
function info_user ($bd){
  return recTableId($bd, 'user', 'id', $_SESSION["id"]);
}
function transactionsgratui($bd){
  return $inserabonnemnt = inserabonnemnt($bd);
}
function transactions($bd,$montant, $id_abt ){
  return  $transactionKephale = transactionAbonnement($bd, $montant, $id_abt);
}
?>