<?php
spl_autoload_register(function ($class) {
    $core_dir = __DIR__ . '/lib/';
    $config_dir = __DIR__ . '/config/';
    $base_dir = __DIR__ . '/src/';

    $class = str_replace('\\', '/', $class);
    $file = $base_dir . $class . '.php';

    if (file_exists($file)) {
        require $file;
    } else{
        $coreFile = $core_dir . basename($class) . '.php';
        if (file_exists($coreFile)) {
            require $coreFile;
        }else{
            $configFile = $config_dir . $class . '.php';
            if (file_exists($configFile)) {
                 require $configFile;
            }else{
                echo $configFile ;
            }
        }
    }

});