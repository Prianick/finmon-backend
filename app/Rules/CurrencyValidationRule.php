<?php

namespace App\Rules;

use App\Services\Curs\CursService;
use Illuminate\Contracts\Validation\Rule;

class CurrencyValidationRule implements Rule
{
    public $value;

    public function passes($attribute, $value)
    {
        $this->value = $value;
        return in_array($value, CursService::CURRENCIES);
    }

    public function message()
    {
        return "The {$this->value} is wrong.";
    }
}
