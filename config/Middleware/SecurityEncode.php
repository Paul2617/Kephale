<?php
namespace Middleware;
use Middleware\DotEnvReader;
use Middleware\SecutityCle;

class SecurityEncode

{

    public static function encode ($data){
   
     $passphrase = DotEnvReader::get('CLIENT_PASSPHRASE');
     $token = DotEnvReader::get('AUTH_TOKEN');
     $api_key = DotEnvReader::get('API_KEY');

     $dataJson = json_encode($data);

     $client_private =  SecutityCle::recupSecurityCle( __DIR__ .'/../../api/keys/client/client_private.pem');
     $server_public =  SecutityCle::recupSecurityCle( __DIR__ .'/../../api/keys/client/server_public.pem');

 
     if ($client_private === null ) {
     http_response_code(404);
     return "Fichier introuvable.";
     }

      if ($server_public === null ) {
     http_response_code(404);
     return "Fichier introuvable.";
     }


     $privateKey = openssl_pkey_get_private($client_private ,$passphrase );

     openssl_public_encrypt($dataJson, $encrypted, $server_public);
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


     return $info;
}

} 