<?php
echo 'boutique';
if(isset($_SESSION["id"])){
    if(isset($_SESSION["id_boutique"])){
        $model = "../models/".$controleur."Manager.php";
        if(file_exists($model)){
            require_once ($model);
        }
        














        $page = "../views/".$controleur."Page.php";
        if(file_exists($page)){
            require_once ($page);
        }else{
           echo 'Page_introuvable';
        }
    }else{
        header ('Location: /Kephale/look');
    }

}else{
    $_SESSION = array();
    session_destroy();
    header ('Location: /Kephale/accueil'  );
}


?>