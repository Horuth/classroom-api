<?php

namespace App\Core\Service;

use App\Core\Exception\InvalidJsonStringException;
use PHPUnit\Framework\TestCase;

class JsonDecoderTest extends TestCase
{
    /**
     * @dataProvider dataProviderSuccess
     */
    public function testJsonDecodeSuccess(string $string, array $expectedResult): void
    {
        $sut = new JsonDecoder();
        $actualResult = $sut->jsonDecode($string);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function dataProviderSuccess(): array
    {
        return [
            ['{}', []],
            ['{"a": 1}', ["a" => 1]],
        ];
    }

    /**
     * @dataProvider dataProviderFail
     */
    public function testJsonDecodeFail(string $string): void
    {
        $this->expectException(InvalidJsonStringException::class);

        $sut = new JsonDecoder();
        $sut->jsonDecode($string);
    }

    public function dataProviderFail(): array
    {
        return [
            [''],
            ['}'],
        ];
    }
}
