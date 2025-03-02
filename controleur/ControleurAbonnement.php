<?php

if(isset($_SESSION["id"])){

   
        require_once ($model);
        $recupListAbonnement = recupListAbonnement($bd);
    





//importe page 

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
?>
