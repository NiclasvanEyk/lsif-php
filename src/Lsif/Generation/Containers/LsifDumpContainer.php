<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\ProjectContainer;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\ProtocolVersion;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Begin;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\End;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Metadata;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Project;
use NiclasVanEyk\LsifPhp\Version;

class LsifDumpContainer
{
    private Metadata $metadata;
    private IdGenerator $ids;

    public LsifItemFactory $itemFactory;

    /** @var LsifGraphItem[] */
    private array $items = [];

    /** @var array<string, ProjectContainer> */
    public array $projects = [];

    public function __construct(private string $root)
    {
        $this->ids = new IdGenerator();
        $this->metadata = new Metadata(
            $this->nextId(),
            version: ProtocolVersion::ZERO_SIX_ZERO,
            projectRoot: $this->root,
            toolInfo: [
                'name' => 'lsif-php',
                'version' => Version::DEV(),
            ],
        );
        $this->addItem($this->metadata);
        $this->itemFactory = new LsifItemFactory($this);
    }

    public function nextId(): int
    {
        return $this->ids->next();
    }

    public function beginProject(string $uri, string $kind = 'php'): ProjectContainer
    {
        $project = new Project($this->nextId(), $kind);
        $container = new ProjectContainer($this, $project);
        $this->projects[$uri] = $container;

        $this->addItem($project);
        $this->addItem(new Begin($this->nextId(), 'project', $project->id));

        return $container;
    }

    public function endProject(Project $project): void
    {
        $this->addItem(new End($this->nextId(), 'project', $project->id));
    }

    public function addItem(LsifGraphItem $item): void
    {
        $this->items[] = $item;
    }

    public function items(): array
    {
        return $this->items;
    }
}
