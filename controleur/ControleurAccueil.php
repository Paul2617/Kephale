<?php
// requet data basse
        $model = "../models/".$controleur."Manager.php";
        if(file_exists($model)){
            require_once ($model);
        }
        //definitin de leta de licon connection et lin
        if(isset($_SESSION["id"])){
            $icon = 'user';
        }else{
            $icon = 'connection';
            
        }


// affiche page accuil
        $pageAccuiel = "../views/".$controleur."Page.php";
        if(file_exists($pageAccuiel)){
            require_once ($pageAccuiel);
        }
?>