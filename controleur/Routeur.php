<?php
class Routeur
{
    public function routePublic(){
         //Chargement automatique des class du doc models
            $url = '';
             if(isset($_GET["url"])){
                $url = explode('/', filter_var($_GET["url"], FILTER_SANITIZE_URL ));
                // on recuper le premie parametre de url et mes la premier letre en maguscule
                $nomFiche = ucfirst(strtolower( $url[0]));
                // definir le nom du controleur
                $controleurFiche = "Controleur".$nomFiche;
                $modelsFiche = $nomFiche."Manager";
                $viewsFiche =  $nomFiche."Page";
                // definire le chemin du controleur
                $controleur = "../controleur/".$controleurFiche.".php";
                $models = "../models/".$modelsFiche.".php";
                $views = "../views/".$viewsFiche.".php";
                
                if(file_exists($models)){
                    require_once ("../models/bd/Cntbd.php");
                    $Cntbd = new Cntbd();
                    $bd = $Cntbd->bd();
                    require_once ("../models/bd/Model.php");
                    require_once ($models);
                }
                if(file_exists($controleur)){
                    require_once ($controleur);
                    if(file_exists($views)){
                        require_once ($views);
                    }else{
                        echo 'Page introuveble';
                    }
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