<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\DataProvider;

use Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\TestSamples\PropertyValidatorSample;

readonly class ValidateWithBoolResultDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present. Validation success.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentBoolResult',
                'context' => ['compareTo' => 5],
                'expected' => true,
            ],
            'Attribute is present. Validation failure.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentBoolResult',
                'context' => ['compareTo' => 15],
                'expected' => false,
            ],
            'Attribute is not present.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsNotPresent',
                'context' => [],
                'expected' => false,
            ],
            'Generic object.' => [
                'object' => (object)['randomPropertyName' => 'irrelevantValue'],
                'propertyName' => 'randomPropertyName',
                'context' => [],
                'expected' => null,
            ],
        ];
    }
}
