<?php

namespace Accuracode\SelfUpdate\Driver\Github;

use Accuracode\SelfUpdate\Base\DriverInterface;
use Accuracode\SelfUpdate\Base\ReleaseInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Driver implements DriverInterface
{
    /** @var string */
    private $owner;
    /** @var string */
    private $repo;

    public function __construct(
        string $owner,
        string $repo
    )
    {
        $this->owner = $owner;
        $this->repo = $repo;
    }

    public function buildUpdatesRequest(RequestFactoryInterface $factory): RequestInterface
    {
        $request = $factory->createRequest(
            'GET',
            sprintf('https://api.github.com/repos/%s/%s/releases', $this->owner, $this->repo)
        );
        $request = $request->withProtocolVersion('2');

        return $request->withHeader('Accept', 'application/vnd.github+json');
    }

    public function processUpdatesResponse(ResponseInterface $response): array
    {
        return array_map(
            [$this, 'createRelease'],
            json_decode($response->getBody()->getContents(), true)
        );
    }

    public function createRelease(array $definition): ReleaseInterface
    {
        return new Release($definition);
    }
}
