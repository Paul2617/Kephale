<?php 


class generate_uuid 
{

     protected function data (){
         $new_data = new data();
         $data =  $new_data->data();
         return $data ;
    }
    function generateUUIDv4() {

    $data = $this->data();
    $maxTentatives = 100; // Sécurité pour éviter les boucles infinies
    $tentatives = 0;
    $cleExiste = true;
     while ($cleExiste && $tentatives < $maxTentatives) {

        // Génère une clé aléatoire de 32 caractères alphanumériques
        $nouvelleCle = bin2hex(random_bytes(16));

        // Vérifie si la clé existe déjà dans la base
        $stmt = $data->prepare("SELECT COUNT(*) FROM uuid WHERE uuid_cle = :cle");
        $stmt->execute([':cle' => $nouvelleCle]);
        $cleExiste = (bool)$stmt->fetchColumn();

           if (!$cleExiste) {
            // Retourne la nouvelle clé
            return $nouvelleCle;
        }
     }

 $tentatives++;
}


 function generateShortSlug( $uuid, $length = 5) {
    $data = $this->data();
    $maxTentatives = 100; // Sécurité pour éviter les boucles infinies
    $tentatives = 0;
    $cleExiste = true;
     while ($cleExiste && $tentatives < $maxTentatives){
         // Génère une clé aléatoire de 5 caractères alphanumériques
    $base64 = base64_encode($uuid);
    $nouvelleCle = substr($base64, 0, $length);

     // Vérifie si la clé existe déjà dans la base
        $stmt = $data->prepare("SELECT COUNT(*) FROM uuid WHERE uuid_cinq = :cle");
        $stmt->execute([':cle' => $nouvelleCle]);
        $cleExiste = (bool)$stmt->fetchColumn();

           if (!$cleExiste) {
            // Retourne la nouvelle clé
            return $nouvelleCle;
        }
     }

 $tentatives++;

}
}

?>
