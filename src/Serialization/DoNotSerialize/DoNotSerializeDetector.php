<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\DoNotSerialize;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
 */
readonly class DoNotSerializeDetector
{
    /**
     * Detects if the given class or object has the DoNotSerialize attribute.
     *
     * @param string|object $classOrObject
     *
     * @throws ReflectionException
     *
     * @return bool
     *
     * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
     */
    public static function detectForClassOrObject(
        string|object $classOrObject,
    ): bool {
        $reflectionClass = new ReflectionClass($classOrObject);
        $attributes = $reflectionClass->getAttributes(DoNotSerialize::class);

        return !empty($attributes);
    }

    /**
     * Detects if the given property of a class or object has the DoNotSerialize attribute.
     *
     * @param string|object $classOrObject
     * @param string        $propertyName
     *
     * @throws ReflectionException
     *
     * @return bool
     *
     * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
     */
    public static function detectForProperty(
        string|object $classOrObject,
        string $propertyName,
    ): bool {
        $reflectionProperty = new ReflectionProperty($classOrObject, $propertyName);
        $attributes = $reflectionProperty->getAttributes(DoNotSerialize::class);

        return !empty($attributes);
    }
}
