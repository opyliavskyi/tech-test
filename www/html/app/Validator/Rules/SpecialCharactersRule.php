<?php

namespace App\Validator\Rules;

class SpecialCharactersRule extends ValidationRule
{
    public function isValid($data): bool
    {
        if (is_string($data) && str_contains($data, '!')) {
            return false;
        }

        return true;
    }
}
