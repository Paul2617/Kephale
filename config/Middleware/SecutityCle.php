<?php
namespace Middleware;

class SecutityCle 
{
     private static $privateCle = null;

    private static function SecurityCle (string $path){

     if (!file_exists($path)) {
     http_response_code(404);
     self::$privateCle = null;
     return "Fichier introuvable.";
     }
     $file_get_contents = file_get_contents($path);
     self::$privateCle = $file_get_contents;
} 

    public static function recupSecurityCle (string $path){

        self::SecurityCle($path);
        if(self::$privateCle !== null){
            return self::$privateCle;
        }else{
            return null;
        }

 }
}