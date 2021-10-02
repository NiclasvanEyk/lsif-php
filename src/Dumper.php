<?php

namespace NiclasVanEyk\LsifPhp;

use LanguageServer\Definition;

class Dumper
{
    /**
     * Writes the {@link $definitions} to the {@link $target} file.
     *
     * @param Definition[] $definitions
     * @param string $target
     */
    public function dump(array $definitions, string $target): void
    {
        $dump = new LsifGraph();

        foreach ($definitions as $fqn => $definition) {
            $dump->add($definition);
        }

    }
}