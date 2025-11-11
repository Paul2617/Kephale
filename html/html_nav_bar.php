<?php
class html_nav_bar 
{
public function __construct ($info){
    if($info === 'parametre'){ $parametre = 'parametres_.svg'; $parametreC = '#1d70b7';
    }else{$parametre = 'parametres.svg'; $parametreC = '#303030ff';}

    if($info === 'home'){ $home = 'home.svg'; $homeC = '#1d70b7';
    }else{$home = 'accueil.svg'; $homeC = '#303030ff';}

     if($info === 'user'){ $user = 'user_.svg'; $userC = '#1d70b7';
    }else{$user = 'user.svg'; $userC = '#303030ff';}

     if($info === 'restaurant'){ $restaurant = 'restaut_.svg'; $restaurantC = '#1d70b7';
    }else{$restaurant = 'restaut.svg'; $restaurantC = '#303030ff';}

    if($info === 'plus'){ $plus = 'chine_.svg'; $plusC = '#ca0c0cff';
    }else{$plus = 'chine.svg'; $plusC = '#303030ff';}

     echo <<<HTML
     <section class='menu_barre_bloc' >
        <a class='icon_link_bloc' href="/home">
             <img class="icon_menu" width="27" height="27" src="/assets/icons/$home" alt="">
             <p class='p_icon' style='color: $homeC'>Kephalé</p>
        </a> 
        <a class='icon_link_bloc' href="/restaurant">
             <img class="icon_menu" width="27" height="27" src="/assets/icons/$restaurant " alt="">
             <p class='p_icon' style=' color: $restaurantC '>Restaurant</p>
        </a>
        <a class='icon_link_bloc' href="/user">
             <img class="icon_menu" width="27" height="27" src="/assets/icons/$user " alt="">
             <p class='p_icon' style='color: $userC'>Profil</p>
        </a>
        <a class='icon_link_bloc' href="/boutique">
             <img class="icon_menu" width="27" height="27" src="/assets/icons/$plus " alt="">
             <p class='p_icon' style='color: $plusC'>Compts +</p>
        </a>
        <a class='icon_link_bloc' href="/user/parametre">
             <img class="icon_menu" width="27" height="27" src="/assets/icons/$parametre" alt="">
             <p class='p_icon' style=' color: $parametreC'>Paramètres</p>
        </a>
     </section>
     HTML;
}
}
?>
