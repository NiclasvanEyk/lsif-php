<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project;

class ComposerProject
{
    /**
     * All symbols of the document identified via their FQN + suffixes.
     *
     * @var array<string, Symbol>
     */
    public array $symbols = [];

    /**
     * All files and their references identified via their path from the project
     * root.
     *
     * @var array<string, File>
     */
    public array $files = [];

    public function define(Symbol $symbol)
    {
        $this->symbols[$symbol->fqn()] = $symbol;
    }
}
