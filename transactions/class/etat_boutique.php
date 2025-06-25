<?php 

class etat_boutique
{
        protected function data (){
         $new_data = new data();
         $data =  $new_data->data();
         return $data ;
    }
    function verifie_boutique ($user_id){
        $data = $this->data();
        $stmt = $data->prepare("SELECT COUNT(*) FROM boutique WHERE id_user = :id_user");
        $stmt->execute([':id_user' => $user_id]);
        $cleExiste = (bool)$stmt->fetchColumn();

         if (!$cleExiste){
            return false;
         }else{
            return true;
         }
    }

}
?>