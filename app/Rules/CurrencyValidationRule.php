<?php

namespace App\Rules;

use App\Services\Curs\CursService;
use Illuminate\Contracts\Validation\Rule;

class CurrencyValidationRule implements Rule
{
    public $value;
    public CursService $service;

    public function __construct(CursService $service)
    {
        $this->service = $service;
    }

    public function passes($attribute, $value)
    {
        $this->value = $value;
        return in_array($value, $this->service->currencies);
    }

    public function message()
    {
        return "The {$this->value} is wrong.";
    }
}
