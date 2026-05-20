<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\DataProvider\TransformPropertyNameProcessor;

use Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\TestSamples\TransformPropertyNameSample;
use ReflectionException;

readonly class TransformDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present in a class.' => [
                'classOrObject' => TransformPropertyNameSample::class,
                'propertyName' => 'applicableProperty',
                'transformationArguments' => ['applicableProperty' => ['somePrefix_']],
                'expected' => 'somePrefix_applicableProperty',
            ],
            'Attribute is not present in a class.' => [
                'classOrObject' => TransformPropertyNameSample::class,
                'propertyName' => 'notApplicableProperty',
                'transformationArguments' => [],
                'expected' => 'notApplicableProperty',
            ],
            'Attribute is present in an object.' => [
                'classOrObject' => new TransformPropertyNameSample(),
                'propertyName' => 'applicableProperty',
                'transformationArguments' => ['applicableProperty' => ['somePrefix_']],
                'expected' => 'somePrefix_applicableProperty',
            ],
            'Attribute is not present in an object.' => [
                'classOrObject' => new TransformPropertyNameSample(),
                'propertyName' => 'notApplicableProperty',
                'transformationArguments' => [],
                'expected' => 'notApplicableProperty',
            ],
            'Generic object.' => [
                'classOrObject' => (object)['randomPropertyName' => 'irrelevantValue'],
                'propertyName' => 'randomPropertyName',
                'transformationArguments' => [],
                'expected' => 'randomPropertyName',
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Invalid class name.' => [
                'classOrObject' => '\InvalidClass',
                'propertyName' => 'irrelevantMethodName',
                'expectedException' => ReflectionException::class,
            ],
            'Invalid property name.' => [
                'classOrObject' => TransformPropertyNameSample::class,
                'propertyName' => 'invalidPropertyName',
                'expectedException' => ReflectionException::class,
            ],
        ];
    }
}
