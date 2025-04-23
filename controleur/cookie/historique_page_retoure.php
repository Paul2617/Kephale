<?php
// Durée du cookie (7 jours)
$cookieDuration = time() + (86400 * 7);

// Récupérer l'URL actuelle
$currentUrl = $_SERVER['REQUEST_URI'];

// Récupérer get url des page
$nomPageactule = $_GET['url'];

// Récupérer l'URL avant

if($nomPageactule === 'articleplus'){
    $page_suivant = 'articles';
}elseif($nomPageactule === 'produitplus'){
    $page_suivant = 'articleplus';
}elseif($nomPageactule === 'listeproduit'){
    $page_suivant = 'listearticle';
}elseif($nomPageactule === 'listearticle'){
    $page_suivant = 'articles';
}elseif($nomPageactule === 'boutiquepub'){
    $page_suivant = 'produitplus';
}elseif($nomPageactule === 'articles'){
    $page_suivant = 'facture';
}elseif($nomPageactule === 'facture'){
    $page_suivant = 'listeachat';
}

if(isset($_SESSION[$_GET['url']])){
    if(isset( $_SERVER['HTTP_REFERER'])){
        $urlPrecedente = htmlspecialchars($_SERVER['HTTP_REFERER']);
    // url presedant est diferant de la session actuel
    if($urlPrecedente !== $_SESSION[$_GET['url']]){
        // si la page actuel a une session
        if(isset($_SESSION[$_GET['url']])){
              // si le mon de la page suivant n'est pas dans la page presedant 
            if (stripos($urlPrecedente, $page_suivant ) === false){
                // si le mon de la page actuel n'est pas dans la page presedant 
                if (stripos($urlPrecedente, $_GET['url']) === false){
                        $_SESSION[$_GET['url']] =  $urlPrecedente ;
                }
            }

        }
    }
    }else{
       
    }
}else{

    if(isset( $_SERVER['HTTP_REFERER'])){
    $urlPrecedente = htmlspecialchars($_SERVER['HTTP_REFERER']);
    $_SESSION[$_GET['url']] =  $urlPrecedente;}
    
}


function getLastPage() {
    if(isset($_SESSION[$_GET['url']])){
        return $_SESSION[$_GET['url']];
    }else{
        return 'null';
    }
       
}



// Mettre à jour le cookie
// setcookie('navigation_history', json_encode($history), $cookieDuration, '/');

// Fonction pour obtenir la dernière page visitée
//setcookie('navigation_history', '', time() - 3600, '/');
//$_COOKIE['navigation_history']
?>
