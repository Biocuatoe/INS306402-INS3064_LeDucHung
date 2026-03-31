<?php
// classes/ValidationException.php

class ValidationException extends Exception
{
    protected array $errors;

    public function __construct(array $errors, string $message = "Dữ liệu không hợp lệ")
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}