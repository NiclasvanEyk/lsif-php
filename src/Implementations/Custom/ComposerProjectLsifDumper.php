<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\ComposerProject;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\File;
use Symfony\Component\Finder\Finder;

class ComposerProjectLsifDumper
{
    public static function dump(string $pathToComposerJson)
    {
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
    }
}
