<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyValue;

/**
 * Implement this interface when creating a custom property value transformer for the `#[TransformPropertyValue]` attribute.
 */
interface PropertyValueFccTransformerInterface
{
    /**
     * Transforms the given property value.
     *
     * @param mixed $propertyValue The value of the property to transform.
     * @param array $context       Additional information that can be used during transformation.
     *
     * @return string The transformed property value.
     */
    public static function transform(
        mixed $propertyValue,
        array $context = []
    ): string;
}
