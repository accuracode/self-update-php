<?php

namespace Accuracode\SelfUpdate\Driver\Github;

use Accuracode\SelfUpdate\Base\AssetInterface;
use Accuracode\SelfUpdate\Base\ReleaseInterface;
use DateTimeImmutable;

class Release implements ReleaseInterface
{
    /* @var string */
    private $name;
    /* @var string */
    private $version;
    /* @var DateTimeImmutable */
    private $availableAt;
    /* @var AssetInterface[] */
    private $assets = [];

    /**
     * @param array{name: string, tag_name: string, published_at: string, assets: array} $data
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->version = $data['tag_name'];
        $this->availableAt = new DateTimeImmutable($data['published_at']);
        $this->assets = array_map(
            [$this, 'createAsset'],
            $data['assets'] ?? []
        );
    }

    /**
     * @param array{name: string, size: string, type: string, downloadUrl: string} $definition
     */
    public function createAsset(array $definition): AssetInterface
    {
        return new Asset($definition);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getAvailableAt(): DateTimeImmutable
    {
        return $this->availableAt;
    }

    public function getAssets(): array
    {
        return $this->assets;
    }
}
