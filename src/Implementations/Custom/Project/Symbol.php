<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project;

abstract class Symbol
{
    /**
     * @return string A name that identifies this symbol inside the project.
     */
    abstract function fqn(): string;

    public array $references;
}
