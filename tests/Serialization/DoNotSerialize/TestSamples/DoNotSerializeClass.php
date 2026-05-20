<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Serialization\DoNotSerialize\TestSamples;

use Constup\PhpAttributes\Serialization\DoNotSerialize\DoNotSerialize;

#[DoNotSerialize]
readonly class DoNotSerializeClass
{
    public function __construct(
        public string $serialize,
        #[DoNotSerialize]
        public string $doNotSerialize,
    ) {
    }
}
