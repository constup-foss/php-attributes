<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Validation\ValidateProperty;

use Attribute;
use Closure;

/**
 * @see ../../../doc/available_attributes/validation/validate_property.adoc
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
readonly class ValidateProperty
{
    /**
     * @see ../../../doc/available_attributes/validation/validate_property.adoc
     *
     * @param Closure $validator
     */
    public function __construct(
        public Closure $validator,
    ) {
    }

}
