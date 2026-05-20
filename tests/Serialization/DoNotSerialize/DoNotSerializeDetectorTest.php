<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\DoNotSerialize;

use Constup\PhpAttributes\Serialization\DoNotSerialize\DoNotSerializeDetector;
use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeDetector\DetectForClassOrObjectDataProvider;
use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeDetector\DetectForPropertyDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class DoNotSerializeDetectorTest extends TestCase
{
    #[DataProviderExternal(
        DetectForClassOrObjectDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_detectForClassOrObject_HappyFlow(
        string|object $classOrObject,
        bool $expected
    ): void {
        $result = DoNotSerializeDetector::detectForClassOrObject($classOrObject);

        $this->assertSame($expected, $result);
    }

    #[DataProviderExternal(
        DetectForClassOrObjectDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_detectForClassOrObject_ErrorFlow(
        string|object $classOrObject,
        string $expectedException
    ): void {
        $this->expectException($expectedException);

        DoNotSerializeDetector::detectForClassOrObject($classOrObject);
    }

    #[DataProviderExternal(
        DetectForPropertyDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_detectForProperty_HappyFlow(
        string|object $classOrObject,
        string $propertyName,
        bool $expected
    ): void {
        $result = DoNotSerializeDetector::detectForProperty($classOrObject, $propertyName);

        $this->assertSame($expected, $result);
    }

    #[DataProviderExternal(
        DetectForPropertyDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_detectForProperty_ErrorFlow(
        string|object $classOrObject,
        string $propertyName,
        string $expectedException
    ): void {
        $this->expectException($expectedException);

        DoNotSerializeDetector::detectForProperty($classOrObject, $propertyName);
    }
}
