<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\DataProvider;

use Constup\PhpAttributes\Exceptions\Exceptions\ValidatePropertyException;
use Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\TestSamples\PropertyValidatorSample;

readonly class ValidateWithBoolResultDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present. Validation success.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentBoolResult',
                'validationArguments' => ['attributeIsPresentBoolResult' => [5]],
                'expected' => true,
            ],
            'Attribute is present. Validation failure.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentBoolResult',
                'validationArguments' => ['attributeIsPresentBoolResult' => [15]],
                'expected' => false,
            ],
            'Attribute is not present.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsNotPresent',
                'validationArguments' => [],
                'expected' => false,
            ],
            'Generic object.' => [
                'object' => (object)['randomPropertyName' => 'irrelevantValue'],
                'propertyName' => 'randomPropertyName',
                'validationArguments' => [],
                'expected' => null,
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Attribute is present. Validation arguments are empty.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentBoolResult',
                'validationArguments' => [],
                'expectedException' => ValidatePropertyException::class,
                'expectedExceptionCode' => 3000,
            ],
            'Attribute is present. Validation arguments do not contain property name.' => [
                'object' => new PropertyValidatorSample(10),
                'propertyName' => 'attributeIsPresentBoolResult',
                'validationArguments' => ['notApplicableProperty' => ['somePrefix_']],
                'expectedException' => ValidatePropertyException::class,
                'expectedExceptionCode' => 3000,
            ],
        ];
    }
}
