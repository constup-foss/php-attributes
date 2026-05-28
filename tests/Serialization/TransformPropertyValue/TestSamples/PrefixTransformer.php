<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\TestSamples;

readonly class PrefixTransformer
{
    public static function applyPrefix(
        mixed $originalValue,
        array $context,
    ): string {
        return $context['prefix'] . $originalValue;
    }
}
