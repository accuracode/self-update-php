<?php

namespace Accuracode\SelfUpdate;

use Accuracode\SelfUpdate\Base\DriverInterface;
use Accuracode\SelfUpdate\Base\ReleaseInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SelfUpdate
{
    /**  @var DriverInterface */
    private $driver;
    /** @var ClientInterface */
    private $client;
    /** @var RequestFactoryInterface */
    private $requestFactory;
    /** @var ?string */
    private $baseVersion;

    public function __construct(
        DriverInterface $config,
        ClientInterface $client,
        RequestFactoryInterface $requestFactory
    ) {
        $this->driver = $config;
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @return ReleaseInterface[]
     */
    public function getUpdates(): array
    {
        return $this->driver->processUpdatesResponse(
            $this->sendRequest(
                $this->driver->buildUpdatesRequest($this->requestFactory)
            )
        );
    }

    protected function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->client->sendRequest($request);
    }
}
