<?php

namespace NiclasVanEyk\LsifPhp\Lang;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Range;

abstract class Symbol
{
    /**
     * @return string A name that identifies this symbol inside the project.
     */
    abstract function fqn(): string;

    private array $references;

    public function referencedIn(string $file, Range $range)
    {

    }
}
