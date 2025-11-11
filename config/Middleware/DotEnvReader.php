<?php
namespace Middleware;


class DotEnvReader {
    private static array $dotenv = [];
    private static array $cache = [];

    /**
     * Charge et récupère les variables d'environnement de manière sécurisée
     *
     * @param string $path Chemin vers le dossier contenant le fichier .env
     * @param string $file Nom du fichier .env (par défaut .env)
     * @return void
     * @throws \Exception
     */

   private static function load(string $path = __DIR__ .'/../../', string $file = '.env')
     {
            // Vérifie si le fichier existe et est lisible
            if (!is_readable($path . '/' . $file)) {
                throw new \Exception("Le fichier .env est introuvable ou non lisible à : {$path}/{$file}");
            }
             $env = parse_ini_file($path . '/' . $file);
             self::$dotenv = $env ;
 
     }

     /**
     * Récupère une variable d'environnement avec une valeur par défaut
     *
     * @param string $key Clé de la variable
     * @param mixed $default Valeur par défaut si la clé n'existe pas
     * @return mixed
     */
     public static function get(string $key)
     {
          self::load();
        // Vérifie le cache pour éviter les accès répétés
        if (array_key_exists($key, self::$cache)) {
            return self::$dotenv[$key];
        }

        // Récupère la valeur de l'environnement
        $value = self::$dotenv[$key];

        // Si la valeur n'existe pas, utilise la valeur par défaut
        if ($value === false) {
            return false;
        }


        return $value;
     }


     /**
     * Nettoie le cache des variables
     *
     * @return void
     */
     public static function clearCache(): void
     {
        self::$cache = [];
}


    
}
