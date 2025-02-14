<?php

class Cntbd 
{
    private static $bd;

    private static function recbd (){
        $host = "localhost";
        $dbname = "kephale";
        $username = "root";
        $password = "root";
        self:: $bd = new PDO ("mysql:host=$host; dbname=$dbname", "$username", "$password");
        }

        protected function getbd(){
            if(self:: $bd === null ){
                self:: recbd ();
                return self:: $bd ;
            }
        }

        public function bd(){
          return  $this->getbd();
        }
}
 ?>