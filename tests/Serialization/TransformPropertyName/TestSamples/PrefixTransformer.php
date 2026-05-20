<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\TestSamples;

readonly class PrefixTransformer
{
    public static function applyPrefix(
        string $propertyName,
        string $prefix,
    ): string {
        return $prefix . $propertyName;
    }
}
