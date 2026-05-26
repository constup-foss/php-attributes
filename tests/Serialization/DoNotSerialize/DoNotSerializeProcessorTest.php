<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\DoNotSerialize;

use Constup\PhpAttributes\Serialization\DoNotSerialize\DoNotSerializeProcessor;
use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeProcessor\DetectForReflectionClassDataProvider;
use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeProcessor\DetectForReflectionPropertyDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;

class DoNotSerializeProcessorTest extends TestCase
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
        $result = DoNotSerializeProcessor::detectForReflectionClass($reflectionClass);

        $this->assertSame($expected, $result);
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
        $result = DoNotSerializeProcessor::detectForReflectionProperty($reflectionProperty);

        $this->assertSame($expected, $result);
    }
}
