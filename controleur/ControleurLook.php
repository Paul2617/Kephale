<?php
if(isset($_SESSION["id"])){
    if (isset($_POST["confirme"]) and !empty($_POST["confirme"])){
        if (isset($_POST["password_user"]) and !empty($_POST["password_user"])){
            $passwor_usre = htmlspecialchars($_POST["password_user"]);

        }else{
            $erreur = 'Veuillez saisir votre mot de passe.';
        }
    }



        if(isset($passwor_usre)){
            $verifiCode =  verifiCode ($bd, $passwor_usre);
            if($verifiCode === true){
                $activeSessionBoutique = activeSessionBoutique ($bd);
                if( $activeSessionBoutique === true){
                    if(isset($_SESSION["id_boutique"])){
                        header ('Location: /Kephale/boutique'  );
                    }
                }
            }elseif($verifiCode === false){
                $erreur = 'Mot de passe incorrect !';
            }
        }
      



















}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
  

?>