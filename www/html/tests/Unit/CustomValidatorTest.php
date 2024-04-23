<?php

namespace Tests\Unit;

use App\Validator\CustomValidator;
use App\Validator\Exceptions\ValidationException;
use App\Validator\Rules\SpecialCharactersRule;
use PHPUnit\Framework\TestCase;

class CustomValidatorTest extends TestCase
{
    public function testThrowValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Validation exception');

        CustomValidator::validate(
            [
                'first_name' => [new SpecialCharactersRule()],
                'last_name' => [new SpecialCharactersRule()],
            ],
            [
                'first_name' => 'Alex!',
                'last_name' => 'Test!',
            ]
        );
    }

    public function testValidationExceptionMessages(): void
    {
        try {
            CustomValidator::validate(
                [
                    'first_name' => [new SpecialCharactersRule()],
                    'last_name' => [new SpecialCharactersRule()],
                    'email' => [new SpecialCharactersRule()],
                ],
                [
                    'first_name' => 'Alex!',
                    'last_name' => 'Test!',
                    'email' => 'test@email.com',
                ]
            );
        } catch (ValidationException $exception) {
            $this->assertSame(
                $exception->getErrors(), [
                    'first_name' => [
                        0 => "Data did not pass App\Validator\Rules\SpecialCharactersRule class validation",
                    ],
                    'last_name' => [
                        0 => "Data did not pass App\Validator\Rules\SpecialCharactersRule class validation",
                    ],
                ]
            );

            $this->assertArrayNotHasKey('email', $exception->getErrors());
        }

    }
}
