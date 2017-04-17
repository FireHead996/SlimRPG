<?php

namespace App\Validation\Rules;

use App\Models\User;
use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;

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
