<?php 
function retourPagePrecedente($fallback = '/Kephale/accueil') {
    // Vérifie si une page précédente est définie
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $urlPrecedente = htmlspecialchars($_SERVER['HTTP_REFERER']);
        $nom_COOKIE = $_GET["url"];
        $valeur = $urlPrecedente;
        $expiration = time() + (30 * 24 * 60 * 60); // 30 jours
        if(isset($_COOKIE[$nom_COOKIE])){
        echo "<a class ='lin_connect' href=\"$_COOKIE[$nom_COOKIE]\"><img src='public/asset/_icone/retoure.svg' ></a>";
        }else{
            setcookie($nom_COOKIE, $valeur, $expiration);
            header("Refresh: 1");
        }
        //

    } else {
        // Si pas de referer, lien de secours
        echo "<a href=\"$fallback\">⬅ Retour</a>";
    }
}