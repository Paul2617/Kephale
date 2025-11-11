<?php
namespace Middleware;

class SecurityEncodeData 
{
static function encode ($data){

     $env = parse_ini_file(__DIR__ . '/../../.env');
     $passphrase = $env['CLIENT_PASSPHRASE'];
     $token = $env['AUTH_TOKEN'];
     $api_key = $env['API_KEY'];

     $dataJson = json_encode($data);

     $client_private = __DIR__ .'/../../api/keys/client/client_private.pem';
     $server_public = __DIR__ .'/../../api/keys/client/server_public.pem';

    if (!file_exists($client_private)) {
    http_response_code(404);
    echo "Fichier introuvable.";
    exit;
    }

      if (!file_exists($server_public)) {
    http_response_code(404);
    echo "Fichier introuvable.";
    exit;
    }
   
    // Option : forcer le téléchargement (évite qu’il s’affiche dans le navigateur)
     //header('Content-Type: application/octet-stream');
     //header('Content-Disposition: attachment; filename="client_private.pem"');
    //header('Content-Disposition: attachment; filename="server_public.pem"');

     $privateKey = openssl_pkey_get_private( file_get_contents($client_private ),$passphrase );
     $serverPublic = file_get_contents($server_public);

     openssl_public_encrypt($dataJson, $encrypted, $serverPublic);
     $encryptedBase64 = base64_encode($encrypted);

     openssl_sign($dataJson, $signature, $privateKey, OPENSSL_ALGO_SHA256);
     $signatureBase64 = base64_encode($signature);

     $payload = json_encode([
    'data' => $encryptedBase64,
    'signature' => $signatureBase64
     ]);

     $info = 
     [ 
        'data' =>  $payload ,
        'AUTH_TOKEN' => $token,
        'API_KEY' => $api_key
      ];


     return   $info;
    }
}