<?php

namespace Accuracode\SelfUpdate\Driver\Github;

use Accuracode\SelfUpdate\Base\AssetInterface;

class Asset implements AssetInterface
{
    private $name;
    private $size;
    private $type;
    private $downloadUrl;

    /**
     * @param array{name: string, size: string, type: string, downloadUrl: string} $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->size = $data['size'];
        $this->type = pathinfo($data['name'], PATHINFO_EXTENSION);
        $this->downloadUrl = $data['browser_download_url'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDownloadUrl(): string
    {
        return $this->downloadUrl;
    }
}
