<?php
// verifications de input
if (isset($_POST["inscrire"]) and !empty($_POST["inscrire"])){
    if (isset($_POST["nom_user"]) and !empty($_POST["nom_user"])){
        $nom_user = htmlspecialchars($_POST["nom_user"]);
        if (isset($_POST["numeraux_user"]) and !empty($_POST["numeraux_user"])){
            $numerau_user = htmlspecialchars($_POST["numeraux_user"]);
            if (isset($_POST["password_user"]) and !empty($_POST["password_user"])){
                $password_user = htmlspecialchars($_POST["password_user"]);
                if (isset($_POST["password_user_2"]) and !empty($_POST["password_user_2"])){
                    $password_user_2 = htmlspecialchars($_POST["password_user_2"]);
                    if($password_user ===  $password_user_2 ){
                        if (isset($_POST["category"]) and !empty($_POST["category"])){
                            $category = htmlspecialchars($_POST["category"]);
                            $veirif = true;
                        }else{
                            $erreur = "Veuillez indiquer votre genre.";
                        }
                    }else{
                        $erreur = "Les deux mots de passe ne sont pas similaires.";
                    }
                }else{
                    $erreur = "Veuillez confirmer votre mot de passe.";
                }
            }else{
                $erreur = "Veuillez indiquer votre mot de passe.";
            }
        }else{
            $erreur = "Veuillez indiquer votre numéro de téléphone.";
        }
    }else{
        $erreur =  "Veuillez indiquer votre nom complet.";
    }
}



// si tout les informentions son inquique
    if(isset($veirif )){
        //inser les informations
   
    $resulte = inscription($bd, $nom_user, $numerau_user, $password_user, $category );

    if($resulte === 'numero_existe'){
        $erreur = "Veuillez indiquer un autre numéro de téléphone.";
    }elseif($resulte === 'ok'){
        header ('Location: /Kephale/connection'  );
    }
    }




?>