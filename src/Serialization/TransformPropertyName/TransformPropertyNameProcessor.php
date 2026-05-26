<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyName;

use Constup\PhpAttributes\Exceptions\ConstupPhpAttributesException;
use Constup\PhpAttributes\Exceptions\Exceptions\TransformPropertyNameException;
use ReflectionAttribute;
use ReflectionException;
use ReflectionProperty;
use Throwable;

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
     *                                               transformation closure after the property name. If the property
     *                                               name is not present as the array key, but is expected, an exception
     *                                               is thrown.
     *
     * @throws ReflectionException
     * @throws TransformPropertyNameException
     *
     * @return string
     *
     * @see TransformPropertyNameProcessor::transformReflectionProperty()
     * @see ../../../doc/available_attributes/serialization/transform_property_name.adoc
     */
    public static function transform(
        string|object $classOrObject,
        string $propertyName,
        array $transformationArguments = [],
    ): string {
        $reflectionProperty = new ReflectionProperty($classOrObject, $propertyName);
        $attributes = $reflectionProperty->getAttributes(TransformPropertyName::class);

        return self::processAttribute(
            $attributes,
            $propertyName,
            $transformationArguments,
        );
    }

    /**
     * Returns a transformed version of a property's name derived from a reflection property by running the closure
     * defined in the attribute. If the attribute is not present, the original property name is returned.
     *
     * Note that the closure is run with the property's name as the first argument, followed by
     * `$transformationArguments`. This effectively means that your static method that does the transformation must have
     * the property name as its first argument.
     *
     * @param ReflectionProperty $reflectionProperty
     * @param array              $transformationArguments Associative array of additional transformation arguments.
     *                                                    Index is the name of the property the attribute is being
     *                                                    applied to. Value is an array of arguments to be passed to the
     *                                                    transformation closure after the property name. If the
     *                                                    property name is not present as the array key, but is
     *                                                    expected, an exception is thrown.
     *
     * @throws ConstupPhpAttributesException
     * @throws TransformPropertyNameException
     *
     * @return string
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_name.adoc
     * @see TransformPropertyNameProcessor::transform()
     */
    public static function transformReflectionProperty(
        ReflectionProperty $reflectionProperty,
        array $transformationArguments = [],
    ): string {
        $attributes = $reflectionProperty->getAttributes(TransformPropertyName::class);
        $propertyName = $reflectionProperty->getName();

        return self::processAttribute(
            $attributes,
            $propertyName,
            $transformationArguments,
        );
    }

    /**
     * @param array<ReflectionAttribute> $attributes
     * @param string                     $propertyName
     * @param array                      $transformationArguments
     *
     * @throws TransformPropertyNameException
     *
     * @return string
     */
    private static function processAttribute(
        array $attributes,
        string $propertyName,
        array $transformationArguments,
    ): string {
        if (empty($attributes)) {
            return $propertyName;
        }

        $attributeInstance = $attributes[0]->newInstance();
        $closure = $attributeInstance->transformer;

        if (array_key_exists($propertyName, $transformationArguments)) {
            return $closure($propertyName, ...$transformationArguments[$propertyName]);
        }

        try {
            return $closure($propertyName);
        } catch (Throwable) {
            throw new TransformPropertyNameException()->missingTransformationArguments($propertyName);
        }
    }
}
