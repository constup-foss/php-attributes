<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Validation\ValidateProperty;

use ReflectionException;
use ReflectionProperty;

/**
 * @see ../../../doc/available_attributes/validation/validate_property.adoc
 */
readonly class PropertyValidator
{
    /**
     * Use this method to process a property validation with a boolean result.
     * If the attribute is not present, null is returned.
     *
     * @param object $object
     * @param string $propertyName
     * @param array  $validationArguments Associative array of additional validation arguments.
     *                                    Index is the name of the property the attribute is being applied to. Value is
     *                                    an array of arguments to be passed to the transformation closure after the
     *                                    property value.
     *
     * @throws ReflectionException
     *
     * @return bool|null
     *
     * @see ../../../doc/available_attributes/validation/validate_property.adoc
     */
    public static function validateWithBoolResult(
        object $object,
        string $propertyName,
        array $validationArguments = [],
    ): ?bool {
        $reflectionProperty = new ReflectionProperty($object, $propertyName);
        $attributes = $reflectionProperty->getAttributes(ValidateProperty::class);

        if (empty($attributes)) {
            return null;
        }

        $propertyValue = $reflectionProperty->getValue($object);
        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->validator;
        $resolvedArguments = $validationArguments[$propertyName] ?? [];

        return $closure($propertyValue, ...$resolvedArguments);
    }

    /**
     * Use this method to process a property validation with a void result.
     * If the attribute is not present, nothing happens (validation skipped).
     *
     * @param object $object
     * @param string $propertyName
     * @param array  $validationArguments Associative array of additional validation arguments.
     *                                    Index is the name of the property the attribute is being applied to. Value is
     *                                    an array of arguments to be passed to the transformation closure after the
     *                                    property value.
     *
     * @throws ReflectionException
     *
     * @return void
     *
     * @see ../../../doc/available_attributes/validation/validate_property.adoc
     */
    public static function validateWithVoidResult(
        object $object,
        string $propertyName,
        array $validationArguments = [],
    ): void {
        $reflectionProperty = new ReflectionProperty($object, $propertyName);
        $attributes = $reflectionProperty->getAttributes(ValidateProperty::class);

        if (empty($attributes)) {
            return;
        }

        $propertyValue = $reflectionProperty->getValue($object);
        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->validator;
        $resolvedArguments = $validationArguments[$propertyName] ?? [];

        $closure($propertyValue, ...$resolvedArguments);
    }
}
