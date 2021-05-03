<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'currency1' => 'required|integer',
            'currency2' => 'required|integer',
            'date' => 'required|date:Y-m-d'
        ];
    }
}
