<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Validation\ValidateProperty;

use Constup\PhpAttributes\Exceptions\Exceptions\ValidatePropertyException;
use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/validation/validate_property.adoc
 */
readonly class ValidatePropertyProcessor
{
    /**
     * Use this method to process a property validation with a boolean result.
     * If the attribute is not present, null is returned.
     *
     *  Note that the closure is run with the property value as the first argument, followed by
     *  `$validationArguments`. This effectively means that your static method that does the validation must have
     *  the property value as its first argument.
     *
     * @param object             $object
     * @param ReflectionProperty $reflectionProperty
     * @param array              $validationArguments Associative array of additional validation arguments.
     *                                                Index is the name of the property the attribute is being applied to. Value is
     *                                                an array of arguments to be passed to the validation closure after the
     *                                                property value. If the property name is not present as the array key,
     *                                                an exception is thrown. If your validation closure only requires the property
     *                                                value, you need to pass an empty array as the value.
     *
     * @throws ValidatePropertyException
     *
     * @return bool|null
     *
     * @see ../../../doc/available_attributes/validation/validate_property.adoc
     */
    public static function validateWithBoolResult(
        object $object,
        ReflectionProperty $reflectionProperty,
        array $validationArguments = [],
    ): ?bool {
        $attributes = $reflectionProperty->getAttributes(ValidateProperty::class);

        if (empty($attributes)) {
            return null;
        }

        $propertyValue = $reflectionProperty->getValue($object);
        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->validator;

        if (array_key_exists($reflectionProperty->getName(), $validationArguments)) {
            return $closure($propertyValue, ...$validationArguments[$reflectionProperty->getName()]);
        }

        throw new ValidatePropertyException()->missingValidationArguments($reflectionProperty->getName());
    }

    /**
     * Use this method to process a property validation with a void result.
     * If the attribute is not present, nothing happens (validation skipped).
     *
     * Note that the closure is run with the property value as the first argument, followed by
     * `$validationArguments`. This effectively means that your static method that does the validation must have
     * the property value as its first argument.
     *
     * @param object             $object
     * @param ReflectionProperty $reflectionProperty
     * @param array              $validationArguments Associative array of additional validation arguments.
     *                                                Index is the name of the property the attribute is being applied to. Value is
     *                                                an array of arguments to be passed to the validation closure after the
     *                                                property value. If the property name is not present as the array key,
     *                                                an exception is thrown. If your validation closure only requires the property
     *                                                value, you need to pass an empty array as the value.
     *
     * @throws ValidatePropertyException
     *
     * @return void
     *
     * @see ../../../doc/available_attributes/validation/validate_property.adoc
     */
    public static function validateWithVoidResult(
        object $object,
        ReflectionProperty $reflectionProperty,
        array $validationArguments = [],
    ): void {
        $attributes = $reflectionProperty->getAttributes(ValidateProperty::class);

        if (empty($attributes)) {
            return;
        }

        $propertyValue = $reflectionProperty->getValue($object);
        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->validator;

        if (array_key_exists($reflectionProperty->getName(), $validationArguments)) {
            $closure($propertyValue, ...$validationArguments[$reflectionProperty->getName()]);

            return;
        }

        throw new ValidatePropertyException()->missingValidationArguments($reflectionProperty->getName());
    }
}
