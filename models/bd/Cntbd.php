<?php
 //$host = "sql103.infinityfree.com";
 //$dbname = "if0_38345177_kephale";
 //$username = "if0_38345177";
 //$password = "w7QYPEGftfkmxB";
class Cntbd 
{
    private static $bd;

    private static function recbd (){
        $host = "localhost";
        $dbname = "kephale-groupe";
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