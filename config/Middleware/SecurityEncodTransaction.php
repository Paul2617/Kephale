<?php
// crypto_multi.php
// Usage: libsodium required

// Génère une paire de clés (keypair) pour un destinataire.
// Retourne un tableau ['keypair' => $keypair, 'public' => base64(...), 'secret' => base64(...)]
function generate_keypair() {
    $kp = sodium_crypto_box_keypair();
    $pub = sodium_crypto_box_publickey($kp);
    $sec = sodium_crypto_box_secretkey($kp);
    return [
        'keypair' => $kp,
        'public' => base64_encode($pub),
        'secret' => base64_encode($sec)
    ];
}

// Encrypt message for multiple recipients (array of base64 public keys).
// Retourne JSON (string) contenant:
// {
//   "algo":"xchacha20poly1305+sodium_seal",
//   "ciphertext": base64(...),
//   "nonce": base64(...),
//   "enc_keys": [
//      {"recipient_public": "...", "sealed_key": "..."},
//      ...
//   ],
//   "meta": {...}
// }
function encrypt_for_recipients(string $plaintext, array $recipients_public_base64) : string {
    // 1) generate a random symmetric key (32 bytes)
    $symmKey = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES);

    // 2) encrypt plaintext with XChaCha20-Poly1305 (AEAD)
    $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES); // 24 bytes
    $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt($plaintext, '', $nonce, $symmKey);

    // 3) For each recipient public key, "seal" (encrypt) the symmetric key using crypto_box_seal
    $enc_keys = [];
    foreach ($recipients_public_base64 as $pub64) {
        $pub = base64_decode($pub64, true);
        if ($pub === false || strlen($pub) !== SODIUM_CRYPTO_BOX_PUBLICKEYBYTES) {
            throw new Exception("Public key invalide (doit être base64 et bonne longueur).");
        }
        // sodium_crypto_box_seal chiffre pour le propriétaire de la paire (il faut qu'il possède la clé secrète correspondante pour ouvrir)
        $sealed = sodium_crypto_box_seal($symmKey, $pub);
        $enc_keys[] = [
            'recipient_public' => $pub64,
            'sealed_key' => base64_encode($sealed),
        ];
    }

    $payload = [
        'algo' => 'xchacha20poly1305+sodium_box_seal',
        'ciphertext' => base64_encode($cipher),
        'nonce' => base64_encode($nonce),
        'enc_keys' => $enc_keys,
        'meta' => [
            'created_at' => gmdate('c'),
            'recipients' => count($enc_keys),
        ],
    ];
    return json_encode($payload, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
}

// Déchiffre un payload (string JSON) en utilisant la paire keypair du destinataire.
// $recipient_keypair peut être la keypair brute retournée par sodium_crypto_box_keypair()
// ou bien on peut reconstruire la keypair à partir des clefs publiques/secret base64 fournies.
// Retourne le plaintext (string) ou lance exception en cas d'erreur.
function decrypt_with_keypair(string $payload_json, $recipient_keypair) : string {
    $obj = json_decode($payload_json, true);
    if (!is_array($obj) || !isset($obj['enc_keys']) || !isset($obj['ciphertext']) || !isset($obj['nonce'])) {
        throw new Exception("Payload invalide.");
    }

    // Cherche la sealed_key qui correspond à la clé publique du destinataire
    $recipient_public = base64_encode(sodium_crypto_box_publickey($recipient_keypair));

    $found = null;
    foreach ($obj['enc_keys'] as $entry) {
        if (!isset($entry['recipient_public']) || !isset($entry['sealed_key'])) continue;
        if (hash_equals($entry['recipient_public'], $recipient_public)) {
            $found = $entry['sealed_key'];
            break;
        }
    }
    if ($found === null) {
        // Peut-être que la structure a les public keys dans un autre encodage. On essaye toutes:
        // si aucune sealed_key correspond, on tentera d'ouvrir chaque sealed_key: crypto_box_seal_open échoue si pas la bonne keypair.
        $found = null; // on continuera à essayer toutes les sealed_keys ci-dessous
    }

    // On va parcourir toutes les sealed_keys et tenter d'ouvrir avec la paire du destinataire.
    $sealed_candidates = array_map(function($e){ return $e['sealed_key']; }, $obj['enc_keys']);

    foreach ($sealed_candidates as $sealed_b64) {
        $sealed = base64_decode($sealed_b64, true);
        if ($sealed === false) continue;
        // tente d'ouvrir
        $symmKey = sodium_crypto_box_seal_open($sealed, $recipient_keypair);
        if ($symmKey !== false) {
            // on a récupéré la clé symmétrique -> déchiffrer le ciphertext
            $cipher = base64_decode($obj['ciphertext'], true);
            $nonce = base64_decode($obj['nonce'], true);
            if ($cipher === false || $nonce === false) throw new Exception("Ciphertext/nonce invalides (base64).");

            $plaintext = sodium_crypto_aead_xchacha20poly1305_ietf_decrypt($cipher, '', $nonce, $symmKey);
            if ($plaintext === false) throw new Exception("Déchiffrement AEAD échoué (auth tag invalide).");
            return $plaintext;
        }
    }

    throw new Exception("Aucune sealed_key n'a pu être ouverte avec cette paire (pas destiné à vous).");
}

// --- Exemple d'utilisation (décommenter pour tester) ---
/*
try {
    // Générer deux utilisateurs (2 paires)
    $a = generate_keypair();
    $b = generate_keypair();

    // On garde la keypair complète (keypair) pour le déchiffrement
    $kpA = $a['keypair']; // utilisateur A
    $kpB = $b['keypair']; // utilisateur B

    // Publics à fournir pour l'encryption
    $pubs = [$a['public'], $b['public']];

    $msg = "Secret super important : 12345";

    $enc = encrypt_for_recipients($msg, $pubs);
    echo \"Payload chiffré :\\n\" . $enc . \"\\n\\n\";

    // Test: B peut déchiffrer
    $decB = decrypt_with_keypair($enc, $kpB);
    echo \"B decrypted: $decB\\n\";

    // Test: A peut aussi déchiffrer
    $decA = decrypt_with_keypair($enc, $kpA);
    echo \"A decrypted: $decA\\n\";
} catch (Exception $e) {
    echo 'Erreur: ' . $e->getMessage() . \"\\n\";
}
*/
