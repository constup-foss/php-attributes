<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\DataProvider\TransformPropertyValueProcessor;

use Constup\PhpAttributes\Exceptions\Exceptions\TransformPropertyValueException;
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
                'transformationArguments' => ['applicableProperty' => ['some_prefix_']],
                'expected' => 'some_prefix_original_value',
            ],
            'Attribute is not present.' => [
                'object' => new TransformPropertyValueSample(
                    applicableProperty: null,
                    notApplicableProperty: 'original_value',
                ),
                'propertyName' => 'notApplicableProperty',
                'transformationArguments' => [],
                'expected' => 'original_value',
            ],
            'Transformation arguments is an array.' => [
                'object' => new TransformPropertyValueSample(
                    applicableProperty: null,
                    notApplicableProperty: null,
                    arrayAsTransformationArguments: 'original_value',
                ),
                'propertyName' => 'arrayAsTransformationArguments',
                'transformationArguments' => ['arrayAsTransformationArguments' => [['prefix' => 'some_prefix_', 'suffix' => '_some_suffix']]],
                'expected' => 'some_prefix_original_value_some_suffix',
            ],
            'Generic object.' => [
                'object' => (object)['randomPropertyName' => 'irrelevantValue'],
                'propertyName' => 'randomPropertyName',
                'transformationArguments' => [],
                'expected' => 'irrelevantValue',
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Attribute is present. Transformation arguments are empty.' => [
                'object' => new TransformPropertyValueSample(),
                'propertyName' => 'applicableProperty',
                'transformationArguments' => [],
                'expectedException' => TransformPropertyValueException::class,
                'expectedExceptionCode' => 2000,
            ],
            'Attribute is present. Transformation arguments do not contain property name.' => [
                'object' => new TransformPropertyValueSample(),
                'propertyName' => 'applicableProperty',
                'transformationArguments' => ['notApplicableProperty' => ['somePrefix_']],
                'expectedException' => TransformPropertyValueException::class,
                'expectedExceptionCode' => 2000,
            ],
        ];
    }
}
