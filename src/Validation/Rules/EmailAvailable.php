<?php

namespace App\Validation\Rules;

use App\Models\User;
use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;

class EmailAvailable implements RuleInterface
{
    use RuleTrait;

    public function __construct()
    {
        $this->message = 'Ten adres email jest już zajęty';
    }

    public function test($value)
    {
        return User::where('email', $value)->count() === 0;
    }
}
