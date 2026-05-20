<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\PropertyValidator\TestSamples;

use Constup\PhpAttributes\Validation\ValidateProperty\ValidateProperty;

readonly class PropertyValidatorSample
{
    public function __construct(
        #[ValidateProperty(
            validator: IntLargerThanValidator::validateLargerThanWithBoolResult(...)
        )]
        public ?int $attributeIsPresentBoolResult = null,
        #[ValidateProperty(
            validator: IntLargerThanValidator::validateLargerThanWithVoidResult(...)
        )]
        public ?int $attributeIsPresentVoidResult = null,
        public ?int $attributeIsNotPresent = null,
    ) {
    }
}
