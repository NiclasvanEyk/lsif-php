<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use NiclasVanEyk\LsifPhp\Lang\Symbol;
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
            . "[{$var->getStartLine()}:{$var->getStartTokenPos()}] $"
            .  $var->name;
    }
}
