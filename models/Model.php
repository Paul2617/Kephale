<?php

    abstract class Model
    {
        private static $bd;

        private static function recbd (){
        $host = "localhost";
        $dbname = "kephale";
        $username = "root";
        $password = "root";
        
        self:: $bd = new PDO ("mysql:host=$host; dbname=$dbname", "$username", "$password");

        self:: $bd->setAttribute (PDO::ATTR_ERMODE,  PDO::ERMODE_WARNING);

        }
        protected function getbd(){
            if(self:: $bd === null ){
                self:: recbd ();
                return self:: $bd ;
            }
        }
        // requet de tout une table
        protected function recTable ($table, $objt){
            $this->getbd();
            $var = [];
            $rec =  self:: $bd->prepare('SELECT * FROM '.$table.' ORDER BY id desc ');
            $rec->execute();
            while ($data = $rec->fetche(PDO::FETCH_ASSOC)){
                $var = new $objt($data);
            }
            return  $var;
            $rec->closeCursor();
        }
    }
    ?>