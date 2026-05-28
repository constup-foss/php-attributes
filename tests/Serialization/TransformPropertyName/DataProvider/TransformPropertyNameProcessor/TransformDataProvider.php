<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\DataProvider\TransformPropertyNameProcessor;

use Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\TestSamples\TransformPropertyNameSample;

readonly class TransformDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present.' => [
                'object' => new TransformPropertyNameSample(),
                'propertyName' => 'applicableProperty',
                'context' => ['prefix' => 'somePrefix_'],
                'expected' => 'somePrefix_applicableProperty',
            ],
            'Attribute is not present.' => [
                'object' => new TransformPropertyNameSample(),
                'propertyName' => 'notApplicableProperty',
                'context' => [],
                'expected' => 'notApplicableProperty',
            ],
            'Generic object.' => [
                'object' => (object)['randomPropertyName' => 'irrelevantValue'],
                'propertyName' => 'randomPropertyName',
                'context' => [],
                'expected' => 'randomPropertyName',
            ],
        ];
    }
}
