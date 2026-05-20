<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\TestSamples;

readonly class PrefixTransformer
{
    public static function applyPrefix(
        string $originalValue,
        string $prefix
    ): string {
        return $prefix . $originalValue;
    }
}
