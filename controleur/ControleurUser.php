<?php
//$_SESSION = array();
//session_destroy();

//voir la session est id_user est declare
if(isset($_SESSION["id"])){
    //Inporte le doc dans model pour tout les recquet de la basse de done
    $model_user = "../models/".$controleur."Manager.php";
    if(file_exists($model_user)){
        require_once ($model_user);
        require_once ('../models/solde_affiche/solde.php');
        //recupere les info de ulitilisteur
        $infoUser = infoUser($bd);
        //Verifie si l'utilisateur a une boutique
        $userBoutiqueEtat = infoUserBoutiqu($bd);
        // bodie lafissage du solde
        $userSolde = solde ($infoUser["solde"]) ;
    }
















//importe page user
    $userpage = "../views/".$controleur."Page.php";
    if(file_exists($userpage)){
        require_once ($userpage);
    }else{
       echo 'Page_introuvable';
    }

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}
   

    ?>