<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\LsifDumpContainer;

class LsifDumpWriter
{
    public function write(LsifDumpContainer $dump, string $destination): void
    {
        $output = fopen($destination, 'w');

        foreach ($dump->items() as $item) {
            $line = json_encode($item->toArray()) . PHP_EOL;
            fwrite($output, $line);
        }

        fclose($output);

        echo 'Finished writing ' . $destination . '!';
    }
}
