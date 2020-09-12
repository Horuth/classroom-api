<?php

namespace App\Api\Validator;

use App\Api\Service\ClassroomRequestHandlerService;
use App\Core\Service\JsonDecoder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ClassroomRequestValidatorTest extends TestCase
{
    /**
     * @dataProvider dataProviderSuccess
     */
    public function testValidateClassroomRequestSuccess($nameValue): void
    {
        $sut = $this->createSut();
        $request = $this->buildRequest($nameValue);

        $sut->validateClassroomRequest($request);
        $this->assertTrue(true);
    }

    public function dataProviderSuccess(): array
    {
        return [
            ['Abc'],
            ['A'],
        ];
    }

    /**
     * @dataProvider dataProviderFail
     */
    public function testValidateClassroomRequestFail($nameValue): void
    {
        $this->expectException(BadRequestHttpException::class);

        $sut = $this->createSut();
        $request = $this->buildRequest($nameValue);

        $sut->validateClassroomRequest($request);
    }

    public function dataProviderFail(): array
    {
        return [
            [null],
            [0],
            [''],
        ];
    }

    private function buildRequest($nameValue): Request
    {
        return new Request([], [], [], [], [], [], json_encode(['name' => $nameValue]));
    }

    private function createSut(): ClassroomRequestValidator
    {
        $jsonDecoder = new JsonDecoder();
        $classroomRequestHandlerService = new ClassroomRequestHandlerService($jsonDecoder);

        return new ClassroomRequestValidator($classroomRequestHandlerService);
    }
}
