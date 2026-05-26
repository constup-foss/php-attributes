<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeProcessor;

use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\TestSamples\DoNotSerializeClass;

readonly class DetectForReflectionPropertyDataProvider
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
}
