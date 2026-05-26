<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName;

use Constup\PhpAttributes\Serialization\TransformPropertyName\TransformPropertyNameProcessor;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\DataProvider\TransformPropertyNameProcessor\TransformReflectionPropertyDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class TransformPropertyNameProcessorTest extends TestCase
{
    #[DataProviderExternal(
        TransformReflectionPropertyDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_transformReflectionProperty_HappyFlow(
        object $object,
        string $propertyName,
        array $transformationArguments,
        string $expected
    ): void {
        $reflectionProperty = new ReflectionProperty($object, $propertyName);

        $result = TransformPropertyNameProcessor::transformReflectionProperty(
            $reflectionProperty,
            $transformationArguments,
        );

        $this->assertSame($expected, $result);
    }

    #[DataProviderExternal(
        TransformReflectionPropertyDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_transformReflectionProperty_ErrorFlow(
        object $object,
        string $propertyName,
        array $transformationArguments,
        string $expectedException,
        ?int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        if ($expectedExceptionCode !== null) {
            $this->expectExceptionCode($expectedExceptionCode);
        }

        $reflectionProperty = new ReflectionProperty($object, $propertyName);

        TransformPropertyNameProcessor::transformReflectionProperty(
            $reflectionProperty,
            $transformationArguments,
        );
    }
}
