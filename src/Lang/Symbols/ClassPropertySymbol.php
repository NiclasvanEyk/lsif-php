<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use NiclasVanEyk\LsifPhp\Lang\Symbol;
use PhpParser\Node\Stmt\Class_;

abstract class ClassPropertySymbol extends Symbol
{
    public function __construct(protected Class_ $class) { }
}
