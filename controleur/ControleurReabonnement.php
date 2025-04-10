<?php

$montant_abt = recAbonnement($bd);
// verifie le code et le solde de sur
if (isset($_POST["confirme"]) and !empty($_POST["confirme"])){
    $password_user = isset($_POST['password_user']) ? $_POST['password_user'] : null;
    if ($password_user !== null ){
        $password_user_encode = sha1($password_user);
        $verifi_code_et_solde = verifi_code_et_solde($bd, $password_user_encode, $montant_abt);

        if($verifi_code_et_solde === "null"){
            $erreur = 'Mot de passe incorecte !';
        }elseif(($verifi_code_et_solde === "solde")){
            $erreur = 'Solde insuffisant !';
        }elseif($verifi_code_et_solde === "ok"){
            $ok = 'ok';
        }
    }
}
// si tous est bon code correcte et solde correcte
$valide = isset($ok ) ? $ok : null;
if ($valide !== null ){
   $transactions = transactions($bd, $montant_abt);

   if($transactions === 'ok'){
    header("Location: /Kephale/boutique");
    $erreur = 'Transaction effectue';
   }
}
?>