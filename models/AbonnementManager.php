<?php
require_once ('../models/bd/Model.php');

function recupListAbonnement($bd){
  return  recTable ( $bd, 'offre');
}
?>