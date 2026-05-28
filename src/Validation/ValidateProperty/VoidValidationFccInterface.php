<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Validation\ValidateProperty;

/**
 * Implement this interface when creating a custom validator for the `#[ValidateProperty]` attribute.
 */
interface VoidValidationFccInterface
{
    /**
     * Validates the given property value and returns a void result.
     *
     * @param mixed $value   The value of the property to validate.
     * @param array $context Additional information that can be used during validation.
     *
     * @return void
     */
    public static function validate(
        mixed $value,
        array $context = []
    ): void;
}
