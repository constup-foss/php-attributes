<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName;

use Constup\PhpAttributes\Serialization\TransformPropertyName\TransformPropertyNameProcessor;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\DataProvider\TransformPropertyNameProcessor\TransformDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class TransformPropertyNameProcessorTest extends TestCase
{
    #[DataProviderExternal(
        TransformDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_transform_HappyFlow(
        object $object,
        string $propertyName,
        array $context,
        string $expected
    ): void {
        $reflectionProperty = new ReflectionProperty($object, $propertyName);

        $result = TransformPropertyNameProcessor::transform($reflectionProperty, $context);

        $this->assertSame($expected, $result);
    }
}
