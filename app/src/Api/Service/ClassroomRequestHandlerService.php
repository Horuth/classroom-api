<?php

namespace App\Api\Service;

use App\Api\Exception\RequestIsNotSetException;
use App\Core\Service\JsonDecoder;
use Symfony\Component\HttpFoundation\Request;

class ClassroomRequestHandlerService
{
    private const REQUEST_KEY_NAME = 'name';

    /** @var JsonDecoder $jsonDecoder */
    private $jsonDecoder;

    /** @var array $requestArray */
    private $requestArray;

    public function __construct(JsonDecoder $jsonDecoder)
    {
        $this->jsonDecoder = $jsonDecoder;
    }

    public function setRequest(Request $request): void
    {
        $content = $request->getContent();
        $json = $this->jsonDecoder->jsonDecode($content);

        $this->requestArray = $json;
    }

    public function getValueName(): ?string
    {
        if (!$this->getRequestArray()) {
            throw new RequestIsNotSetException();
        }

        return isset($this->getRequestArray()[self::REQUEST_KEY_NAME]) ? $this->getRequestArray()[self::REQUEST_KEY_NAME] : null;
    }

    private function getRequestArray(): array
    {
        return $this->requestArray;
    }
}
