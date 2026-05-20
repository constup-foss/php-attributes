<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\TestSamples;

readonly class PrefixSuffixTransformer
{
    public static function applyPrefixSuffix(
        string $original,
        array $transformationArguments,
    ): string {
        return $transformationArguments['prefix'] . $original . $transformationArguments['suffix'];
    }
}
