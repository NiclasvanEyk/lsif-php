<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbol;
use PhpParser\Node;

class VariableSymbol extends Symbol
{
    public function __construct(
        private string $filePath,
        private Node\VarLikeIdentifier|Node\Param $variable
    ) { }

    function fqn(): string
    {
        $var = $this->variable instanceof Node\Param
            ? $this->variable->var
            : $this->variable;

        return $this->filePath
            . '|'
            .  $var->name
            . '|'
            . $var->getStartLine()
            . ':'
            . $var->getStartTokenPos();
    }
}
