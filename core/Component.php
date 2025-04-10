<?php
function component($name, $props = []) {
    $path = __DIR__ . "/../components/$name.php";
    
    if (file_exists($path)) {
        extract($props); // transforme chaque clé en variable PHP
        include $path;
    } else {
        echo "<p style='color:red;'>Composant '$name' introuvable.</p>";
    }
}

function text($name, $props = []) {
    $path = __DIR__ . "/../components/text/$name.php";
    
    if (file_exists($path)) {
        extract($props); // transforme chaque clé en variable PHP
        include $path;
    } else {
        echo "<p style='color:red;'>Composant '$name' introuvable.</p>";
    }
}
            ?>