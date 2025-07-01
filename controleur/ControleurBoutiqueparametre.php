<?php  

if(isset($_SESSION["id"]) and isset($_SESSION["id_boutique"])){
        $info_psa = info_psa($bd);
        $client = 'client';
        $boutique = 'boutique';

        if($info_psa ===  $client ){
            $psas = 'Client';
            $contenu = "Le pourcentage sur achat est pris en charge par votre client, vous pouvez le mettre à votre compte en cliquant sur 'Modifier psa'.";
        }elseif($info_psa ===  $boutique ){
            $psas = 'Boutique';
            $contenu = "Le pourcentage sur achat est pris en charge par votre boutique, vous pouvez le modifier à au compte du client en cliquant sur 'Modifier psa'.";
        }

        if(isset($_POST["modifie_psa"])){
            if($info_psa ===  $client ){
                $new_psa = 'boutique';
            }elseif($info_psa ===  $boutique ){
                $new_psa = 'client';
            }
            inser_new_psa($bd,$new_psa );
        }

        $info_boutique = info_boutique ($bd); 
        $local_boutique = local_boutique ($bd); 
}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil');
}

// Supprime une clé spécifique (par exemple : 'user_id')
//if (isset($_SESSION['user_id'])) {
 //   unset($_SESSION['user_id']);
//}

            ?>