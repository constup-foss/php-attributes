<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Validation\ValidateProperty;

use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/validation/validate_property.adoc
 */
readonly class ValidatePropertyProcessor
{
    /**
     * Use this method to perform a property validation with a boolean result.
     * If the attribute is not present, null is returned.
     *
     * The closure is run with the property value as the first argument, followed by `$context`. Your static method
     * that performs validation must have the following arguments: `(mixed $propertyValue, array $context)`.
     *
     * You can use the information passed inside the `$context` in your static method.
     *
     * @param object             $object
     * @param ReflectionProperty $reflectionProperty
     * @param array              $context
     *
     * @return bool|null
     *
     * @see ../../../doc/available_attributes/validation/validate_property.adoc
     */
    public static function validateWithBoolResult(
        object $object,
        ReflectionProperty $reflectionProperty,
        array $context = []
    ): ?bool {
        $attributes = $reflectionProperty->getAttributes(ValidateProperty::class);

        if (empty($attributes)) {
            return null;
        }

        $propertyValue = $reflectionProperty->getValue($object);
        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->validator;

        return $closure($propertyValue, $context);
    }

    /**
     * Use this method to perform a property validation with a void result.
     *
     * The closure is run with the property value as the first argument, followed by `$context`. Your static method
     * that performs validation must have the following arguments: `(mixed $propertyValue, array $context)`.
     *
     * You can use the information passed inside the `$context` in your static method.
     *
     * @param object             $object
     * @param ReflectionProperty $reflectionProperty
     * @param array              $context
     *
     * @return void
     *
     * @see ../../../doc/available_attributes/validation/validate_property.adoc
     */
    public static function validateWithVoidResult(
        object $object,
        ReflectionProperty $reflectionProperty,
        array $context = []
    ): void {
        $attributes = $reflectionProperty->getAttributes(ValidateProperty::class);

        if (empty($attributes)) {
            return;
        }

        $propertyValue = $reflectionProperty->getValue($object);
        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->validator;

        $closure($propertyValue, $context);
    }
}
