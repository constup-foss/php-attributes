<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Exceptions\Exceptions;

use Constup\PhpAttributes\Exceptions\ConstupPhpAttributesException;
use Constup\PhpAttributes\Validation\ValidateProperty\ValidateProperty;

class ValidatePropertyException extends ConstupPhpAttributesException
{
    /**
     * Thrown when the validation arguments are missing when calling the validator.
     *
     * @param string $propertyName
     *
     * @return $this
     */
    public function missingValidationArguments(
        string $propertyName
    ): self {
        $this->message = 'Missing validation arguments.';
        $this->code = 3000;
        $this->debugMessage = 'Attempted to apply ' . ValidateProperty::class . ' attribute. Missing validation arguments for property "' . $propertyName . '".';

        return $this;
    }
}
