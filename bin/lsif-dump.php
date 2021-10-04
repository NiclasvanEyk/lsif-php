<?php


use NiclasVanEyk\LsifPhp\Implementations\Custom\FileSymbolCollector;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\ComposerProject;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\File;
use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifDumpWriter;
use Symfony\Component\Finder\Finder;

require(__DIR__ . '/../vendor/autoload.php');

$pathToComposerJson = realpath($argv[1]);
$composerJson = json_decode(file_get_contents($pathToComposerJson));
$pathsByNamespace = (array) $composerJson?->autoload?->{'psr-4'};
$project = new ComposerProject(dirname($pathToComposerJson));
$symbolCollector = new FileSymbolCollector($project);

$files = (new Finder())
    ->files()
    ->in(array_values($pathsByNamespace))
    ->name('*.php');

foreach ($files as $fileInfo) {
    $absolutePath = $fileInfo->getRealPath();
    echo "Handling '$absolutePath'..." . PHP_EOL;
    $file = new File($absolutePath);
    $project->addFile($file);
    $symbolCollector->handle($file);
}

echo 'Finished!';

$root = realpath(__DIR__.'/..');
$graph = new LsifDumpContainer($root);
(new LsifDumpWriter())->write($graph, "$root/dump.lsif");
