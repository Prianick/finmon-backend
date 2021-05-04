<?php

namespace App\Http\Requests;

use App\Rules\CurrencyValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExchangeRateRequest extends FormRequest
{
    public function rules()
    {
        $currenciesValidationRule = app()->make(CurrencyValidationRule::class);
        return [
            'currency1' => ['required', 'string', $currenciesValidationRule],
            'currency2' => ['required', 'string', $currenciesValidationRule],
            'date' => ['required', 'date:Y-m-d']
        ];
    }
}
