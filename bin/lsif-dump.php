<?php

use NiclasVanEyk\LsifPhp\Implementations\FelixBeckerLanguageServer\FelixBeckerLanguageServerLsifGenerator;

require(__DIR__ . '/../vendor/autoload.php');

$rootPath = realpath($argv[1]);
$lsifGenerator = new FelixBeckerLanguageServerLsifGenerator($rootPath);

$lsifGenerator->generate();