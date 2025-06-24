<?php 
class inscription
{
         protected function data (){
         $new_data = new data();
         $data =  $new_data->data();
         return $data ;
    }
    function valideNumereau ($numerau_user){

        $data = $this->data();
        $stmt = $data->prepare("SELECT COUNT(*) FROM users WHERE telephone = :phone");
        $stmt->execute([':phone' => $numerau_user]);
        $cleExiste = (bool)$stmt->fetchColumn();

           if (!$cleExiste) {
            return false ;
        }else{
           return 'Veuillez indiquer un autre numéro de téléphone.';
        }
    }
    function enregistrement($uuid_5, $uuid_32, $nom_user, $numerau_user, $password_user, $sexe, $imgNom ){
        $data = $this->data();

          // enregistrement les cle
        $inser_cle = $data->prepare("INSERT INTO uuid (uuid_cinq, uuid_cle ) VALUES (?,?)");
        $inser_cle->execute(array($uuid_5, $uuid_32));

        // enregistrement solde user
        $inser_solde = $data->prepare("INSERT INTO users_solde (uuid_cle, solde) VALUES (?,?)");
        $inser_solde->execute(array( $uuid_32, '0'));

        // enregistrement users
        $code = sha1($password_user);
        $inser_user = $data->prepare("INSERT INTO users (uuid_cle, nom, telephone, password_user, sexe, img ) VALUES (?,?,?,?,?,?)");
        $inser_user->execute(array($uuid_32, $nom_user, $numerau_user, $code, $sexe, $imgNom));
        $id_user = $data->lastInsertId();

        $inser_user->closeCursor();
        $inser_solde->closeCursor();
        $inser_cle->closeCursor();
        return true;
        }
}