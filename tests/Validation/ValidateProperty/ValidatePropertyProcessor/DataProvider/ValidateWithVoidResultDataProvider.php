<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\DataProvider;

use Constup\PhpAttributes\Exceptions\Exceptions\ValidatePropertyException;
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
            'Attribute is present. Validation arguments are empty.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentVoidResult',
                'validationArguments' => [],
                'expectedException' => ValidatePropertyException::class,
                'expectedExceptionCode' => 3000,
            ],
            'Attribute is present. Validation arguments do not contain property name.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentVoidResult',
                'validationArguments' => ['notApplicableProperty' => ['somePrefix_']],
                'expectedException' => ValidatePropertyException::class,
                'expectedExceptionCode' => 3000,
            ],
        ];
    }
}
