<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\TransformPropertyName;

use Attribute;
use Closure;

/**
 * Use this attribute to transform a name of your property during serialization.
 *
 * @see ../../../doc/available_attributes/serialization/transform_property_name.adoc
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
readonly class TransformPropertyName
{
    /**
     * @param Closure $transformer
     *
     * @see ../../../doc/available_attributes/serialization/transform_property_name.adoc
     */
    public function __construct(
        public Closure $transformer,
    ) {
    }
}
