<?php
// Durée du cookie (7 jours)
$cookieDuration = time() + (86400 * 7);

// Récupérer l'URL actuelle
$currentUrl = $_SERVER['REQUEST_URI'];

// Récupérer get url des page
$nomPageactule = $_GET['url'];

// Récupérer l'URL avant
if(isset($_SERVER['HTTP_REFERER'])){
    $urlPrecedente = htmlspecialchars($_SERVER['HTTP_REFERER']);
    if(empty($_SESSION[$nomPageactule])){
        $_SESSION[$nomPageactule] =  $urlPrecedente;
        setcookie($nomPageactule , $urlPrecedente , $cookieDuration, '/');
    }else{
        if($urlPrecedente !== $_SESSION[$nomPageactule]){
            if($nomPageactule === 'boutiquepub'){

            }elseif($nomPageactule === 'articleplus') {
            }else{
                $_SESSION[$nomPageactule] =  $urlPrecedente;

            }
        }
    }
}

function getLastPage() {
    $nomPageactule = $_GET['url'];
   
        if(isset($_SESSION[$nomPageactule])){
            return  $_SESSION[$nomPageactule];
        }else{
            return '/Kephale/user';
        }
    

}



// Mettre à jour le cookie
// setcookie('navigation_history', json_encode($history), $cookieDuration, '/');

// Fonction pour obtenir la dernière page visitée
//setcookie('navigation_history', '', time() - 3600, '/');
//$_COOKIE['navigation_history']
?>
