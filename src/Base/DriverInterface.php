<?php

namespace Accuracode\SelfUpdate\Base;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface DriverInterface
{
    public function buildUpdatesRequest(RequestFactoryInterface $factory): RequestInterface;

    /**
     * @param ResponseInterface $response
     * @return ReleaseInterface[]
     */
    public function processUpdatesResponse(ResponseInterface $response): array;
}
