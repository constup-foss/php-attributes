<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Common;

use ReflectionClass;
use ReflectionProperty;

/**
 * Contains a set of common methods for processing attributes that have no arguments.
 *
 * @see ../../doc/common_attribute_processors/attribute_with_no_arguments_processor.adoc
 */
readonly class AttributeWithNoArgumentsProcessor
{
    /**
     * Detects if the given reflection class has the provided attribute.
     *
     * @param ReflectionClass $reflectionClass
     * @param string          $attributeFqn
     *
     * @return bool
     *
     * @see ../../doc/common_attribute_processors/attribute_with_no_arguments_processor.adoc
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
     * @see ../../doc/common_attribute_processors/attribute_with_no_arguments_processor.adoc
     */
    public static function detectForReflectionProperty(
        ReflectionProperty $reflectionProperty,
        string $attributeFqn,
    ): bool {
        $attributes = $reflectionProperty->getAttributes($attributeFqn);

        return !empty($attributes);
    }
}
