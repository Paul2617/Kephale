<?php
require_once ('config.php');
require_once ('autoload.php');
class  eLocalisations 
{
        protected function data (){
         $data = new data();
         $data = $data->data();
         return $data ;
    }


  public  function eLocalisations ($lat, $lon, $pays, $ville, $quartier, $adresse ){
        $local = 'users';
        $id_local =  $_SESSION["id"];
        $data = $this->data();
        $inserLocal = $data->prepare("INSERT INTO localisations (local, id_local, latitude, longitude, pays, ville, quartier, adresse ) VALUES (?,?,?,?,?,?,?,?)");
        $inserLocal->execute(array($local, $id_local, $lat, $lon, $pays, $ville, $quartier, $adresse ));

         $inserLocal->closeCursor();
         return true;
    }

      public  function eLocalisationsBoutique ($lat, $lon, $pays, $ville, $quartier, $adresse ){
        $local = 'boutique';
        $id_local =  $_SESSION["id_boutique"];
        $data = $this->data();
        $inserLocal = $data->prepare("INSERT INTO localisations (local, id_local, latitude, longitude, pays, ville, quartier, adresse ) VALUES (?,?,?,?,?,?,?,?)");
        $inserLocal->execute(array($local, $id_local, $lat, $lon, $pays, $ville, $quartier, $adresse ));

         $inserLocal->closeCursor();
         return true;
    }


  public  function nLocalisations ($lat, $lon, $pays, $ville, $quartier, $adresse ){
        $local = 'users';
        $id_local =  $_SESSION["id"];
        $data = $this->data();
        $stmt = $bd->prepare('UPDATE localisations SET latitude = ?, longitude = ?, pays = ?, ville = ?, quartier = ?, adresse = ? WHERE id_local = ? AND local LIKE ? ');
        $stmt->execute(array($lat, $lon, $pays, $ville, $quartier, $adresse,  $id_local , $local ));

        $stmt->closeCursor();
         return true;
    }

     public  function nLocalisationsBoutique ($lat, $lon, $pays, $ville, $quartier, $adresse ){
        $local = 'boutique';
        $id_local =  $_SESSION["id_boutique"];
        $data = $this->data();
        $stmt = $bd->prepare('UPDATE localisations SET latitude = ?, longitude = ?, pays = ?, ville = ?, quartier = ?, adresse = ? WHERE id_local = ? AND local LIKE ? ');
        $stmt->execute(array($lat, $lon, $pays, $ville, $quartier, $adresse,  $id_local , $local ));

        $stmt->closeCursor();
         return true;
    }
    
}