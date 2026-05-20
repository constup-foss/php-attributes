<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName;

use Constup\PhpAttributes\Serialization\TransformPropertyName\TransformPropertyNameProcessor;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\DataProvider\TransformPropertyNameProcessor\TransformDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class TransformPropertyNameProcessorTest extends TestCase
{
    #[DataProviderExternal(
        TransformDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_transform_HappyFlow(
        string|object $classOrObject,
        string $propertyName,
        array $transformationArguments,
        string $expected
    ): void {
        $result = TransformPropertyNameProcessor::transform(
            $classOrObject,
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
        string|object $classOrObject,
        string $propertyName,
        string $expectedException
    ): void {
        $this->expectException($expectedException);

        TransformPropertyNameProcessor::transform(
            $classOrObject,
            $propertyName,
        );
    }
}
