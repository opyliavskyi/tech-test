<?php

namespace App\Validator\Exceptions;

class ValidationException extends \Exception
{
    private array $errors;

    public function __construct($message, $code = 0, ?\Exception $previous = null, $errors = [])
    {
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
