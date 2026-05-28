<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\DoNotSerialize;

use Constup\PhpAttributes\Common\IsAttributePresent;
use ReflectionClass;
use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
 */
readonly class DoNotSerializeProcessor
{
    /**
     * Detects if the given class or object has the DoNotSerialize attribute.
     *
     * @param ReflectionClass $reflectionClass
     *
     * @return bool
     *
     * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
     */
    public static function detectForReflectionClass(
        ReflectionClass $reflectionClass,
    ): bool {
        return IsAttributePresent::detectForReflectionClass($reflectionClass, DoNotSerialize::class);
    }

    /**
     * Detects if the given reflection property has the DoNotSerialize attribute.
     *
     * @param ReflectionProperty $reflectionProperty
     *
     * @return bool
     *
     * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
     */
    public static function detectForReflectionProperty(
        ReflectionProperty $reflectionProperty,
    ): bool {
        return IsAttributePresent::detectForReflectionProperty($reflectionProperty, DoNotSerialize::class);
    }
}
