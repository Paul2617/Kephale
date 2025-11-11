<?php
namespace Lib;
$env = parse_ini_file(__DIR__ . '/../../config/Lib/.env');
define('DB_HOST', $env['DB_HOST']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASS', $env['DB_PASS']);
use PDO;
use PDOException;
class Data 
{
    private static $data;
    private static $host = DB_HOST;
    private static $dbname = DB_NAME;
    private static $username = DB_USER;
    private static $password = DB_PASS;

    private static function recbd (){
        $host = self::$host;
        $dbname = self::$dbname;
        $username = self::$username;
        $password = self::$password;
         try 
         {
          
        self::$data = new PDO ("mysql:host=$host; dbname=$dbname", "$username", "$password");
        self::$data->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        self::$data->setAttribute(attribute: PDO::ATTR_EMULATE_PREPARES, value: false);
        self::$data->setAttribute(attribute: PDO::ATTR_DEFAULT_FETCH_MODE, value: PDO::FETCH_ASSOC);
         }catch(PDOException $e) 
         {
        error_log("Database connection failed: " . $e->getMessage());
        die("Une erreur est survenue. Veuillez réessayer plus tard.");
      
         }
        }
        protected static function getbd(): PDO{
            if(self::$data === null ){
                self::recbd();
                return self::$data;
            }else{
              return self::$data;
            }
        }
        public static function data(): PDO{
          return  self::getbd();
        }
}
 ?>