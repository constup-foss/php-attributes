<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Common;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Contains a set of common methods for processing attributes that have no arguments.
 */
readonly class AttributeWithNoArgumentsProcessor
{
    /**
     * Detects if the given class or object has the provided attribute.
     *
     * @param string|object $classOrObject
     * @param string        $attributeFqn
     *
     * @throws ReflectionException
     *
     * @return bool
     */
    public static function detectForClassOrObject(
        string|object $classOrObject,
        string $attributeFqn,
    ): bool {
        $reflectionClass = new ReflectionClass($classOrObject);
        $attributes = $reflectionClass->getAttributes($attributeFqn);

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
     */
    public static function detectForProperty(
        string|object $classOrObject,
        string $propertyName,
        string $attributeFqn,
    ): bool {
        $reflectionProperty = new ReflectionProperty($classOrObject, $propertyName);
        $attributes = $reflectionProperty->getAttributes($attributeFqn);

        return !empty($attributes);
    }
}
