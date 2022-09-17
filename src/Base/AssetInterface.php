<?php

namespace Accuracode\SelfUpdate\Base;

interface AssetInterface
{
    public function getName(): string;

    public function getSize(): int;

    public function getType(): string;

    public function getDownloadUrl(): string;
}
