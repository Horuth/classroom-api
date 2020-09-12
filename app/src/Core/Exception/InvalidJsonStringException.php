<?php

namespace App\Core\Exception;

use Exception;
use Throwable;

class InvalidJsonStringException extends Exception
{
    private const ERROR_MESSAGE = 'Invalid json string';

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct(self::ERROR_MESSAGE);
    }
}
