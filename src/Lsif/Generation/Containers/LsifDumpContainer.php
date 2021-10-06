<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

use NiclasVanEyk\LsifPhp\Lsif\Generation\IdGenerator;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\ProtocolVersion;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Begin;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\End;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Metadata;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Project;
use NiclasVanEyk\LsifPhp\Version;

class LsifDumpContainer implements \NiclasVanEyk\LsifPhp\Lsif\Protocol\Builder\IdGenerator
{
    private Metadata $metadata;
    private IdGenerator $ids;

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
    }

    public function nextId(): int
    {
        return $this->ids->nextId();
    }

    public function beginProject(string $uri, string $name, string $kind = 'php'): ProjectContainer
    {
        $project = new Project($this->nextId(), $kind, $name);
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

    /**
     * @return LsifGraphItem[]
     */
    public function items(): array
    {
        return $this->items;
    }
}
