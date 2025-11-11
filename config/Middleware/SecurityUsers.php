<?php
namespace Middleware ;
use Middleware\SecurityCookie; 

class SecurityUsers
{

 public static  function securityUsersCookir() {

    $token_cookie = SecurityCookie::verifSecurityCookie();
  
   if ($token_cookie === true){

      if(isset($_SESSION["id"])){
         $verifieSecurityCookie = SecurityCookie::verifieSecurityCookie();
         if($verifieSecurityCookie !== false){
            return $verifieSecurityCookie["user_key"];
         }else{
          $_SESSION = array();
          session_destroy();
          SecurityCookie::deleteSecurityCookie();
          header ('Location: /connexions');
          exit;
         }
      }else{

         $verifieSecurityCookie = SecurityCookie::verifieSecurityCookie();

         if($verifieSecurityCookie !== false){
            $_SESSION["id"] = $verifieSecurityCookie["id"];
            // Sécurisation : validation de l'URI avant redirection pour éviter les redirections ouvertes
            $requestUri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
            // Vérifier que l'URI commence par / pour éviter les redirections externes
            if (strpos($requestUri, '/') === 0) {
                header('Location: ' . htmlspecialchars($requestUri, ENT_QUOTES, 'UTF-8'));
            } else {
                header('Location: /home');
            }
            exit;
         }else{
          $_SESSION = array();
          session_destroy();
          SecurityCookie::deleteSecurityCookie();
          header ('Location: /connexions');
          exit;
         }
      }
   }else{
       if(!isset($_SESSION["id"])){
          $_SESSION = array();
          session_destroy();
          SecurityCookie::deleteSecurityCookie();
          header ('Location: /connexions');
          exit;
       }
   }

 }
}