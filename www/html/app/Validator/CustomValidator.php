<?php

namespace App\Validator;

use App\Validator\Exceptions\ValidationException;
use app\Validator\Rules\ValidationRule;

class CustomValidator
{
    private function __construct()
    {
    }

    public static function validate(array $rules, array $data): void
    {
        $errors = [];

        foreach ($rules as $key => $itemRules) {
            foreach ($itemRules as $rule) {
                if ($rule instanceof ValidationRule && array_key_exists($key, $data) && ! $rule->isValid($data[$key])) {
                    $errors[$key][] = $rule->getErrorMessage();
                }
            }
        }

        if (count($errors)) {
            throw new ValidationException('Validation exception', 0, null, $errors);
        }
    }
}
