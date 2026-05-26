<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue;

use Constup\PhpAttributes\Serialization\TransformPropertyValue\TransformPropertyValueProcessor;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\DataProvider\TransformPropertyValueProcessor\TransformDataProvider;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\DataProvider\TransformPropertyValueProcessor\TransformFromObjectDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class TransformPropertyValueProcessorTest extends TestCase
{
    #[DataProviderExternal(
        TransformFromObjectDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_transformFromObject_HappyFlow(
        object $object,
        string $propertyName,
        array $transformationArguments,
        mixed $expected
    ): void {
        $result = TransformPropertyValueProcessor::transformFromObject(
            $object,
            $propertyName,
            $transformationArguments,
        );

        $this->assertSame($expected, $result);
    }

    #[DataProviderExternal(
        TransformFromObjectDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_transformFromObject_ErrorFlow(
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

        TransformPropertyValueProcessor::transformFromObject(
            $object,
            $propertyName,
            $transformationArguments,
        );
    }

    #[DataProviderExternal(
        TransformDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_transform_HappyFlow(
        mixed $propertyValue,
        string $className,
        string $propertyName,
        array $transformationArguments,
        mixed $expected
    ): void {
        $result = TransformPropertyValueProcessor::transform(
            $propertyValue,
            $className,
            $propertyName,
            $transformationArguments,
        );

        $this->assertSame($expected, $result);
    }

    #[DataProviderExternal(
        TransformDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_transform_ErrorFlow(
        mixed $propertyValue,
        string $className,
        string $propertyName,
        array $transformationArguments,
        string $expectedException,
        ?int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        if ($expectedExceptionCode !== null) {
            $this->expectExceptionCode($expectedExceptionCode);
        }

        TransformPropertyValueProcessor::transform(
            $propertyValue,
            $className,
            $propertyName,
            $transformationArguments,
        );
    }

    #[DataProviderExternal(
        TransformFromObjectDataProvider::class,
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
        TransformFromObjectDataProvider::class,
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
