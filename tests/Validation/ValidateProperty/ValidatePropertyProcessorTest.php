<?php

declare(strict_types = 1);

namespace Constup\PhpAttributes\Tests\Validation\ValidateProperty;

use Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\DataProvider\ValidateWithBoolResultDataProvider;
use Constup\PhpAttributes\Tests\Validation\ValidateProperty\ValidatePropertyProcessor\DataProvider\ValidateWithVoidResultDataProvider;
use Constup\PhpAttributes\Validation\ValidateProperty\ValidatePropertyProcessor;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class ValidatePropertyProcessorTest extends TestCase
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
        $reflectionProperty = new ReflectionProperty($object, $propertyName);
        $result = ValidatePropertyProcessor::validateWithBoolResult(
            $object,
            $reflectionProperty,
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
        string $expectedException,
        ?int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        if ($expectedExceptionCode !== null) {
            $this->expectExceptionCode($expectedExceptionCode);
        }

        $reflectionProperty = new ReflectionProperty($object, $propertyName);
        ValidatePropertyProcessor::validateWithBoolResult(
            $object,
            $reflectionProperty,
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

        $reflectionProperty = new ReflectionProperty($object, $propertyName);

        ValidatePropertyProcessor::validateWithVoidResult(
            $object,
            $reflectionProperty,
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
        string $expectedException,
        ?int $expectedExceptionCode,
    ): void {
        $this->expectException($expectedException);
        if ($expectedExceptionCode !== null) {
            $this->expectExceptionCode($expectedExceptionCode);
        }

        $reflectionProperty = new ReflectionProperty($object, $propertyName);

        ValidatePropertyProcessor::validateWithVoidResult(
            $object,
            $reflectionProperty,
            $validationArguments,
        );
    }
}
