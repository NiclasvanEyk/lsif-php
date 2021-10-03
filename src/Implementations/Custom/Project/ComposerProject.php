<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project;

use NiclasVanEyk\LsifPhp\Lang\Symbol;

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

    public function __construct(private string $root) { }

    public function define(Symbol $symbol)
    {
        $this->symbols[$symbol->fqn()] = $symbol;
    }

    public function addFile(File $file)
    {
        $this->files[$file->path] = $file;
    }
}
