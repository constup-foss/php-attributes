<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\PropertyValidator\DataProvider;

use Constup\PhpAttributes\Tests\Validation\ValidateProperty\PropertyValidator\TestSamples\PropertyValidatorSample;
use Constup\PhpAttributes\Tests\Validation\ValidateProperty\PropertyValidator\TestSamples\SampleException;
use ReflectionException;

readonly class ValidateWithVoidResultDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present. Validation success.' => [
                'object' => new PropertyValidatorSample(null, 10),
                'propertyName' => 'attributeIsPresentVoidResult',
                'validationArguments' => ['attributeIsPresentVoidResult' => [5]],
                'expectedException' => null,
            ],
            'Attribute is present. Validation failure.' => [
                'object' => new PropertyValidatorSample(null, 10),
                'propertyName' => 'attributeIsPresentVoidResult',
                'validationArguments' => ['attributeIsPresentVoidResult' => [15]],
                'expectedException' => SampleException::class,
            ],
            'Attribute is not present.' => [
                'object' => new PropertyValidatorSample(null, 10),
                'propertyName' => 'attributeIsNotPresent',
                'validationArguments' => [],
                'expectedException' => null,
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Invalid property name.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'invalidPropertyName',
                'validationArguments' => [],
                'expectedException' => ReflectionException::class,
            ],
        ];
    }
}
