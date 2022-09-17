<?php

namespace Accuracode\SelfUpdate\Exception;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;

/**
 * @method ClientExceptionInterface getPrevious
 */
class FetchFailedException extends AbstractSelfUpdateException
{
    public function __construct(ClientExceptionInterface $exception)
    {
        parent::__construct('Error during request', 0, $exception);
    }

    public function getIsNetworkError(): bool
    {
        return $this->getClientException() instanceof NetworkExceptionInterface;
    }

    public function getIsRequestError(): bool
    {
        return $this->getClientException() instanceof RequestExceptionInterface;
    }

    public function getClientException(): ClientExceptionInterface
    {
        return $this->getPrevious();
    }
}
