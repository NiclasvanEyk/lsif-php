<?php

namespace NiclasVanEyk\LsifPhp\PhpStan;

use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\DocumentContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\ProjectContainer;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Node\FileNode;

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

        if ($node instanceof Class_) {
            $this->processClassNode($node);
        }
    }

    public function flushCurrentDocument(): void
    {
        if ($this->currentDocument !== null) {
            $this->project->endDocument($this->currentDocument->document);
        }
    }

    private function processFileNode(FileNode $node, Scope $scope): void
    {
        $this->flushCurrentDocument();
        $this->currentDocument = $this->project->beginDocument($scope->getFile());
    }

    private function processClassNode(Class_ $node): void {
        if ($this->currentDocument === null) return;

        $this->currentDocument->addDefinition($node);
    }
}
