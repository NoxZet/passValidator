<?php

declare(strict_types = 1);

namespace App\Validate;

class Validator {
    public static function validate(string $pass): bool {
        // length
        if (strlen($pass) < 8) return false;
        // lowercase letter
        if (!preg_match('/[a-z]+/', $pass)) return false;
        // uppercase letter
        if (!preg_match('/[A-Z]+/', $pass)) return false;
        // digit
        if (!preg_match('/[0-9]+/', $pass)) return false;
        // special character
        if (!preg_match('/[^A-Za-z0-9]+/', $pass)) return false;
        // 3 repeating digits
        if (preg_match('/([0-9])\1{2,}/', $pass)) return false;
        // 3 repeating digits
        if (preg_match('/123/', $pass)) return false;
        return true;
    }
    
    public static function getRequirements(): string {
        return file_get_contents(__DIR__ . '/validateRequirements.txt');
    }
}