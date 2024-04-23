<?php

namespace app\Validator\Rules;

abstract class ValidationRule
{
    abstract public function isValid($data): bool;

    public function getErrorMessage(): string
    {
        return sprintf('Data did not pass %s class validation', static::class);
    }
}
