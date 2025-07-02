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
        $inserLocal = $data->prepare("INSERT INTO localisations (local, id_users, latitude, longitude, pays, ville, quartier, adresse ) VALUES (?,?,?,?,?,?,?,?)");
        $inserLocal->execute(array($local, $id_local, $lat, $lon, $pays, $ville, $quartier, $adresse ));

         $inserLocal->closeCursor();
         return true;
    }

      public  function eLocalisationsBoutique ($lat, $lon, $pays, $ville, $quartier, $adresse ){
        $local = 'boutique';
        $id_local =  $_SESSION["id_boutique"];
        $data = $this->data();
        $inserLocal = $data->prepare("INSERT INTO localisations (local, id_boutique, latitude, longitude, pays, ville, quartier, adresse ) VALUES (?,?,?,?,?,?,?,?)");
        $inserLocal->execute(array($local, $id_local, $lat, $lon, $pays, $ville, $quartier, $adresse ));

        $inserLocal->closeCursor();
        return true;
    }


  public  function nLocalisations ($lat, $lon, $pays, $ville, $quartier, $adresse ) {
        $local = 'users';
        $id_local =  $_SESSION["id"];
        $data = $this->data();
        $stmt = $data->prepare("UPDATE localisations SET latitude = ?, longitude = ?, pays = ?, ville = ?, quartier = ?, adresse = ? WHERE id_users = ? AND local LIKE 'users' ");
        $stmt->execute(array($lat, $lon, $pays, $ville, $quartier, $adresse, $id_local ));

        $stmt->closeCursor();
        return true;
    }


     public  function nLocalisationsBoutique ($lat, $lon, $pays, $ville, $quartier, $adresse ){
        $local = 'boutique';
        $id_local =  $_SESSION["id_boutique"];
        $data = $this->data();
        $stmt = $data->prepare("UPDATE localisations SET latitude = ?, longitude = ?, pays = ?, ville = ?, quartier = ?, adresse = ? WHERE id_boutique = ? AND local LIKE 'boutique' ");
        $stmt->execute(array($lat, $lon, $pays, $ville, $quartier, $adresse,  $id_local));

        $stmt->closeCursor();
         return true;
    }
    
}