<?php
require_once ('../models/Model.php');


class Routeur 
{
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function routePublic(){
         //Chargement automatique des class du doc models
            $url = '';
             if(isset($_GET["url"])){
                $url = explode('/', filter_var($_GET["url"], FILTER_SANITIZE_URL ));
                // on recuper le premie parametre de url et mes la premier letre en maguscule
                $controleur = ucfirst(strtolower( $url[0]));
                // definir le nom du controleur
                $controleurClass = "Controleur".$controleur;
                // definire le chemin du controleur
                $controleurDoc = "../controleur/".$controleurClass.".php";
                if(file_exists($controleurDoc)){
                    require_once ($controleurDoc);

                }else{
                    header ('Location: /Kephale/accueil'  );
                }
             }else{
                echo 'pas url';
                //header ('Location: Kephale/accueil' );
             }
            //code...
        
    }
}

    ?>