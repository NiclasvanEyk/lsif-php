<?php

namespace NiclasVanEyk\LsifPhp\PhpStan;

use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\DocumentContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\ProjectContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Document;
use PhpParser\Builder\Class_;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Node\FileNode;
use PHPStan\Reflection\ClassReflection;

class PhpStanLsifGenerator
{
    public LsifDumpContainer $dump;
    private ?DocumentContainer $currentDocument = null;
    private ProjectContainer $project;

    public function __construct(private string $projectRoot)
    {
        $this->dump = new LsifDumpContainer($this->projectRoot);
        $this->project = $this->dump->beginProject($this->projectRoot);
    }

    public function processNode(Node $node, Scope $scope): void
    {
        if ($node instanceof FileNode) {
            $this->processFileNode($node, $scope);
            return;
        }

        if ($node instanceof Class_
            && ($class = $scope->getClassReflection()) === null) {
            $this->processClassNode($node, $class, $scope);
        }
    }

    private function processFileNode(FileNode $node, Scope $scope): void
    {
        if ($this->currentDocument !== null) {
            $this->dump->endDocument($this->currentDocument);
        }

        $this->currentDocument = $this->dump->beginDocument($scope->getFile());
    }

    private function processClassNode(Class_ $node, ClassReflection $class, Scope $scope)
    {
        if ($this->currentDocument === null) return;

        $this->currentDocument->addDefinition();
    }
}
