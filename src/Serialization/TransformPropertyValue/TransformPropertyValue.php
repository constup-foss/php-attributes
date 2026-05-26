<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyValue;

use Attribute;
use Closure;

/**
 * Use this attribute to transform the value of your property.
 *
 * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
readonly class TransformPropertyValue
{
    /**
     * @param Closure $transformer
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_value.adoc
     */
    public function __construct(
        public Closure $transformer,
    ) {
    }
}
