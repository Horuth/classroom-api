<?php

namespace App\Api\Exception;

use Exception;
use Throwable;

class RequestIsNotSetException extends Exception
{
    private const ERROR_MESSAGE = 'Request is not set';

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct(self::ERROR_MESSAGE);
    }
}
