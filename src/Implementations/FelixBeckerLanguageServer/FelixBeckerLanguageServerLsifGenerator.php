<?php

namespace NiclasVanEyk\LsifPhp\Implementations\FelixBeckerLanguageServer;

use LanguageServer\Cache\FileSystemCache;
use LanguageServer\ContentRetriever\FileSystemContentRetriever;
use LanguageServer\Definition;
use LanguageServer\DefinitionResolver;
use LanguageServer\FilesFinder\FileSystemFilesFinder;
use LanguageServer\Index\ProjectIndex;
use LanguageServer\Indexer;
use LanguageServer\LanguageClient;
use LanguageServer\LanguageServer;
use LanguageServer\PhpDocumentLoader;
use LanguageServer\ProtocolStreamWriter;
use NiclasVanEyk\LsifPhp\Implementations\FelixBeckerLanguageServerMocks\MockProtocolStream;
use NiclasVanEyk\LsifPhp\LsifGenerator;

/**
 *
 * Inspired by the {@link LanguageServer}.
 */
class FelixBeckerLanguageServerLsifGenerator implements LsifGenerator
{
    private LanguageClient $client;
    private string $rootPath;
    private FileSystemCache $cache;
    private FileSystemFilesFinder $filesFinder;
    private FileSystemContentRetriever $contentRetriever;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
        $this->cache = new FileSystemCache();
        $this->filesFinder = new FileSystemFilesFinder();
        $this->contentRetriever = new FileSystemContentRetriever();
        $this->client = new LanguageClient(
            new MockProtocolStream(), 
            new ProtocolStreamWriter(STDOUT), 
        );
    }

    public function generate(): void
    {
        $composerJson = null;
        $composerLock = null;

        if (is_file("$this->rootPath/composer.json")) {
            $composerJson = json_decode(file_get_contents("$this->rootPath/composer.json"));
        }

        if (is_file("$this->rootPath/composer.lock")) {
            $composerJson = json_decode(file_get_contents("$this->rootPath/composer.lock"));
        }

        $index = new IndexBundle($composerJson);

        $definitionResolver = new DefinitionResolver($index->global);
        $documentLoader = new PhpDocumentLoader(
            $this->contentRetriever,
            $index->project,
            $definitionResolver,
        );

        $indexer = new Indexer(
            $this->filesFinder,
            $this->rootPath,
            $this->client,
            $this->cache,
            $index->dependencies,
            $index->source,
            $documentLoader,
            $composerLock,
            $composerJson
        );

        echo 'Starting Indexer' . PHP_EOL;
        $indexer->index()
            ->otherwise(function ($reason) {
                echo 'Indexer crashed' . $reason .  PHP_EOL;
            })
            ->then(function () use ($index) {
                echo 'Indexer finished!' . PHP_EOL;

                $definitions = $this->extractDefinitions($index->project);
                $references = $index->source->getReferences();
                $i = 0;
                xdebug_break();

                foreach ($definitions as $fqn => $definition) {
                    if ($i > 10) break;
                    echo $fqn . PHP_EOL;
                    var_dump($definition);
                    $i++;
                }
            })
            ->wait();
    }

    /**
     * @param ProjectIndex $projectIndex
     * @return array<string, Definition>
     */
    private function extractDefinitions(ProjectIndex $projectIndex): array
    {
        return iterator_to_array($projectIndex->getDefinitions());
    }
}