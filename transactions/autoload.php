<?php
spl_autoload_register( function($class){
$file = __DIR__ . "/class/".$class.'.php';
if(file_exists($file)){
    require_once $file ;
}else{
    $file = __DIR__ . "/data/".$class.'.php';
    if(file_exists($file)){
    require_once $file ;
}
}
} );
?>