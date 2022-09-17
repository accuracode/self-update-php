<?php

namespace Accuracode\SelfUpdate\Base;

use DateTimeImmutable;

interface ReleaseInterface
{
    public function getName(): string;

    public function getVersion(): string;

    public function getAvailableAt(): DateTimeImmutable;

    /**
     * @return AssetInterface[]
     */
    public function getAssets(): array;
}
