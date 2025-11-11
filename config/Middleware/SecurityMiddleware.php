<?php
namespace Middleware;

class SecurityMiddleware 
{
    // genere le Token CSRF
   public static function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
}
    // Filtre les entrées (version améliorée - moins agressive)
   public static function sanitizeInput($input) {
     // Vérifier si l'input est un tableau
     if (is_array($input)) {
        return array_map([self::class, 'sanitizeInput'], $input);
     }

     // Convertir en string si nécessaire
     if (!is_string($input)) {
        return $input;
     }

     // 1. Supprimer les caractères de contrôle (sauf tab, newline, carriage return)
     $input = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $input);

     // 2. Supprimer les balises HTML et PHP (protection XSS)
     $input = strip_tags($input);

     // 3. Convertir les caractères spéciaux en entités HTML (protection XSS)
     $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');

     // 4. Supprimer les espaces multiples et trim
     $input = preg_replace('/\s+/', ' ', trim($input));

     // Note : On n'utilise plus mysql_real_escape_string ni addslashes
     // car on utilise des requêtes préparées partout (plus sûr)
     
     return $input;
   }
    // verifie le Token CSRF
   public static function varifieCsrfToken($csrfToken){
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $csrfToken);
  }
   
}
