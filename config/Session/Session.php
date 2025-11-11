<?php
namespace Session;

class Session
{

    // FONCTION : Créer session sécurisée
    static function security_session($userId)
    {
        session_regenerate_id(true); // Change l'ID de session pour éviter fixation
        $_SESSION['id'] = $userId;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['last_activity'] = time(); // Pour expiration
        return $_SESSION['id'];
    }
    

    // FONCTION : Vérifier session

    static function check_session()
    {
        // Expiration après 15 minutes d'inactivité
        $timeout = 60 * 30;

        if (!isset($_SESSION['id'])) {
            return false; // Pas connecté
        }

        // Vérifie IP et navigateur
        if (
            $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] ||
            $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']
        ) {
            return false; // Session volée
        }

        // Vérifie inactivité
        if (time() - $_SESSION['last_activity'] > $timeout) {
            return false; // Session expirée
        }

        $_SESSION['last_activity'] = time(); // Reset timer
        return true;
    }

    static function check_session_boutique(){
        // Expiration après 15 minutes d'inactivité
        $timeout = 60 * 30;

        if (!isset($_SESSION['id_boutique'])) {
            return false; // Pas connecté
        }
         if (!isset($_SESSION['id'])) {
            return false; // Pas connecté
        }
        // Vérifie IP et navigateur
        if (
            $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] ||
            $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']
        ) {
            return false; // Session volée
        }

        // Vérifie inactivité
        if (time() - $_SESSION['last_activity'] > $timeout) {
            return false; // Session expirée
        }

        $_SESSION['last_activity'] = time(); // Reset timer
        return true;

    }
    // FONCTION : Déconnexion

    static function logout()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
         session_unset();
         session_destroy();
         header('Location: /connexion');
         exit();
    }
}