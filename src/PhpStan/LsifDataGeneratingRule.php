<?php

namespace NiclasVanEyk\LsifPhp\PhpStan;

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
        echo 'LsifDataGeneratingRule::__destruct' . PHP_EOL;
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
