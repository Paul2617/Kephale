<?php
class Routeur 
{
    private $crtl;
    private $view;
     
    public function routePublic(){
         //Chargement automatique des class du doc models
         try {
            spl_autoload_register(function($class){
                $chemain = '../models/'.$class.'.php';
                if(file_exists($chemain)){

                }else{

                    echo  $chemain;
                }
            });
            
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

                    $this->crtl = new $controleurClass($url);
                }else{
                    throw new \Exception("Page introuvable", 1);
                }
             }else{
                echo 'Erreur 404';
             }
            //code...
         } catch (\Throwable $e) {
            echo "";
            $erreur = $e->getMessage();
         }
    }
}
    ?>