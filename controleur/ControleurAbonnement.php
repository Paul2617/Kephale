<?php

if(isset($_SESSION["id"])){
        $recupListAbonnement = recupListAbonnement($bd);
    
//importe page 

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
?>
