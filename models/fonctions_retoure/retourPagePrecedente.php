<?php 
function retourPagePrecedente($fallback = '/Kephale/accueil') {
    $nom_COOKIE = $_GET["url"];

    // Vérifie si une page précédente est définie
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $urlPrecedente = htmlspecialchars($_SERVER['HTTP_REFERER']);
        $valeur = $urlPrecedente;
        $expiration = time() + (30 * 24 * 60 * 60); // 30 jours
        if(empty($_COOKIE[$nom_COOKIE])){
            setcookie($nom_COOKIE, $valeur, $expiration);
            header("Refresh: 0");
        }
        if(isset($_COOKIE[$nom_COOKIE])){
            echo "";
        }
        //

    } else {
        // Si pas de referer, lien de secours
        if(isset($_COOKIE[$nom_COOKIE])){
            echo "<a class ='lin_connect' href=\"$_COOKIE[$nom_COOKIE]\"><img class='retoure'  src='public/asset/_icone/retoure.svg' ></a>";
        }
    }
}