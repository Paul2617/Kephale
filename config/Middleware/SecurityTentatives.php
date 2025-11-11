<?php
namespace Middleware;
use Middleware\SecurityCookie;

class SecurityTentatives
{


    public static function session_tentative()
    {
        if (!isset($_SESSION['tentatives']) and empty($_SESSION['tentatives'])) {
            $_SESSION['tentatives'] = 0;
            return $_SESSION['tentatives'];
        } else {
            return $_SESSION['tentatives'];
        }
    }
    public static function security_tentatives()
    {
        
        $_SESSION['tentatives'] = $_SESSION['tentatives'] + 1;
        return $_SESSION['tentatives'];
    }

    public static function security_timeExiste()
    {
        $minutes = 15 * 60; // 15 minute

        if (isset($_SESSION['timeExiste'])) {
            if ($_SESSION['timeExiste'] > time()) {
                return true;
            } else {
                session_unset();
                session_destroy();
                return false;
            }
        } else {
            $_SESSION['timeExiste'] = $minutes + time();
            return true;
        }
    }

}