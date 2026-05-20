<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyName;

use ReflectionException;
use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/serialization/transform_property_name.adoc
 */
readonly class TransformPropertyNameProcessor
{
    /**
     * Returns a transformed version of `$propertyName` by running the closure defined in the attribute.
     * If the attribute is not present, the original `$propertyName` is returned.
     *
     * Note that the closure is run with the `$propertyName` as the first argument, followed by
     * `$transformationArguments`. This effectively means that your static method that does the transformation must have
     * the property name as its first argument.
     *
     * @param string|object $classOrObject
     * @param string        $propertyName
     * @param array         $transformationArguments Associative array of additional transformation arguments.
     *                                               Index is the name of the property the attribute is being applied
     *                                               to. Value is an array of arguments to be passed to the
     *                                               transformation closure after the property name.
     *
     * @throws ReflectionException
     *
     * @return string
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_name.adoc
     */
    public static function transform(
        string|object $classOrObject,
        string $propertyName,
        array $transformationArguments = [],
    ): string {
        $reflectionProperty = new ReflectionProperty($classOrObject, $propertyName);
        $attributes = $reflectionProperty->getAttributes(TransformPropertyName::class);

        if (empty($attributes)) {
            return $propertyName;
        }

        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->transformer;
        $resolvedArguments = $transformationArguments[$propertyName] ?? [];

        return $closure($propertyName, ...$resolvedArguments);
    }
}
