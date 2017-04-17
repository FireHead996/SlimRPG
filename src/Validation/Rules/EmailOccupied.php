<?php

namespace App\Validation\Rules;

use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;
use App\Models\User;

class EmailOccupied implements RuleInterface
{
    use RuleTrait;

    public function __construct()
    {
        $this->message = 'Nie istnieje konto o podanym adresie email';
    }

    public function test($value)
    {
        return User::where('email', $value)->count() !== 0;
    }
}
