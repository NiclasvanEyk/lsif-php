<?php

namespace NiclasVanEyk\LsifPhp\PhpStan;

use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifDumpWriter;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class LsifDataGeneratingRule implements Rule
{
    private PhpStanLsifGenerator $generator;

    public function __construct()
    {
        $projectRoot = realpath(__DIR__ . '/../../');
        $this->generator = new PhpStanLsifGenerator($projectRoot);
    }

    public function __destruct()
    {
        $this->generator->flushCurrentDocument();
        $destination = __DIR__ . '/../../dump.lsif';

        echo 'Finished LSIF item collection!' . PHP_EOL;
        echo "Writing dump to '$destination'..." . PHP_EOL;

        (new LsifDumpWriter())->write($this->generator->dump, $destination);
    }

    public function getNodeType(): string
    {
        return Node::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $this->generator->processNode($node, $scope);

        return [];
    }
}
