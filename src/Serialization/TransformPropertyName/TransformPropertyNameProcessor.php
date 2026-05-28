<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyName;

use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/serialization/transform_property_name.adoc
 */
readonly class TransformPropertyNameProcessor
{
    /**
     * Returns a transformed version of a property's name by running the `Closure $transformer`. If the attribute is not
     * present, the original property name is returned.
     *
     * The closure is run with the property name as the first argument, followed by `array $context`. Your static
     * method that does the transformation must have the following arguments: `(string $propertyName, array $context)`.
     *
     * You can use the information passed inside the `$context` in your static method.
     *
     * @param ReflectionProperty $reflectionProperty
     * @param array              $context
     *
     * @return string
     */
    public static function transform(
        ReflectionProperty $reflectionProperty,
        array $context = [],
    ): string {
        $attributes = $reflectionProperty->getAttributes(TransformPropertyName::class);
        $propertyName = $reflectionProperty->getName();

        if (empty($attributes)) {
            return $propertyName;
        }

        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->transformer;

        return $closure($propertyName, $context);
    }
}
