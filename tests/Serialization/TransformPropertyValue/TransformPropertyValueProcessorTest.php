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
        array $context,
        mixed $expected
    ): void {
        $reflectionProperty = new ReflectionProperty($object, $propertyName);

        $result = TransformPropertyValueProcessor::transform(
            $object,
            $reflectionProperty,
            $context,
        );

        $this->assertSame($expected, $result);
    }
}
