<?php
class generer_cle 
{
    public function generer_cle_5 (){
        return str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
    }
    function generer_cle_32($data) {
    // Génère 16 octets (128 bits) et les convertit en hexadécimal (32 caractères)

    $maxTentatives = 100; // Sécurité pour éviter les boucles infinies
    $tentatives = 0;
    $cleExiste = true;

     while ($cleExiste && $tentatives < $maxTentatives) {
        // Génère une clé aléatoire de 32 caractères alphanumériques
        $nouvelleCle = bin2hex(random_bytes(16));
        
        // Vérifie si la clé existe déjà dans la base
        $stmt = $data->prepare("SELECT COUNT(*) FROM id_user WHERE cle = :cle");
        $stmt->execute([':cle' => $nouvelleCle]);
        $cleExiste = (bool)$stmt->fetchColumn();
        
        if (!$cleExiste) {
            // Retourne la nouvelle clé
            return $nouvelleCle;
        }
        $tentatives++;
    }

    throw new Exception("Impossible de générer une clé unique après $maxTentatives tentatives");
}

}