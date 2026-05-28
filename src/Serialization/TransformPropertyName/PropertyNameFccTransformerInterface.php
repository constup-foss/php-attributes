<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyName;

/**
 * Implement this interface when creating a custom property name transformer for the `#[TransformPropertyName]` attribute.
 */
interface PropertyNameFccTransformerInterface
{
    /**
     * Transforms the given property name.
     *
     * @param string $propertyName The name of the property to transform.
     * @param array  $context      Additional information that can be used during transformation.
     *
     * @return string The transformed property name.
     */
    public static function transform(
        string $propertyName,
        array $context = []
    ): string;
}
