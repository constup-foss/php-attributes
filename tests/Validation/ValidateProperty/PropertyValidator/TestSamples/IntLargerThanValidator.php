<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\PropertyValidator\TestSamples;

readonly class IntLargerThanValidator
{
    /**
     * @param int $value
     * @param int $compareTo
     *
     * @return bool
     */
    public static function validateLargerThanWithBoolResult(
        int $value,
        int $compareTo,
    ): bool {
        return $value > $compareTo;
    }

    /**
     * @param int $value
     * @param int $compareTo
     *
     * @throws SampleException
     *
     * @return void
     */
    public static function validateLargerThanWithVoidResult(
        int $value,
        int $compareTo,
    ): void {
        if ($value <= $compareTo) {
            throw new SampleException('Value must be larger than ' . $compareTo);
        }
    }
}
