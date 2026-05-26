<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\DataProvider\DoNotSerializeProcessor;

use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\TestSamples\DoNotSerializeClass;
use Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\TestSamples\SerializeClass;
use stdClass;

readonly class DetectForReflectionClassDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Attribute is present in a class.' => [
                'classOrObject' => DoNotSerializeClass::class,
                'expected' => true,
            ],
            'Attribute is present in an object.' => [
                'classOrObject' => new DoNotSerializeClass('serialize', 'doNotSerialize'),
                'expected' => true,
            ],
            'Attribute is not present in a class.' => [
                'classOrObject' => SerializeClass::class,
                'expected' => false,
            ],
            'Attribute is not present in an object.' => [
                'classOrObject' => new SerializeClass(),
                'expected' => false,
            ],
            'Generic object.' => [
                'classOrObject' => new stdClass(),
                'expected' => false,
            ],
        ];
    }
}
