<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeDetector;

use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\TestSamples\DoNotSerializeClass;
use ReflectionException;

readonly class DetectForPropertyDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present in a property of a class.' => [
                'classOrObject' => DoNotSerializeClass::class,
                'propertyName' => 'doNotSerialize',
                'expected' => true,
            ],
            'Attribute is not present in a property of a class.' => [
                'classOrObject' => DoNotSerializeClass::class,
                'propertyName' => 'serialize',
                'expected' => false,
            ],
            'Attribute is present in a property of an object.' => [
                'classOrObject' => new DoNotSerializeClass('serialize', 'doNotSerialize'),
                'propertyName' => 'doNotSerialize',
                'expected' => true,
            ],
            'Attribute is not present in a property of an object.' => [
                'classOrObject' => new DoNotSerializeClass('serialize', 'doNotSerialize'),
                'propertyName' => 'serialize',
                'expected' => false,
            ],
            'Generic object.' => [
                'classOrObject' => (object)['targetProperty' => 'irrelevantValue'],
                'propertyName' => 'targetProperty',
                'expected' => false,
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Invalid class name.' => [
                'classOrObject' => '\InvalidClass',
                'propertyName' => 'serialize',
                'expectedException' => ReflectionException::class,
            ],
            'Invalid property name.' => [
                'classOrObject' => DoNotSerializeClass::class,
                'propertyName' => 'invalidPropertyName',
                'expectedException' => ReflectionException::class,
            ],
        ];
    }
}
