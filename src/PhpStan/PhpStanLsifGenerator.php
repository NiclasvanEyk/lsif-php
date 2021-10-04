<?php

namespace NiclasVanEyk\LsifPhp\PhpStan;

use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\DocumentContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\ProjectContainer;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Node\FileNode;

/**
 * Generates stuff for stuff
 */
class PhpStanLsifGenerator
{
    public LsifDumpContainer $dump;
    private ?DocumentContainer $currentDocument = null;
    private ProjectContainer $project;

    public function __construct(private string $projectRoot)
    {
        $this->dump = new LsifDumpContainer($this->projectRoot);
        $this->project = $this->dump->beginProject($this->projectRoot, 'test');
    }

    public function processNode(Node $node, Scope $scope): void
    {
        if ($node instanceof FileNode) {
            $this->processFileNode($node, $scope);
            return;
        }

        if ($node instanceof Class_) {
            $this->processClassNode($node);
            return;
        }

        if ($node instanceof Node\Stmt\Property) {
            $this->processProperty($node);
        }

        if ($node instanceof Node\Stmt\ClassMethod) {
            $this->processClassMethod($node);
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
        if (!(($name = $node->name) instanceof Node)) return;

        $this->normalizeNameNode($name);
        $this->currentDocument->addDefinition($name, $node);
    }

    private function processClassMethod(Node\Stmt\ClassMethod $node): void
    {
        if ($this->currentDocument === null) return;
        if (!(($name = $node->name) instanceof Node)) return;

        $this->normalizeNameNode($name);
        $this->currentDocument->addDefinition($name, $node);
    }

    private function normalizeNameNode(Node\Name|Node\Identifier $name): void
    {
        $sameLine = $name->getStartLine() === $name->getEndLine();
        $sameColumn = $name->getStartTokenPos() === $name->getEndTokenPos();
        if ($sameLine && $sameColumn) {
            $nameLength = mb_strlen($name->name);
            $name->setAttribute('endTokenPos', $name->getStartTokenPos() + $nameLength);
        }
    }

    private function processProperty(Node\Stmt\Property $node)
    {
        if ($this->currentDocument === null) return;
        foreach ($node->props as $property) {
            if (!(($name = $property->name) instanceof Node)) continue;
            $this->currentDocument->addDefinition($name, $node);
        }
    }
}
