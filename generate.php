<?php
require_once 'autoload.php';

use Lib\ViewGenerator;

if ($argc < 2) {
    echo "Usage: php generate.php NomDuController\n";
    exit;
}

ViewGenerator::createController($argv[1]);

// php generate.php produit_paiement