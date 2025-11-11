<?php
namespace Middleware;
class Ip
{
    static function ip_paye(): array
    {

        // Récupérer IP (gérer Cloudflare / proxies basiques)
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // prendre la première IP dans la liste X-Forwarded-For
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']) ?? "false";
            $ip = trim($ips[0]);
        }

        // Valeurs par défaut
        $country_code = null;
        $country_name = null;

        // 1) Essayer l'extension GeoIP (si disponible)
        if (function_exists('geoip_country_code_by_name')) {
            $code = @geoip_country_code_by_name($ip);
            if ($code) {
                $country_code = $code;
                if (function_exists('geoip_country_name_by_name')) {
                    $country_name = @geoip_country_name_by_name($ip);
                }
            }
        }

        // 2) Fallback via une API publique (ipapi.co)
        if (!$country_code) {
            $timeout = 3; // secondes
            $context = stream_context_create(['http' => ['timeout' => $timeout]]);
            // ipapi.co retourne JSON, CORS autorisé pour la plupart des usages côté client, mais ici on l'appelle côté serveur.
            $url = "https://ipapi.co/{$ip}/json/";
            $raw = @file_get_contents($url, false, $context);
            if ($raw !== false) {
                $obj = json_decode($raw, true);
                if (!empty($obj['country'])) {
                    $country_code = $obj['country'];
                    $country_name = $obj['country_name'] ?? ($obj['region'] ?? null);
                }
            }
        }

        $t = [
            'ip' => $ip,
            'country_code' => $country_code,
            'country_name' => $country_name
        ];
        return $t;
    }
}