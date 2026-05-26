<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Common;

use ReflectionClass;
use ReflectionException;
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
     * Detects if the given class or object has the provided attribute.
     *
     * @param string|object $classOrObject
     * @param string        $attributeFqn
     *
     * @throws ReflectionException
     *
     * @return bool
     *
     * @see ../../doc/common_attribute_processors/attribute_with_no_arguments_processor.adoc
     */
    public static function detectForClassOrObject(
        string|object $classOrObject,
        string $attributeFqn,
    ): bool {
        $reflectionClass = new ReflectionClass($classOrObject);

        return self::detectForReflectionClass($reflectionClass, $attributeFqn);
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

    /**
     * Detects if the given property of a class or object has the provided attribute.
     *
     * @param string|object $classOrObject
     * @param string        $propertyName
     * @param string        $attributeFqn
     *
     * @throws ReflectionException
     *
     * @return bool
     *
     * @see ../../doc/common_attribute_processors/attribute_with_no_arguments_processor.adoc
     */
    public static function detectForProperty(
        string|object $classOrObject,
        string $propertyName,
        string $attributeFqn,
    ): bool {
        $reflectionProperty = new ReflectionProperty($classOrObject, $propertyName);

        return self::detectForReflectionProperty($reflectionProperty, $attributeFqn);
    }
}
