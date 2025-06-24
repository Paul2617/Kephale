<?php
class data 
{
    private static $data;
    private static $host = DB_HOST;
    private static $dbname = DB_NAME_KEPHALE;
    private static $username = DB_USER_KEPHALE;
    private static $password = DB_PASS_KEPHALE;

    private static function recbd (){
        $host = self:: $host;
        $dbname = self:: $dbname;
        $username = self:: $username;
        $password = self:: $password;
         try 
         {
        self:: $data = new PDO ("mysql:host=$host; dbname=$dbname", "$username", "$password");
        self:: $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self:: $data->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        self:: $data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
         }catch(PDOException $e) 
         {
        error_log("Database connection failed: " . $e->getMessage());
       die("Une erreur est survenue. Veuillez réessayer plus tard.");
      
         }
        }
        protected function getbd(){
            if(self:: $data === null ){
                self:: recbd ();
                return self:: $data ;
            }else{
              return self:: $data ;
            }
        }
        public function data(){
          return  $this->getbd();
        }
}
 ?>