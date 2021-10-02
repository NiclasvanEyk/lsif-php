<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\LsifGraph;
use PhpParser\Lexer;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\Parser\Php7;

class FileTraverser
{
    private LsifGraph $graph;

    public function parse(string $contents)
    {
        $lexer = new Lexer\Emulative([
            'usedAttributes' => [
                'comments',
                'startLine',
                'endLine',
                'startTokenPos',
                'endTokenPos',
                'startFilePos',
                'endFilePos',
            ],
        ]);
        $parser = new Php7($lexer);
        $statements = $parser->parse($contents);

        $traverser = new NodeTraverser();
        $traverser->addVisitor(new NameResolver());
        $graphItemCollector = new LsifGraphItemCollectingVisitor();
        $traverser->addVisitor($graphItemCollector);
        $traverser->traverse($statements);
    }
}