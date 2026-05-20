<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Serialization\DoNotSerialize;

use Attribute;

/**
 * @codeCoverageIgnore
 *
 * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
readonly class DoNotSerialize
{
    /**
     * @see ../../../doc/available_attributes/serialization/do_not_serialize.adoc
     */
    public function __construct()
    {
    }
}
