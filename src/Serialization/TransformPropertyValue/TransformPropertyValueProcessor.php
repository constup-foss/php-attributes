<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyValue;

use ReflectionException;
use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
 */
readonly class TransformPropertyValueProcessor
{
    /**
     * Returns a transformed version of a property value by running the closure defined in the attribute.
     * If the attribute is not present, the original property value is returned.
     *
     * Note that the closure is run with the property value as the first argument, followed by
     * `$transformationArguments`. This effectively means that your static method that does the transformation must have
     * the property value as its first argument.
     *
     * @param object               $object
     * @param string               $propertyName
     * @param array<string, mixed> $transformationArguments Associative array of additional transformation arguments.
     *                                                      Index is the name of the property the attribute is being applied to. Value is an array of arguments to be passed
     *                                                      to the transformation closure after the property value.
     *
     * @throws ReflectionException
     *
     * @return mixed
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
     */
    public static function transformFromObject(
        object $object,
        string $propertyName,
        array $transformationArguments = [],
    ): mixed {
        $reflectionProperty = new ReflectionProperty($object, $propertyName);
        $attributes = $reflectionProperty->getAttributes(TransformPropertyValue::class);
        $propertyValue = $reflectionProperty->getValue($object);

        if (empty($attributes)) {
            return $propertyValue;
        }

        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->transformer;
        $resolvedArguments = $transformationArguments[$propertyName] ?? [];

        return $closure($propertyValue, ...$resolvedArguments);
    }

    /**
     * Returns a transformed version of `$propertyValue` by running the closure defined in the attribute.
     * If the attribute is not present, the original `$propertyValue` is returned.
     *
     * Note that the closure is run with the `$propertyValue` as the first argument, followed by
     * `$transformationArguments`. This effectively means that your static method that does the transformation must have
     * the property value as its first argument.
     *
     * @param mixed  $propertyValue
     * @param string $className
     * @param string $propertyName
     * @param array  $transformationArguments Associative array of additional transformation arguments.
     *                                        Index is the name of the property the attribute is being applied to. Value is an array of arguments to be passed
     *                                        to the transformation closure after the property value.
     *
     * @throws ReflectionException
     *
     * @return mixed
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
     */
    public static function transform(
        mixed $propertyValue,
        string $className,
        string $propertyName,
        array $transformationArguments = [],
    ): mixed {
        $reflectionProperty = new ReflectionProperty($className, $propertyName);
        $attributes = $reflectionProperty->getAttributes(TransformPropertyValue::class);

        if (empty($attributes)) {
            return $propertyValue;
        }

        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->transformer;
        $resolvedArguments = $transformationArguments[$propertyName] ?? [];

        return $closure($propertyValue, ...$resolvedArguments);
    }
}
