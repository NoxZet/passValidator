<?php

require __DIR__ . '/../app/Validate/Validator.php';
use App\Validate\Validator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Error;

final class ValidatorTest extends TestCase
{
    
    public function testCorrect(): void {
        $this->assertTrue(
            Validator::validate('aA12?$BC')
        );
    }
    
    public function testShort(): void {
        $this->assertFalse(
            Validator::validate('aA12?$B')
        );
    }
    
    public function testNoLetters(): void {
        $this->assertFalse(
            Validator::validate('1.$2?!3(')
        );
    }
    
    public function testNoLowercase(): void {
        $this->assertFalse(
            Validator::validate('ABC$1.(')
        );
    }
    
    public function testNoUppercase(): void {
        $this->assertFalse(
            Validator::validate('abc$1.(')
        );
    }
    
    public function testNoDigit(): void {
        $this->assertFalse(
            Validator::validate('abCD!$.(')
        );
    }
    
    public function testNoSymbol(): void {
        $this->assertFalse(
            Validator::validate('a2b4C6D8')
        );
    }
    
    public function testDifferentThreeDigits(): void {
        $this->assertTrue(
            Validator::validate('abCD$548')
        );
    }
    
    public function testRepeatingZeros(): void {
        $this->assertFalse(
            Validator::validate('abCD$000')
        );
    }
    
    public function testRepeatingSixes(): void {
        $this->assertFalse(
            Validator::validate('abCD$666')
        );
    }
    
    public function testRepeatingNines(): void {
        $this->assertFalse(
            Validator::validate('abCD$999')
        );
    }
    
    public function test123(): void {
        $this->assertFalse(
            Validator::validate('abCD$123')
        );
    }
}