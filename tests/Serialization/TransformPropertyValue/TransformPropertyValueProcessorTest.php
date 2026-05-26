<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue;

use Constup\PhpAttributes\Serialization\TransformPropertyValue\TransformPropertyValueProcessor;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\DataProvider\TransformPropertyValueProcessor\TransformReflectionPropertyDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class TransformPropertyValueProcessorTest extends TestCase
{
    #[DataProviderExternal(
        TransformReflectionPropertyDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_transformReflectionProperty_HappyFlow(
        object $object,
        string $propertyName,
        array $transformationArguments,
        mixed $expected
    ): void {
        $reflectionProperty = new ReflectionProperty($object, $propertyName);

        $result = TransformPropertyValueProcessor::transformReflectionProperty(
            $object,
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

        TransformPropertyValueProcessor::transformReflectionProperty(
            $object,
            $reflectionProperty,
            $transformationArguments,
        );
    }
}
