<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\DoNotSerialize;

use Constup\PhpAttributes\Serialization\DoNotSerialize\DoNotSerializeDetector;
use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeDetector\DetectForReflectionClassDataProvider;
use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeDetector\DetectForReflectionPropertyDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;

class DoNotSerializeDetectorTest extends TestCase
{
    #[DataProviderExternal(
        DetectForReflectionClassDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_detectForReflectionClass_HappyFlow(
        string|object $classOrObject,
        bool $expected
    ): void {
        $reflectionClass = new ReflectionClass($classOrObject);
        $result = DoNotSerializeDetector::detectForReflectionClass($reflectionClass);

        $this->assertSame($expected, $result);
    }

    #[DataProviderExternal(
        DetectForReflectionClassDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_detectForReflectionClass_ErrorFlow(
        string|object $classOrObject,
        string $expectedException
    ): void {
        $this->expectException($expectedException);

        $reflectionClass = new ReflectionClass($classOrObject);
        DoNotSerializeDetector::detectForReflectionClass($reflectionClass);
    }

    #[DataProviderExternal(
        DetectForReflectionPropertyDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_detectForReflectionProperty_HappyFlow(
        string|object $classOrObject,
        string $propertyName,
        bool $expected
    ): void {
        $reflectionProperty = new ReflectionProperty($classOrObject, $propertyName);
        $result = DoNotSerializeDetector::detectForReflectionProperty($reflectionProperty);

        $this->assertSame($expected, $result);
    }

    #[DataProviderExternal(
        DetectForReflectionPropertyDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_detectForReflectionProperty_ErrorFlow(
        string|object $classOrObject,
        string $propertyName,
        string $expectedException
    ): void {
        $this->expectException($expectedException);

        $reflectionProperty = new ReflectionProperty($classOrObject, $propertyName);
        DoNotSerializeDetector::detectForReflectionProperty($reflectionProperty);
    }
}
