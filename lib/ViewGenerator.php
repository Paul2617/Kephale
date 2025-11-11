<?php
namespace Lib;

class ViewGenerator
{
    public static function createController($name)
    {
        $controllerName = ucfirst($name) . 'Controller';
        $controllerPath = __DIR__ . '/../src/Controller/' . $controllerName . '.php';

        $className = ucfirst($name) . 'Class';
        $classPath = __DIR__ . '/../src/NewClass/' . $className . '.php';

        $viewDir = __DIR__ . '/../view/' . strtolower($name);
        $viewFile = $viewDir . '/index.php';

        if (!file_exists($controllerPath)) {
            $controllerCode = <<<PHP
<?php
use NewClass\\$className;

class {$controllerName}
{
    private static \$render;
    private static \$page_$name;

    public function __construct( \$parts_uri, \$parts_uri_1 = null  ) {
         self::\$render = \$parts_uri;
         self::\$page_$name = \$parts_uri_1 ;
        }

    public function {$controllerName}()
    {
    $className::$className();
     \$new_view = self::\$render; 
     \$new_view_page = self::\$page_$name;
      if(empty(\$new_view_page)){
            \$view = __DIR__ . '/../../view/'.\$new_view.'/index.php';
            if (file_exists(\$view)){ require_once \$view;}
        }else{
            \$new_view = __DIR__ . '/../../view/'.\$new_view.'/'.\$new_view_page.'/index.php';
            if (file_exists(\$new_view)){ require_once \$new_view;}else{ header ('Location: /home');}
        }         
    }
}
?>
PHP;
            file_put_contents($controllerPath, $controllerCode);
            echo "Contrôleur créé: $controllerPath\n";
        }


        if (!file_exists($viewDir)) {
            mkdir($viewDir, 0777, true);
        }
        // class creationion
        
        if (!file_exists($classPath)){
$classCode = <<<PHP
<?php
namespace NewClass;

class {$className}
{

  static  public function {$className}()
    {
       return  '$className'  ;  
    }
}
?>
PHP;
file_put_contents($classPath, $classCode);
            echo "Contrôleur créé: $classPath\n";
        }


        if (!file_exists($viewFile)){
            
$viewCode = <<<HTML
<?php new html(); ?>
<body>
    <h1>$name</h1>
</body>

HTML;
            file_put_contents($viewFile, $viewCode);
            echo "Vue créée: $viewFile\n";
        }
    }
}
