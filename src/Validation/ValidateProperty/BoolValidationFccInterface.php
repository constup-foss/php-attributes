<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Validation\ValidateProperty;

/**
 * Implement this interface when creating a custom validator for the `#[ValidateProperty]` attribute.
 */
interface BoolValidationFccInterface
{
    /**
     * Validates the given property value and returns a boolean result.
     *
     * @param mixed $value   The value of the property to validate.
     * @param array $context Additional information that can be used during validation.
     *
     * @return bool True if the property value is valid, false otherwise.
     */
    public static function validate(
        mixed $value,
        array $context = []
    ): bool;
}
