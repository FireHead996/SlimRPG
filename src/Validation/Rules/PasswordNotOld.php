<?php

namespace App\Validation\Rules;

use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;
use App\Models\User;

class PasswordNotOld implements RuleInterface
{
    use RuleTrait;

    public function __construct()
    {
        $this->message = 'Podane hasło jest nieprawidłowe';
    }

    public function test($value)
    {
        $user = User::find($_SESSION['user']);
        
        if (!$user) {
            return false;
        }
        
        if (!password_verify($value, $user->password)) {
            return true;
        }

        return false;
    }
}
