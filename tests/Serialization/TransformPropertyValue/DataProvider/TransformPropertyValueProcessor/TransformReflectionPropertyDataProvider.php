<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\DataProvider\TransformPropertyValueProcessor;

use Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\TestSamples\TransformPropertyValueSample;

readonly class TransformReflectionPropertyDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present.' => [
                'object' => new TransformPropertyValueSample(
                    applicableProperty: 'original_value',
                ),
                'propertyName' => 'applicableProperty',
                'context' => ['prefix' => 'somePrefix_'],
                'expected' => 'somePrefix_original_value',
            ],
            'Attribute is not present.' => [
                'object' => new TransformPropertyValueSample(
                    applicableProperty: null,
                    notApplicableProperty: 'original_value',
                ),
                'propertyName' => 'notApplicableProperty',
                'context' => [],
                'expected' => 'original_value',
            ],
            'Generic object.' => [
                'object' => (object)['randomPropertyName' => 'irrelevantValue'],
                'propertyName' => 'randomPropertyName',
                'context' => [],
                'expected' => 'irrelevantValue',
            ],
        ];
    }
}
