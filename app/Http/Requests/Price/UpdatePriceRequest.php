<?php

namespace App\Http\Requests\Price;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'configuration_id' => 'required|exists:configurations,id',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}
