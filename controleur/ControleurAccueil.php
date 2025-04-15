<?php
// requet data basse
     
        //definitin de leta de licon connection et lin
        if(isset($_SESSION["id"])){
            $lala = 'icon_user';
        $icon = 'public/asset/img_user/'.$imgUserK;
        }else{
            $lala = 'retouree';
            $icon = 'public/asset/_icone/connection.svg';
        }

// affiche page accuil
        
?>