<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\TestSamples;

readonly class IntLargerThanValidator
{
    /**
     * @param int   $value
     * @param array $context
     *
     * @return bool
     */
    public static function validateLargerThanWithBoolResult(
        int $value,
        array $context
    ): bool {
        return $value > $context['compareTo'];
    }

    /**
     * @param int   $value
     * @param array $context
     *
     * @throws SampleException
     *
     * @return void
     */
    public static function validateLargerThanWithVoidResult(
        int $value,
        array $context,
    ): void {
        if ($value <= $context['compareTo']) {
            throw new SampleException('Value must be larger than ' . $context['compareTo']);
        }
    }
}
