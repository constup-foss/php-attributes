<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty;

use Constup\PhpAttributes\Tests\Validation\ValidateProperty\PropertyValidator\DataProvider\ValidateWithBoolResultDataProvider;
use Constup\PhpAttributes\Tests\Validation\ValidateProperty\PropertyValidator\DataProvider\ValidateWithVoidResultDataProvider;
use Constup\PhpAttributes\Validation\ValidateProperty\PropertyValidator;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class PropertyValidatorTest extends TestCase
{
    #[DataProviderExternal(
        ValidateWithBoolResultDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_validateWithBoolResult_HappyFlow(
        object $object,
        string $propertyName,
        array $validationArguments,
        ?bool $expected
    ): void {
        $result = PropertyValidator::validateWithBoolResult(
            $object,
            $propertyName,
            $validationArguments,
        );

        if ($expected === null) {
            $this->assertNull($result);

            return;
        }

        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        ValidateWithBoolResultDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_validateWithBoolResult_ErrorFlow(
        object $object,
        string $propertyName,
        array $validationArguments,
        string $expectedException
    ): void {
        $this->expectException($expectedException);

        PropertyValidator::validateWithBoolResult(
            $object,
            $propertyName,
            $validationArguments,
        );
    }

    #[DataProviderExternal(
        ValidateWithVoidResultDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_validateWithVoidResult_HappyFlow(
        object $object,
        string $propertyName,
        array $validationArguments,
        ?string $expectedException
    ): void {
        if ($expectedException === null) {
            $this->expectNotToPerformAssertions();
        } else {
            $this->expectException($expectedException);
        }

        PropertyValidator::validateWithVoidResult(
            $object,
            $propertyName,
            $validationArguments,
        );
    }

    #[DataProviderExternal(
        ValidateWithVoidResultDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_validateWithVoidResult_ErrorFlow(
        object $object,
        string $propertyName,
        array $validationArguments,
        string $expectedException
    ): void {
        $this->expectException($expectedException);

        PropertyValidator::validateWithVoidResult(
            $object,
            $propertyName,
            $validationArguments,
        );
    }
}
