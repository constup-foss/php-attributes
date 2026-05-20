<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\TransformPropertyName\TestSamples;

use Constup\PhpAttributes\Serialization\TransformPropertyName\TransformPropertyName;

readonly class TransformPropertyNameSample
{
    public function __construct(
        #[TransformPropertyName(PrefixTransformer::applyPrefix(...))]
        public ?string $applicableProperty = null,
        public ?string $notApplicableProperty = null,
    ) {
    }
}
