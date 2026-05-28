<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyValue;

use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
 */
readonly class TransformPropertyValueProcessor
{
    /**
     * Returns a transformed version of a property's value by running the `Closure $transformer`. If the attribute is not
     * present, the original property value is returned.
     *
     * The closure is run with the property value as the first argument, followed by `array $context`. Your static
     * method that does the transformation must have the following arguments: `(mixed $propertyValue, array $context)`.
     *
     * You can use the information passed inside the `$context` in your static method.
     *
     * @param object             $object
     * @param ReflectionProperty $reflectionProperty
     * @param array              $context
     *
     * @return mixed
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
     */
    public static function transform(
        object $object,
        ReflectionProperty $reflectionProperty,
        array $context = [],
    ): mixed {
        $attributes = $reflectionProperty->getAttributes(TransformPropertyValue::class);
        $propertyValue = $reflectionProperty->getValue($object);

        if (empty($attributes)) {
            return $propertyValue;
        }

        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->transformer;

        return $closure($propertyValue, $context);
    }
}
