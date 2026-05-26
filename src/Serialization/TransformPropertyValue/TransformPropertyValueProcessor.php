<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyValue;

use Constup\PhpAttributes\Exceptions\Exceptions\TransformPropertyValueException;
use ReflectionException;
use ReflectionProperty;
use Throwable;

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
     *                                                      Index is the name of the property the attribute is being
     *                                                      applied to. Value is an array of arguments to be passed
     *                                                      to the transformation closure after the property value. If
     *                                                      the property name is not present as the array key, but is
     *                                                      expected, an exception is thrown.
     *
     * @throws ReflectionException
     * @throws TransformPropertyValueException
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

        return self::processAttributes(
            $attributes,
            $propertyName,
            $propertyValue,
            $transformationArguments
        );
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
     *                                        Index is the name of the property the attribute is being applied to. Value
     *                                        is an array of arguments to be passed to the transformation closure after
     *                                        the property value. If the property name is not present as the array key,
     *                                        but is expected, an exception is thrown.
     *
     * @throws ReflectionException
     * @throws TransformPropertyValueException
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

        return self::processAttributes(
            $attributes,
            $propertyName,
            $propertyValue,
            $transformationArguments,
        );
    }

    /**
     * Returns a transformed version of a property value by running the closure defined in the attribute.
     * If the attribute is not present, the original property value is returned.
     *
     * Note that the closure is run with the property value as the first argument, followed by
     * `$transformationArguments`. This effectively means that your static method that does the transformation must have
     * the property value as its first argument.
     *
     * @param object             $object
     * @param ReflectionProperty $reflectionProperty
     * @param array              $transformationArguments Associative array of additional transformation arguments.
     *                                                    Index is the name of the property the attribute is being applied to. Value
     *                                                    is an array of arguments to be passed to the transformation closure after
     *                                                    the property value. If the property name is not present as the array key,
     *                                                    but is expected, an exception is thrown.
     *
     * @throws TransformPropertyValueException
     *
     * @return mixed
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
     */
    public static function transformReflectionProperty(
        object $object,
        ReflectionProperty $reflectionProperty,
        array $transformationArguments = [],
    ): mixed {
        $attributes = $reflectionProperty->getAttributes(TransformPropertyValue::class);
        $propertyValue = $reflectionProperty->getValue($object);

        return self::processAttributes(
            $attributes,
            $reflectionProperty->getName(),
            $propertyValue,
            $transformationArguments,
        );
    }

    /**
     * @param array  $attributes
     * @param string $propertyName
     * @param mixed  $propertyValue
     * @param array  $transformationArguments
     *
     * @throws TransformPropertyValueException
     *
     * @return mixed
     */
    private static function processAttributes(
        array $attributes,
        string $propertyName,
        mixed $propertyValue,
        array $transformationArguments,
    ): mixed {
        if (empty($attributes)) {
            return $propertyValue;
        }

        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->transformer;

        if (array_key_exists($propertyName, $transformationArguments)) {
            return $closure($propertyValue, ...$transformationArguments[$propertyName]);
        }

        try {
            return $closure($propertyValue);
        } catch (Throwable) {
            throw new TransformPropertyValueException()->missingTransformationArguments($propertyName);
        }
    }
}
