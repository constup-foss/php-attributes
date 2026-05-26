<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Exceptions\Exceptions;

use Constup\PhpAttributes\Exceptions\ConstupPhpAttributesException;
use Constup\PhpAttributes\Serialization\TransformPropertyName\TransformPropertyName;

class TransformPropertyNameException extends ConstupPhpAttributesException
{
    /**
     * Thrown when the transformation arguments are missing when calling the transformer.
     *
     * @param string $propertyName
     *
     * @return $this
     */
    public function missingTransformationArguments(
        string $propertyName
    ): self {
        $this->message = 'Missing transformation arguments.';
        $this->code = 1000;
        $this->debugMessage = 'Attempted to apply ' . TransformPropertyName::class . ' attribute. Missing transformation arguments for property "' . $propertyName . '".';

        return $this;
    }
}
