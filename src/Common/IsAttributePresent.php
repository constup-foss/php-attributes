<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Common;

use ReflectionClass;
use ReflectionProperty;

/**
 * Detect if the attribute is present.
 */
class IsAttributePresent
{
    /**
     * Detects if the given reflection class has the provided attribute.
     *
     * @param ReflectionClass $reflectionClass
     * @param string          $attributeFqn
     *
     * @return bool
     *
     * @see ../../doc/common_attribute_processors/is_attribute_present.adoc
     */
    public static function detectForReflectionClass(
        ReflectionClass $reflectionClass,
        string $attributeFqn,
    ): bool {
        $attributes = $reflectionClass->getAttributes($attributeFqn);

        return !empty($attributes);
    }

    /**
     * Detects if the given reflection property has the provided attribute.
     *
     * @param ReflectionProperty $reflectionProperty
     * @param string             $attributeFqn
     *
     * @return bool
     *
     * @see ../../doc/common_attribute_processors/is_attribute_present.adoc
     */
    public static function detectForReflectionProperty(
        ReflectionProperty $reflectionProperty,
        string $attributeFqn,
    ): bool {
        $attributes = $reflectionProperty->getAttributes($attributeFqn);

        return !empty($attributes);
    }
}
