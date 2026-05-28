<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\DataProvider;

use Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\TestSamples\PropertyValidatorSample;
use Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\TestSamples\SampleException;

readonly class ValidateWithVoidResultDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present. Validation success.' => [
                'object' => new PropertyValidatorSample(null, 10),
                'propertyName' => 'attributeIsPresentVoidResult',
                'context' => ['compareTo' => 5],
                'expectedException' => null,
            ],
            'Attribute is present. Validation failure.' => [
                'object' => new PropertyValidatorSample(null, 10),
                'propertyName' => 'attributeIsPresentVoidResult',
                'context' => ['compareTo' => 15],
                'expectedException' => SampleException::class,
            ],
            'Attribute is not present.' => [
                'object' => new PropertyValidatorSample(null, 10),
                'propertyName' => 'attributeIsNotPresent',
                'context' => [],
                'expectedException' => null,
            ],
        ];
    }
}
