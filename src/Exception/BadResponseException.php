<?php

namespace Accuracode\SelfUpdate\Exception;

class BadResponseException extends AbstractSelfUpdateException
{
    public function __construct()
    {
        parent::__construct($message, $code, $previous);
    }
}
