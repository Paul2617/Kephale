<?php
class infoUsers 
{
        protected function data (){
         $data = (new data())->data();
         return $data ;
    }
    function infoUsers ($uuid_5){
         $data = $this->data();

        $rec = "SELECT 
        users.nom as nom,  
        users.telephone as telephone, 
        users.sexe as sexe, 
        users.password_user as password_user,
        users.img as img, 
        users_solde.solde as solde  
        FROM uuid 
        INNER JOIN users ON uuid.uuid_cle = users.uuid_cle 
        INNER JOIN users_solde ON uuid.uuid_cle = users_solde.uuid_cle 
        WHERE uuid_cinq = ?  ";

        $stmt = $data->prepare($rec);
        $stmt->execute([$uuid_5]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function panierInfo (){
         $data = $this->data();
         
         $stmt = $data->prepare("SELECT * FROM panie WHERE id_user = ?  ");
         $stmt->execute([$_SESSION["id"]]);
         return $stmt->rowCount();
    }
     function achatInfo (){
        $data = $this->data();
        $stmt = $data->prepare("SELECT id_user FROM liste_achat WHERE id_user = ? AND etat_livraison LIKE 'non'  ");
        $stmt->execute([$_SESSION["id"]]);
         return $stmt->rowCount();
    }
    function localInfo (){
       $data = $this->data();
        $stmt = $data->prepare("SELECT adresse FROM localisations WHERE id_local = ? AND local LIKE 'users'  ");
        $stmt->execute([$_SESSION["id"]]);
        if($stmt->rowCount() === 1){
         $stmts = $stmt->fetch(PDO::FETCH_ASSOC);
         $adresse = $stmts ["adresse"];
         return $adresse;
        }else{
          return false;
        }
    }
}
?>