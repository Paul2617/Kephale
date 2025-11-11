<?php
namespace Api;

class ApiClient
{
  private static $timeout = 30;
  public static function curl_init($data, $directory)
  {
    $env = parse_ini_file(__DIR__ . '/../../.env');
    $passphrase = $env['CLIENT_PASSPHRASE'];
    $token = $env['AUTH_TOKEN'];
    $api_key = $env['API_KEY'];
    $dataJson = json_encode($data);
    $client_private = __DIR__ . '/../../api/keys/client/client_private.pem';
    $server_public = __DIR__ . '/../../api/keys/client/server_public.pem';
 
    if (!file_exists($client_private)) {
      http_response_code(404);
      return "Fichier introuvable.";
    }
    

    if (!file_exists($server_public)) {
      http_response_code(404);
      return "Fichier introuvable.";
    }

    // Option : forcer le téléchargement (évite qu’il s’affiche dans le navigateur)
    //header('Content-Type: application/octet-stream');
    //header('Content-Disposition: attachment; filename="client_private.pem"');
    //header('Content-Disposition: attachment; filename="server_public.pem"');

    $privateKey = openssl_pkey_get_private(file_get_contents($client_private), $passphrase);
    $serverPublic = file_get_contents($server_public);

    openssl_public_encrypt($dataJson, $encrypted, $serverPublic);
    $encryptedBase64 = base64_encode($encrypted);

    openssl_sign($dataJson, $signature, $privateKey, OPENSSL_ALGO_SHA256);
    $signatureBase64 = base64_encode($signature);

    $payload = json_encode([
      'data' => $encryptedBase64,
      'signature' => $signatureBase64
    ]);
    $dataEncode = $payload;
    $AUTH_TOKEN = $token;
    $API_KEY = $api_key;

    $ch = curl_init('https://kephale.infinityfreeapp.com/api/' . $directory);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
      'X-AUTH-TOKEN: ' . $AUTH_TOKEN,
      'Access-Control-Allow-Headers: Authorization, Content-Type, ' . $API_KEY
    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEncode);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;

  }
}