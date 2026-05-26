<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\DataProvider\TransformPropertyValueProcessor;

use Constup\PhpAttributes\Exceptions\Exceptions\TransformPropertyValueException;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\TestSamples\TransformPropertyValueSample;
use ReflectionException;

readonly class TransformDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present.' => [
                'propertyValue' => 'original_value',
                'className' => TransformPropertyValueSample::class,
                'propertyName' => 'applicableProperty',
                'transformationArguments' => ['applicableProperty' => ['some_prefix_']],
                'expected' => 'some_prefix_original_value',
            ],
            'Attribute is not present.' => [
                'propertyValue' => 'original_value',
                'className' => TransformPropertyValueSample::class,
                'propertyName' => 'notApplicableProperty',
                'transformationArguments' => [],
                'expected' => 'original_value',
            ],
            'Transformation arguments is an array.' => [
                'propertyValue' => 'original_value',
                'className' => TransformPropertyValueSample::class,
                'propertyName' => 'arrayAsTransformationArguments',
                'transformationArguments' => ['arrayAsTransformationArguments' => [['prefix' => 'some_prefix_', 'suffix' => '_some_suffix']]],
                'expected' => 'some_prefix_original_value_some_suffix',
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Invalid class name.' => [
                'propertyValue' => 'original_value',
                'className' => 'InvalidClassName',
                'propertyName' => 'irrelevantPropertyName',
                'transformationArguments' => [],
                'expectedException' => ReflectionException::class,
                'expectedExceptionCode' => null,
            ],
            'Invalid property name.' => [
                'propertyValue' => 'original_value',
                'className' => TransformPropertyValueSample::class,
                'propertyName' => 'invalidPropertyName',
                'transformationArguments' => [],
                'expectedException' => ReflectionException::class,
                'expectedExceptionCode' => null,
            ],
            'Attribute is present. Transformation arguments are empty.' => [
                'propertyValue' => 'original_value',
                'className' => TransformPropertyValueSample::class,
                'propertyName' => 'applicableProperty',
                'transformationArguments' => [],
                'expectedException' => TransformPropertyValueException::class,
                'expectedExceptionCode' => 2000,
            ],
            'Attribute is present. Transformation arguments do not contain property name.' => [
                'propertyValue' => 'original_value',
                'className' => TransformPropertyValueSample::class,
                'propertyName' => 'applicableProperty',
                'transformationArguments' => ['notApplicableProperty' => ['somePrefix_']],
                'expectedException' => TransformPropertyValueException::class,
                'expectedExceptionCode' => 2000,
            ],
        ];
    }
}
