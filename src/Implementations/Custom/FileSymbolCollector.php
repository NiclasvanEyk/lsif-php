<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\ComposerProject;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\File;
use NiclasVanEyk\LsifPhp\Implementations\Custom\SymbolCollection\ComposerProjectDeclarationHandler;
use NiclasVanEyk\ScopeResolvingVisitor\ScopeResolvingVisitor;
use PhpParser\Lexer;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\Parser\Php7;

class FileSymbolCollector
{
    public function __construct(private ComposerProject $project) { }

    public function handle(File $file)
    {
        $statements = $this->parse($file->contents());

        $traverser = new NodeTraverser();
        $traverser->addVisitor(new NameResolver());
        $traverser->addVisitor(($scopeVisitor = new ScopeResolvingVisitor()));
        $traverser->addVisitor(new SymbolCollectingVisitor(
            $file,
            $scopeVisitor,
            new ComposerProjectDeclarationHandler($this->project),
        ));

        $traverser->traverse($statements);
    }

    private function parse(string $contents): array
    {
        return (new Php7($this->lexer()))->parse($contents);
    }

    private function lexer(): Lexer
    {
        return new Lexer\Emulative([
            'usedAttributes' => [
                'comments',
                'startLine',
                'endLine',
                'startTokenPos',
                'endTokenPos',
            ],
        ]);
    }
}
