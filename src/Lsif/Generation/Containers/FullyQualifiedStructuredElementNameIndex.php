<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

/**
 * An index for everything inside a {@link LsifDumpContainer}.
 *
 * It is based on the **F**ully **S**tructured **E**lement **N**ame of a code
 * part. Modeled after [the phpDocumentor FQSEN](https://github.com/phpDocumentor/TypeResolver#resolving-an-fqsen)
 * standard.
 *
 * Note that only globally reachable structures should be saved in this index!
 * This includes structures that cannot be imported, like private functions, but
 * excludes local variables.
 *
 * As this is a LSIF specific index, we store a container for each range.
 */
class FullyQualifiedStructuredElementNameIndex
{
    
}
