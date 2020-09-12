<?php

namespace App\Core\Service;

use App\Core\Exception\InvalidJsonStringException;

class JsonDecoder
{
    public function jsonDecode(string $string): array
    {
        $decodedJson = json_decode($string, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decodedJson;
        } else {
            throw new InvalidJsonStringException();
        }
    }
}
