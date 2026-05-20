<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\TestSamples;

readonly class SuffixTransformer
{
    public static function applySuffix(
        string $propertyName,
        string $suffix,
    ): string {
        return $propertyName . $suffix;
    }
}
