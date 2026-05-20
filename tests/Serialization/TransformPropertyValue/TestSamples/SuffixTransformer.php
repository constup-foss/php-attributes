<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\TestSamples;

readonly class SuffixTransformer
{
    public static function applySuffix(
        string $originalValue,
        string $suffix
    ): string {
        return $originalValue . $suffix;
    }
}
