<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyValue\TestSamples;

use Constup\PhpAttributes\Serialization\TransformPropertyValue\TransformPropertyValue;

readonly class TransformPropertyValueSample
{
    public function __construct(
        #[TransformPropertyValue(PrefixTransformer::applyPrefix(...))]
        public ?string $applicableProperty = null,
        public ?string $notApplicableProperty = null,
        #[TransformPropertyValue(PrefixSuffixTransformer::applyPrefixSuffix(...))]
        public ?string $arrayAsTransformationArguments = null,
    ) {
    }

}
