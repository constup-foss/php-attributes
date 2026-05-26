<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\DataProvider\TransformPropertyNameProcessor;

use Constup\PhpAttributes\Exceptions\Exceptions\TransformPropertyNameException;
use Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\TestSamples\TransformPropertyNameSample;

readonly class TransformReflectionPropertyDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present in an object.' => [
                'object' => new TransformPropertyNameSample(),
                'propertyName' => 'applicableProperty',
                'transformationArguments' => ['applicableProperty' => ['somePrefix_']],
                'expected' => 'somePrefix_applicableProperty',
            ],
            'Attribute is not present in an object.' => [
                'object' => new TransformPropertyNameSample(),
                'propertyName' => 'notApplicableProperty',
                'transformationArguments' => [],
                'expected' => 'notApplicableProperty',
            ],
            'Generic object.' => [
                'object' => (object)['randomPropertyName' => 'irrelevantValue'],
                'propertyName' => 'randomPropertyName',
                'transformationArguments' => [],
                'expected' => 'randomPropertyName',
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Attribute is present. Transformation arguments are empty.' => [
                'object' => new TransformPropertyNameSample(),
                'propertyName' => 'applicableProperty',
                'transformationArguments' => [],
                'expectedException' => TransformPropertyNameException::class,
                'expectedExceptionCode' => 1000,
            ],
            'Attribute is present. Transformation arguments do not contain property name.' => [
                'object' => new TransformPropertyNameSample(),
                'propertyName' => 'applicableProperty',
                'transformationArguments' => ['notApplicableProperty' => ['somePrefix_']],
                'expectedException' => TransformPropertyNameException::class,
                'expectedExceptionCode' => 1000,
            ],
        ];
    }
}
