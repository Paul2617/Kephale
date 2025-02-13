<?php
function info_user ()
{
    $liste_produit = [
        'id' =>  '1',
        'id_boutique' =>  '2',
        'type' =>  'Homme',
        'img' =>  'img.jpg'
    ] ;
    $liste_articl = [
        'id' =>  '139',
        'id_boutique' =>  '382922',
        'type' =>  'Homme_EJEJ',
        'img' =>  'img.jpg'
    ] ;
    $url = [   $liste_produit ,    $liste_articl  ] ;
    return $url ;
}

$info_user = info_user ();

    ?>