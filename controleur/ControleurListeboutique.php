<?php
// si rec egsiste ou pas 
 if (isset($_GET["rc"]) and !empty($_GET["rc"])) {}else{   header ('Location: /Kephale/accueil');}

 // determine l'ordre du resulta
 //declarations de la actualise
 if (isset($_SESSION["actualise"])) {
    $_SESSION["actualise"]++;
    if ($_SESSION["actualise"] >= 17) {
        $_SESSION["actualise"] = 0;
    }
} else {
    $_SESSION["actualise"] = 0;
}
 //determin les hordre d'actualisation
if ($_SESSION["actualise"] === 0 || $_SESSION["actualise"] <= 2) {
    $colone = 'categorie.id';
    $ORDER_BY = 'DESC';
} elseif ($_SESSION["actualise"] || 3 and $_SESSION["actualise"] <= 5) {
    $colone = 'categorie.id';
    $ORDER_BY = 'ASC';
} elseif ($_SESSION["actualise"] || 6 and $_SESSION["actualise"] <= 8) {
    $colone = 'categorie.nom';
    $ORDER_BY = 'DESC';
} elseif ($_SESSION["actualise"] || 9 and $_SESSION["actualise"] <= 12) {
    $colone = 'categorie.nom';
    $ORDER_BY = 'ASC';
} elseif ($_SESSION["actualise"] || 13 and $_SESSION["actualise"] <= 16) {
    $colone = 'categorie.id_boutique';
    $ORDER_BY = 'DESC';
}


        $type = $_GET["rc"];
        if (isset($_POST["recherche"]) and !empty($_POST["recherche"])) {
            $rech = htmlspecialchars($_POST["recherche"]);
            $listBoutiqueType = listBoutique($bd, $type, $rech);
        }else{
            // rec liste boutique type 
            $listBoutiqueType = listBoutiqueType ($bd, $type, $colone, $ORDER_BY);
            

        }
    




























?>