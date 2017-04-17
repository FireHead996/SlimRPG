<?php

namespace App\Validation\Rules;

use App\Models\User;
use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;

class PasswordValid implements RuleInterface
{
    use RuleTrait;

    protected $email;

    public function __construct($email)
    {
        $this->message = 'Podane hasło jest nieprawidłowe';
        $this->email = $email;
    }

    public function test($value)
    {
        $user = User::where('email', $this->email)->first();
        
        if (!$user)
        {
            $this->message = 'Wypełnij poprawnie adres email';
            return false;
        }
        
        if (password_verify($value, $user->password))
            return true;

        return false;
    }
}